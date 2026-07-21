<?php
/**
 * Finance Model - Billing, Fees & Invoices
 */
class Finance {
    private $db;
    public function __construct() {
        $this->db = new Database();
    }
    // Get student fees statement
    public function getStudentFees($studentId) {
        $this->db->query("
            SELECT * FROM fees 
            WHERE student_id = :student_id 
            ORDER BY due_date DESC
        ");
        $this->db->bind(':student_id', $studentId);
        return $this->db->resultSet();
    }
    // Record fee payment invoice
    public function recordPayment($feeId, $method, $transactionId) {
        $this->db->query("
            UPDATE fees 
            SET status = 'paid', payment_method = :method, transaction_id = :tx_id, paid_at = CURRENT_TIMESTAMP 
            WHERE id = :id
        ");
        $this->db->bind(':method', $method);
        $this->db->bind(':tx_id', $transactionId);
        $this->db->bind(':id', $feeId);
        return $this->db->execute();
    }
    // Total collections (Admin Stat Dashboard)
    public function getTotalCollections() {
        $this->db->query("SELECT SUM(amount) as total FROM fees WHERE status = 'paid'");
        $result = $this->db->single();
        return $result->total ?? 0.00;
    }
}
