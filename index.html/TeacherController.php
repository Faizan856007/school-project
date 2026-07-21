<?php
/**
 * Teacher Portal Controller
 */
class TeacherController extends Controller {
    private $teacherModel;
    private $attendanceModel;
    private $gradeModel;
    private $academicModel;
    public function __construct() {
        $this->teacherModel = $this->model('Teacher');
        $this->attendanceModel = $this->model('Attendance');
        $this->gradeModel = $this->model('Grade');
        $this->academicModel = $this->model('Academic');
    }
    private function getTeacherSession() {
        $userId = Session::get('user_id');
        $teacher = $this->teacherModel->getTeacherByUserId($userId);
        if (!$teacher) {
            Session::flash('auth_error', 'Profile not found.', 'alert alert-danger');
            Response::redirect('/auth/login');
        }
        return $teacher;
    }
    public function dashboard() {
        $teacher = $this->getTeacherSession();
        $classes = $this->academicModel->getClasses();
        
        $db = new Database();
        $db->query("SELECT COUNT(*) as cnt FROM students");
        $studentCount = $db->single()->cnt;
        $data = [
            'teacher' => $teacher,
            'classes' => $classes,
            'studentCount' => $studentCount
        ];
        $this->view('teacher/dashboard', $data);
    }
    public function attendance() {
        $teacher = $this->getTeacherSession();
        $classes = $this->academicModel->getClasses();
        $request = new Request();
        $classId = $_GET['class_id'] ?? ($classes[0]->id ?? null);
        $date = $_GET['date'] ?? date('Y-m-d');
        if ($request->isPost()) {
            $data = $request->getBody();
            if (!Session::validateCsrf($data['csrf_token'] ?? '')) {
                Session::flash('att_err', 'CSRF failed.', 'alert alert-danger');
                Response::redirect('/portal/teacher/attendance');
            }
            // Save attendance array
            $attendanceData = [];
            foreach ($_POST['attendance'] ?? [] as $studentId => $status) {
                $attendanceData[$studentId] = [
                    'status' => $status,
                    'remarks' => $_POST['remarks'][$studentId] ?? ''
                ];
            }
            if ($this->attendanceModel->saveClassAttendance($date, $attendanceData)) {
                Session::flash('att_success', 'Attendance records stored successfully!', 'alert alert-success');
            } else {
                Session::flash('att_err', 'Could not save attendance.', 'alert alert-danger');
            }
            Response::redirect("/portal/teacher/attendance?class_id=$classId&date=$date");
        } else {
            $students = [];
            if ($classId) {
                $students = $this->attendanceModel->getClassAttendanceList($classId, $date);
            }
            $this->view('teacher/attendance', [
                'teacher' => $teacher,
                'classes' => $classes,
                'students' => $students,
                'selectedClass' => $classId,
                'selectedDate' => $date
            ]);
        }
    }
    public function homework() {
        $teacher = $this->getTeacherSession();
        $classes = $this->academicModel->getClasses();
        $request = new Request();
        $db = new Database();
        if ($request->isPost()) {
            $data = $request->getBody();
            if (!Session::validateCsrf($data['csrf_token'] ?? '')) {
                Session::flash('hw_err', 'CSRF token failed.', 'alert alert-danger');
                Response::redirect('/portal/teacher/homework');
            }
            // Handle homework PDF file upload
            $filePath = 'uploads/homework_default.pdf';
            if (isset($_FILES['homework_file']) && $_FILES['homework_file']['error'] == 0) {
                $filePath = 'uploads/homework_' . time() . '.pdf';
                move_uploaded_file($_FILES['homework_file']['tmp_name'], dirname(APPROOT) . '/public/' . $filePath);
            }
            $success = $this->gradeModel->createHomework([
                'class_id' => $data['class_id'],
                'subject_id' => $data['subject_id'],
                'teacher_id' => $teacher->id,
                'title' => $data['title'],
                'description' => $data['description'],
                'due_date' => $data['due_date'],
                'file_path' => $filePath
            ]);
            if ($success) {
                Session::flash('hw_success', 'Homework assignments dispatched!', 'alert alert-success');
            } else {
                Session::flash('hw_err', 'Failed to dispatch assignments.', 'alert alert-danger');
            }
            Response::redirect('/portal/teacher/homework');
        } else {
            // Get all homework published by teacher
            $db->query("
                SELECT h.*, c.name as class_name, s.name as subject_name 
                FROM homework h
                JOIN classes c ON h.class_id = c.id
                JOIN subjects s ON h.subject_id = s.id
                WHERE h.teacher_id = :teacher_id
                ORDER BY h.id DESC
            ");
            $db->bind(':teacher_id', $teacher->id);
            $homework = $db->resultSet();
            // Subjects list
            $db->query("SELECT * FROM subjects WHERE teacher_id = :teacher_id");
            $db->bind(':teacher_id', $teacher->id);
            $subjects = $db->resultSet();
            $this->view('teacher/homework', [
                'teacher' => $teacher,
                'classes' => $classes,
                'homework' => $homework,
                'subjects' => $subjects
            ]);
        }
    }
    public function gradeSubmissions() {
        $teacher = $this->getTeacherSession();
        $homeworkId = $_GET['homework_id'] ?? null;
        $request = new Request();
        if ($request->isPost()) {
            $data = $request->getBody();
            if ($this->gradeModel->gradeSubmission($data['submission_id'], $data['grade'], $data['feedback'])) {
                Session::flash('grade_success', 'Submission marked successfully!', 'alert alert-success');
            }
            Response::redirect("/portal/teacher/grade?homework_id=" . $data['homework_id']);
        } else {
            $submissions = [];
            if ($homeworkId) {
                $submissions = $this->gradeModel->getSubmissionsByHomework($homeworkId);
            }
            $this->view('teacher/grade_submissions', [
                'teacher' => $teacher,
                'submissions' => $submissions,
                'homeworkId' => $homeworkId
            ]);
        }
    }
    public function examResults() {
        $teacher = $this->getTeacherSession();
        $classes = $this->academicModel->getClasses();
        $db = new Database();
        
        $request = new Request();
        if ($request->isPost()) {
            $data = $request->getBody();
            // Record exam marks
            foreach ($_POST['marks'] ?? [] as $studentId => $marks) {
                $db->query("
                    INSERT INTO exam_results (exam_id, student_id, marks_obtained, remarks) 
                    VALUES (:exam_id, :student_id, :marks, :remarks)
                    ON DUPLICATE KEY UPDATE marks_obtained = :marks2, remarks = :remarks2
                ");
                $db->bind(':exam_id', $data['exam_id']);
                $db->bind(':student_id', $studentId);
                $db->bind(':marks', $marks);
                $db->bind(':remarks', $_POST['remarks'][$studentId] ?? '');
                $db->bind(':marks2', $marks);
                $db->bind(':remarks2', $_POST['remarks'][$studentId] ?? '');
                $db->execute();
            }
            Session::flash('exam_success', 'Marks catalog entry updated!', 'alert alert-success');
            Response::redirect('/portal/teacher/exams');
        }
        // Get exams list
        $db->query("
            SELECT ex.*, c.name as class_name, s.name as subject_name 
            FROM exams ex
            JOIN classes c ON ex.class_id = c.id
            JOIN subjects s ON ex.subject_id = s.id
            ORDER BY ex.id DESC
        ");
        $exams = $db->resultSet();
        // Get student lists for selected exam
        $selectedExam = $_GET['exam_id'] ?? ($exams[0]->id ?? null);
        $examStudents = [];
        if ($selectedExam) {
            $db->query("SELECT class_id FROM exams WHERE id = :exam_id");
            $db->bind(':exam_id', $selectedExam);
            $examClassId = $db->single()->class_id;
            $db->query("
                SELECT s.id as student_id, s.first_name, s.last_name, s.admission_no, er.marks_obtained, er.remarks
                FROM students s
                LEFT JOIN exam_results er ON s.id = er.student_id AND er.exam_id = :exam_id
                WHERE s.class_id = :class_id
                ORDER BY s.last_name, s.first_name
            ");
            $db->bind(':exam_id', $selectedExam);
            $db->bind(':class_id', $examClassId);
            $examStudents = $db->resultSet();
        }
        $this->view('teacher/exams', [
            'teacher' => $teacher,
            'exams' => $exams,
            'examStudents' => $examStudents,
            'selectedExam' => $selectedExam
        ]);
    }
}
