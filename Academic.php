<?php
/**
 * Academic Model - Classes, Sections, Subjects, Admissions
 */
class Academic {
    private $db;
    public function __construct() {
        $this->db = new Database();
    }
    // Get all classes
    public function getClasses() {
        $this->db->query("SELECT * FROM classes ORDER BY name");
        return $this->db->resultSet();
    }
    // Get subjects for a class
    public function getSubjectsByClass($classId) {
        $this->db->query("
            SELECT s.*, cs.class_id, t.first_name as teacher_fname, t.last_name as teacher_lname
            FROM subjects s
            JOIN class_subjects cs ON s.id = cs.subject_id
            LEFT JOIN teachers t ON s.teacher_id = t.id
            WHERE cs.class_id = :class_id
        ");
        $this->db->bind(':class_id', $classId);
        return $this->db->resultSet();
    }
    // Create online admission inquiry
    public function createAdmissionInquiry($data) {
        $this->db->query("
            INSERT INTO admissions (first_name, last_name, dob, gender, email, phone, address, class_id, parent_name, parent_phone)
            VALUES (:first_name, :last_name, :dob, :gender, :email, :phone, :address, :class_id, :parent_name, :parent_phone)
        ");
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':class_id', $data['class_id']);
        $this->db->bind(':parent_name', $data['parent_name']);
        $this->db->bind(':parent_phone', $data['parent_phone']);
        return $this->db->execute();
    }
    // Get all admission inquiries
    public function getAdmissions() {
        $this->db->query("
            SELECT a.*, c.name as class_name 
            FROM admissions a
            LEFT JOIN classes c ON a.class_id = c.id
            ORDER BY a.id DESC
        ");
        return $this->db->resultSet();
    }
    // Update system settings
    public function updateSetting($key, $value) {
        $this->db->query("INSERT INTO system_settings (setting_key, setting_value) VALUES (:key, :value) ON DUPLICATE KEY UPDATE setting_value = :value2");
        $this->db->bind(':key', $key);
        $this->db->bind(':value', $value);
        $this->db->bind(':value2', $value);
        return $this->db->execute();
    }
    // Get all settings
    public function getSettings() {
        $this->db->query("SELECT * FROM system_settings");
        $rows = $this->db->resultSet();
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row->setting_key] = $row->setting_value;
        }
        return $settings;
    }
}
