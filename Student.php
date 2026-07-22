<?php
/**
 * Student Model class
 */
class Student {
    private $db;
    public function __construct() {
        $this->db = new Database();
    }
    // Get student details by User ID
    public function getStudentByUserId($userId) {
        $this->db->query("
            SELECT s.*, u.email, u.username, c.name as class_name, p.first_name as parent_fname, p.last_name as parent_lname 
            FROM students s 
            JOIN users u ON s.user_id = u.id 
            LEFT JOIN classes c ON s.class_id = c.id
            LEFT JOIN parents p ON s.parent_id = p.id
            WHERE s.user_id = :user_id
        ");
        $this->db->bind(':user_id', $userId);
        return $this->db->single();
    }
    // Get student details by Student ID
    public function getStudentById($studentId) {
        $this->db->query("
            SELECT s.*, u.email, u.username, c.name as class_name, p.first_name as parent_fname, p.last_name as parent_lname 
            FROM students s 
            JOIN users u ON s.user_id = u.id 
            LEFT JOIN classes c ON s.class_id = c.id
            LEFT JOIN parents p ON s.parent_id = p.id
            WHERE s.id = :student_id
        ");
        $this->db->bind(':student_id', $studentId);
        return $this->db->single();
    }
    // Get all students for Admin CRUD
    public function getAllStudents() {
        $this->db->query("
            SELECT s.*, c.name as class_name, u.email 
            FROM students s
            JOIN users u ON s.user_id = u.id
            LEFT JOIN classes c ON s.class_id = c.id
            ORDER BY s.id DESC
        ");
        return $this->db->resultSet();
    }
    // Create student
    public function createStudent($data) {
        $this->db->query("
            INSERT INTO students (user_id, parent_id, admission_no, first_name, last_name, gender, dob, phone, address, class_id, qr_code, enrollment_date, status)
            VALUES (:user_id, :parent_id, :admission_no, :first_name, :last_name, :gender, :dob, :phone, :address, :class_id, :qr_code, :enrollment_date, :status)
        ");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':parent_id', $data['parent_id']);
        $this->db->bind(':admission_no', $data['admission_no']);
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':class_id', $data['class_id']);
        $this->db->bind(':qr_code', $data['qr_code']);
        $this->db->bind(':enrollment_date', $data['enrollment_date']);
        $this->db->bind(':status', $data['status'] ?? 'active');
        return $this->db->execute();
    }
    // Update student
    public function updateStudent($data) {
        $this->db->query("
            UPDATE students SET 
                parent_id = :parent_id,
                first_name = :first_name,
                last_name = :last_name,
                gender = :gender,
                dob = :dob,
                phone = :phone,
                address = :address,
                class_id = :class_id,
                status = :status
            WHERE id = :id
        ");
        $this->db->bind(':parent_id', $data['parent_id']);
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':class_id', $data['class_id']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }
    // Delete student
    public function deleteStudent($id, $userId) {
        // Delete user (cascade will handle student table deletion if database matches, but let's do it safely)
        $this->db->query("DELETE FROM users WHERE id = :user_id");
        $this->db->bind(':user_id', $userId);
        return $this->db->execute();
    }
}
