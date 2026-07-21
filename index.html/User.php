<?php
/**
 * User Model for Authentication and Role Settings
 */
class User {
    private $db;
    public function __construct() {
        $this->db = new Database();
    }
    // Login validation
    public function login($email, $password) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        if ($row) {
            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password)) {
                return $row;
            }
        }
        return false;
    }
    // Register user
    public function register($data) {
        $this->db->query("INSERT INTO users (username, email, password, role, status) VALUES (:username, :email, :password, :role, :status)");
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':status', $data['status'] ?? 'active');
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    // Find user by email
    public function findUserByEmail($email) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }
    // Get notifications for user
    public function getNotifications($userId) {
        $this->db->query("SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 10");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
    // Log user activity
    public function logActivity($userId, $action, $details) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $this->db->query("INSERT INTO activity_logs (user_id, action, details, ip_address) VALUES (:user_id, :action, :details, :ip)");
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':action', $action);
        $this->db->bind(':details', $details);
        $this->db->bind(':ip', $ip);
        $this->db->execute();
    }
}
