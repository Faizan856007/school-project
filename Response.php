<?php
/**
 * Response Utility Class
 */
class Response {
    // Send JSON Response
    public static function json($data, $statusCode = 200) {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
    // Redirect to a specific URL
    public static function redirect($url) {
        header('Location: ' . URLROOT . $url);
        exit;
    }
}
