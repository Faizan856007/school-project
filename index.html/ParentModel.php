<?php
/**
 * Parent Model class
 */
class ParentModel {
    private $db;
    public function __construct() {
        $this->db = new Database();
    }
    // Get parent details by User ID
    public function getParentByUserId($userId) {
        $this->db->query("
            SELECT p.*, u.email, u.username 
            FROM parents p 
            JOIN users u ON p.user_id = u.id 
            WHERE p.user_id = :user_id
        ");
        $this->db->bind(':user_id', $userId);
        return $this->db->single();
    }
    // Get all parents for options/lookup
    public function getAllParents() {
        $this->db->query("SELECT * FROM parents ORDER BY last_name, first_name");
        return $this->db->resultSet();
    }
    // Get linked children for a parent
    public function getChildren($parentId) {
        $this->db->query("
            SELECT s.*, c.name as class_name 
            FROM students s
            LEFT JOIN classes c ON s.class_id = c.id
            WHERE s.parent_id = :parent_id
        ");
        $this->db->bind(':parent_id', $parentId);
        return $this->db->resultSet();
    }
    // Create parent record
    public function createParent($data) {
        $this->db->query("
            INSERT INTO parents (user_id, first_name, last_name, phone, address, occupation)
            VALUES (:user_id, :first_name, :last_name, :phone, :address, :occupation)
        ");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':occupation', $data['occupation']);
        return $this->db->execute();
    }
}
