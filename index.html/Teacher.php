<?php
/**
 * Teacher Model class
 */
class Teacher {
    private $db;
    public function __construct() {
        $this->db = new Database();
    }
    // Get teacher details by User ID
    public function getTeacherByUserId($userId) {
        $this->db->query("
            SELECT t.*, u.email, u.username 
            FROM teachers t 
            JOIN users u ON t.user_id = u.id 
            WHERE t.user_id = :user_id
        ");
        $this->db->bind(':user_id', $userId);
        return $this->db->single();
    }
    // Get teacher by ID
    public function getTeacherById($teacherId) {
        $this->db->query("
            SELECT t.*, u.email, u.username 
            FROM teachers t 
            JOIN users u ON t.user_id = u.id 
            WHERE t.id = :teacher_id
        ");
        $this->db->bind(':teacher_id', $teacherId);
        return $this->db->single();
    }
    // Get all teachers for Admin CRUD
    public function getAllTeachers() {
        $this->db->query("
            SELECT t.*, u.email 
            FROM teachers t
            JOIN users u ON t.user_id = u.id
            ORDER BY t.id DESC
        ");
        return $this->db->resultSet();
    }
    // Create teacher
    public function createTeacher($data) {
        $this->db->query("
            INSERT INTO teachers (user_id, employee_no, first_name, last_name, gender, dob, phone, address, qualification, specialization, joining_date, status)
            VALUES (:user_id, :employee_no, :first_name, :last_name, :gender, :dob, :phone, :address, :qualification, :specialization, :joining_date, :status)
        ");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':employee_no', $data['employee_no']);
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':qualification', $data['qualification']);
        $this->db->bind(':specialization', $data['specialization']);
        $this->db->bind(':joining_date', $data['joining_date']);
        $this->db->bind(':status', $data['status'] ?? 'active');
        return $this->db->execute();
    }
    // Update teacher
    public function updateTeacher($data) {
        $this->db->query("
            UPDATE teachers SET 
                first_name = :first_name,
                last_name = :last_name,
                gender = :gender,
                dob = :dob,
                phone = :phone,
                address = :address,
                qualification = :qualification,
                specialization = :specialization,
                status = :status
            WHERE id = :id
        ");
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':qualification', $data['qualification']);
        $this->db->bind(':specialization', $data['specialization']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }
    // Delete teacher
    public function deleteTeacher($id, $userId) {
        $this->db->query("DELETE FROM users WHERE id = :user_id");
        $this->db->bind(':user_id', $userId);
        return $this->db->execute();
    }
}
