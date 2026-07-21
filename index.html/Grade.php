<?php
/**
 * Grade Model Class - Homework, Exams, and Results
 */
class Grade {
    private $db;
    public function __construct() {
        $this->db = new Database();
    }
    // Get homework for student class
    public function getStudentHomework($classId) {
        $this->db->query("
            SELECT h.*, sub.name as subject_name, sub.code as subject_code, t.first_name as teacher_fname, t.last_name as teacher_lname, hs.status as submission_status, hs.grade, hs.feedback
            FROM homework h
            JOIN subjects sub ON h.subject_id = sub.id
            JOIN teachers t ON h.teacher_id = t.id
            LEFT JOIN homework_submissions hs ON h.id = hs.homework_id AND hs.student_id = :student_id
            WHERE h.class_id = :class_id
            ORDER BY h.due_date ASC
        ");
        $this->db->bind(':class_id', $classId);
        // Note: we bind student ID relative to session in controller or pass it. Let's pass student ID as param to support this properly.
    }
    // Fixed version:
    public function getStudentHomeworkWithSubmission($classId, $studentId) {
        $this->db->query("
            SELECT h.*, sub.name as subject_name, sub.code as subject_code, t.first_name as teacher_fname, t.last_name as teacher_lname, 
                   hs.status as submission_status, hs.grade, hs.feedback, hs.submission_date, hs.file_path as submission_file
            FROM homework h
            JOIN subjects sub ON h.subject_id = sub.id
            JOIN teachers t ON h.teacher_id = t.id
            LEFT JOIN homework_submissions hs ON h.id = hs.homework_id AND hs.student_id = :student_id
            WHERE h.class_id = :class_id
            ORDER BY h.due_date DESC
        ");
        $this->db->bind(':class_id', $classId);
        $this->db->bind(':student_id', $studentId);
        return $this->db->resultSet();
    }
    // Submit homework
    public function submitHomework($homeworkId, $studentId, $filePath) {
        $this->db->query("
            INSERT INTO homework_submissions (homework_id, student_id, file_path, status)
            VALUES (:homework_id, :student_id, :file_path, 'submitted')
            ON DUPLICATE KEY UPDATE file_path = :file_path2, submission_date = CURRENT_TIMESTAMP, status = 'submitted'
        ");
        $this->db->bind(':homework_id', $homeworkId);
        $this->db->bind(':student_id', $studentId);
        $this->db->bind(':file_path', $filePath);
        $this->db->bind(':file_path2', $filePath);
        return $this->db->execute();
    }
    // Create homework assignment (Teacher action)
    public function createHomework($data) {
        $this->db->query("
            INSERT INTO homework (class_id, subject_id, teacher_id, title, description, due_date, file_path)
            VALUES (:class_id, :subject_id, :teacher_id, :title, :description, :due_date, :file_path)
        ");
        $this->db->bind(':class_id', $data['class_id']);
        $this->db->bind(':subject_id', $data['subject_id']);
        $this->db->bind(':teacher_id', $data['teacher_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':due_date', $data['due_date']);
        $this->db->bind(':file_path', $data['file_path']);
        return $this->db->execute();
    }
    // Get exam results for student
    public function getStudentResults($studentId) {
        $this->db->query("
            SELECT er.*, ex.name as exam_name, ex.type as exam_type, ex.max_marks, ex.date as exam_date, sub.name as subject_name, sub.code as subject_code
            FROM exam_results er
            JOIN exams ex ON er.exam_id = ex.id
            JOIN subjects sub ON ex.subject_id = sub.id
            WHERE er.student_id = :student_id
            ORDER BY ex.date DESC
        ");
        $this->db->bind(':student_id', $studentId);
        return $this->db->resultSet();
    }
    // Get exams list for a class (Teacher/Student view)
    public function getExamsByClass($classId) {
        $this->db->query("
            SELECT ex.*, sub.name as subject_name 
            FROM exams ex
            JOIN subjects sub ON ex.subject_id = sub.id
            WHERE ex.class_id = :class_id
            ORDER BY ex.date DESC
        ");
        $this->db->bind(':class_id', $classId);
        return $this->db->resultSet();
    }
    // Get submissions for grading
    public function getSubmissionsByHomework($homeworkId) {
        $this->db->query("
            SELECT hs.*, s.first_name, s.last_name, s.admission_no
            FROM homework_submissions hs
            JOIN students s ON hs.student_id = s.id
            WHERE hs.homework_id = :homework_id
        ");
        $this->db->bind(':homework_id', $homeworkId);
        return $this->db->resultSet();
    }
    // Grade submission
    public function gradeSubmission($submissionId, $grade, $feedback) {
        $this->db->query("
            UPDATE homework_submissions 
            SET status = 'graded', grade = :grade, feedback = :feedback 
            WHERE id = :id
        ");
        $this->db->bind(':grade', $grade);
        $this->db->bind(':feedback', $feedback);
        $this->db->bind(':id', $submissionId);
        return $this->db->execute();
    }
}
