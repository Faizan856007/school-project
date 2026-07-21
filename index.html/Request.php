<?php
/**
 * Request Handler Class - Sanitization & Filtering
 */
class Request {
    
    // Get the request method
    public function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    // Check if request is POST
    public function isPost() {
        return $this->getMethod() === 'post';
    }
    // Check if request is GET
    public function isGet() {
        return $this->getMethod() === 'get';
    }
    // Sanitize and retrieve request body (POST/GET)
    public function getBody() {
        $body = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = $this->sanitize($value);
            }
        }
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                if (is_array($value)) {
                    $body[$key] = array_map([$this, 'sanitize'], $value);
                } else {
                    $body[$key] = $this->sanitize($value);
                }
            }
        }
        return $body;
    }
    // Direct value sanitizer
    private function sanitize($value) {
        if (is_string($value)) {
            return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
        }
        return $value;
    }
}
// Global safety function for Views (e.g. echo e($data))
function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
