<?php
/**
 * Student Portal Controller
 */
class StudentController extends Controller {
    private $studentModel;
    private $attendanceModel;
    private $gradeModel;
    private $financeModel;
    private $academicModel;
    public function __construct() {
        $this->studentModel = $this->model('Student');
        $this->attendanceModel = $this->model('Attendance');
        $this->gradeModel = $this->model('Grade');
        $this->financeModel = $this->model('Finance');
        $this->academicModel = $this->model('Academic');
    }
    private function getStudentSession() {
        $userId = Session::get('user_id');
        $student = $this->studentModel->getStudentByUserId($userId);
        if (!$student) {
            Session::flash('auth_error', 'Profile not found. Contact administrator.', 'alert alert-danger');
            Response::redirect('/auth/login');
        }
        return $student;
    }
    public function dashboard() {
        $student = $this->getStudentSession();
        $attendanceRate = $this->attendanceModel->getAttendanceStats($student->id);
        $homework = $this->gradeModel->getStudentHomeworkWithSubmission($student->class_id, $student->id);
        $fees = $this->financeModel->getStudentFees($student->id);
        $notifications = $this->model('User')->getNotifications(Session::get('user_id'));
        $data = [
            'student' => $student,
            'attendanceRate' => $attendanceRate,
            'homework' => array_slice($homework, 0, 3), // Show first 3
            'fees' => $fees,
            'notifications' => $notifications
        ];
        $this->view('student/dashboard', $data);
    }
    public function profile() {
        $student = $this->getStudentSession();
        $this->view('student/profile', ['student' => $student]);
    }
    public function attendance() {
        $student = $this->getStudentSession();
        $attendance = $this->attendanceModel->getStudentAttendance($student->id);
        $this->view('student/attendance', ['student' => $student, 'attendance' => $attendance]);
    }
    public function homework() {
        $student = $this->getStudentSession();
        $request = new Request();
        if ($request->isPost()) {
            $data = $request->getBody();
            if (!Session::validateCsrf($data['csrf_token'] ?? '')) {
                Session::flash('homework_err', 'CSRF failed.', 'alert alert-danger');
                Response::redirect('/portal/student/homework');
            }
            // Simple mock file upload handling
            $uploadFile = 'uploads/submissions/peter_homework_' . time() . '.pdf';
            if (isset($_FILES['homework_file']) && $_FILES['homework_file']['error'] == 0) {
                // Ensure upload directories exist
                if (!is_dir(dirname(APPROOT) . '/public/uploads/submissions')) {
                    mkdir(dirname(APPROOT) . '/public/uploads/submissions', 0777, true);
                }
                
                move_uploaded_file($_FILES['homework_file']['tmp_name'], dirname(APPROOT) . '/public/' . $uploadFile);
            }
            if ($this->gradeModel->submitHomework($data['homework_id'], $student->id, $uploadFile)) {
                Session::flash('homework_success', 'Homework submitted successfully!', 'alert alert-success');
            } else {
                Session::flash('homework_err', 'Error updating submission.', 'alert alert-danger');
            }
            Response::redirect('/portal/student/homework');
        } else {
            $homework = $this->gradeModel->getStudentHomeworkWithSubmission($student->class_id, $student->id);
            $this->view('student/homework', ['student' => $student, 'homework' => $homework]);
        }
    }
    public function exams() {
        $student = $this->getStudentSession();
        $results = $this->gradeModel->getStudentResults($student->id);
        $exams = $this->gradeModel->getExamsByClass($student->class_id);
        
        $this->view('student/exams', [
            'student' => $student,
            'results' => $results,
            'exams' => $exams
        ]);
    }
    public function fees() {
        $student = $this->getStudentSession();
        $request = new Request();
        if ($request->isPost()) {
            $data = $request->getBody();
            if (!Session::validateCsrf($data['csrf_token'] ?? '')) {
                Session::flash('fee_err', 'CSRF verification failed.', 'alert alert-danger');
                Response::redirect('/portal/student/fees');
            }
            $tx_id = 'txn_' . bin2hex(random_bytes(8));
            if ($this->financeModel->recordPayment($data['fee_id'], 'Mock Online Payment Gateway', $tx_id)) {
                Session::flash('fee_success', 'Fee paid successfully! Receipt transaction ID: ' . $tx_id, 'alert alert-success');
            } else {
                Session::flash('fee_err', 'Could not record transaction.', 'alert alert-danger');
            }
            Response::redirect('/portal/student/fees');
        } else {
            $fees = $this->financeModel->getStudentFees($student->id);
            $this->view('student/fees', ['student' => $student, 'fees' => $fees]);
        }
    }
    public function library() {
        $student = $this->getStudentSession();
        // Mock library catalogs
        $db = new Database();
        $db->query("SELECT * FROM library_books");
        $books = $db->resultSet();
        $db->query("
            SELECT li.*, b.title, b.author 
            FROM library_issues li 
            JOIN library_books b ON li.book_id = b.id 
            WHERE li.student_id = :student_id
        ");
        $db->bind(':student_id', $student->id);
        $issues = $db->resultSet();
        $this->view('student/library', [
            'student' => $student,
            'books' => $books,
            'issues' => $issues
        ]);
    }
    public function aiAssistant() {
        $student = $this->getStudentSession();
        $this->view('student/ai_assistant', ['student' => $student]);
    }
    // AI API mock responder
    public function askAi() {
        $request = new Request();
        if ($request->isPost()) {
            $data = $request->getBody();
            $query = strtolower($data['query'] ?? '');
            // Provide context-aware AI answers (Mock AI response)
            $response = "I am Aether AI, your study assistant. ";
            if (strpos($query, 'physics') !== false) {
                $response .= "Physics homework requires applying Newton's 2nd law: Force = Mass * Acceleration (F=ma). Let me know if you need help with derivations!";
            } elseif (strpos($query, 'timetable') !== false || strpos($query, 'schedule') !== false) {
                $response .= "You can view your active timetable under the Academics portal navigation link.";
            } elseif (strpos($query, 'fees') !== false) {
                $response .= "You have pending fees for Term 1. Secure card checkouts can be processed inside your Finances tab.";
            } else {
                $response .= "That is an excellent academic query. To explore this topic deeply, you should research Cormen's Algorithms book in the school library or review your notes.";
            }
            Response::json(['answer' => $response]);
        }
    }
    public function timetable() {
        $student = $this->getStudentSession();
        $this->view('student/timetable', ['student' => $student]);
    }
    public function leaveRequest() {
        $student = $this->getStudentSession();
        $request = new Request();
        $db = new Database();
        if ($request->isPost()) {
            $data = $request->getBody();
            if (!Session::validateCsrf($data['csrf_token'] ?? '')) {
                Session::flash('leave_err', 'CSRF failed.', 'alert alert-danger');
                Response::redirect('/portal/student/leave');
            }
            $db->query("
                INSERT INTO leave_requests (user_id, start_date, end_date, reason, status) 
                VALUES (:user_id, :start_date, :end_date, :reason, 'pending')
            ");
            $db->bind(':user_id', Session::get('user_id'));
            $db->bind(':start_date', $data['start_date']);
            $db->bind(':end_date', $data['end_date']);
            $db->bind(':reason', $data['reason']);
            
            if ($db->execute()) {
                Session::flash('leave_success', 'Leave application submitted!', 'alert alert-success');
            } else {
                Session::flash('leave_err', 'Failed to submit leave.', 'alert alert-danger');
            }
            Response::redirect('/portal/student/leave');
        } else {
            $db->query("SELECT * FROM leave_requests WHERE user_id = :user_id ORDER BY id DESC");
            $db->bind(':user_id', Session::get('user_id'));
            $leaves = $db->resultSet();
            $this->view('student/leave_request', ['student' => $student, 'leaves' => $leaves]);
        }
    }
    public function messages() {
        $student = $this->getStudentSession();
        $db = new Database();
        
        $request = new Request();
        if ($request->isPost()) {
            $data = $request->getBody();
            if (!Session::validateCsrf($data['csrf_token'] ?? '')) {
                Response::json(['error' => 'CSRF failed'], 400);
            }
            $db->query("INSERT INTO messages (sender_id, receiver_id, message) VALUES (:sender, :receiver, :msg)");
            $db->bind(':sender', Session::get('user_id'));
            $db->bind(':receiver', $data['receiver_id']);
            $db->bind(':msg', $data['message']);
            
            if ($db->execute()) {
                Response::json(['status' => 'sent']);
            }
            exit;
        }
        // Fetch teachers list to initiate chats
        $teachers = $this->model('Teacher')->getAllTeachers();
        // Fetch user chat logs
        $db->query("
            SELECT m.*, u_send.username as sender_name, u_recv.username as receiver_name 
            FROM messages m
            JOIN users u_send ON m.sender_id = u_send.id
            JOIN users u_recv ON m.receiver_id = u_recv.id
            WHERE m.sender_id = :uid OR m.receiver_id = :uid2
            ORDER BY m.created_at ASC
        ");
        $db->bind(':uid', Session::get('user_id'));
        $db->bind(':uid2', Session::get('user_id'));
        $chats = $db->resultSet();
        $this->view('student/messages', [
            'student' => $student,
            'teachers' => $teachers,
            'chats' => $chats
        ]);
    }
}
