<?php
/**
 * Session Management & Security Operations (CSRF + Auth Redirections)
 */
class Session {
    public static function init() {
        if (session_status() == PHP_SESSION_NONE) {
            // Configure secure cookies
            ini_set('session.cookie_httponly', 1);
            ini_set('session.use_only_cookies', 1);
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                ini_set('session.cookie_secure', 1);
            }
            session_start();
        }
        // Generate CSRF token if not set
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }
    // Set Session values
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    // Get Session values
    public static function get($key) {
        return $_SESSION[$key] ?? null;
    }
    // Destroy Session
    public static function destroy() {
        session_unset();
        session_destroy();
    }
    // CSRF Input Token Tag generator
    public static function csrfTokenInput() {
        return '<input type="hidden" name="csrf_token" value="' . ($_SESSION['csrf_token'] ?? '') . '">';
    }
    // CSRF Token Check
    public static function validateCsrf($token) {
        return hash_equals($_SESSION['csrf_token'] ?? '', $token ?? '');
    }
    // Set flash message
    public static function flash($name = '', $message = '', $class = 'alert alert-success') {
        if (!empty($name)) {
            if (!empty($message) && empty($_SESSION[$name])) {
                if (!empty($_SESSION[$name])) {
                    unset($_SESSION[$name]);
                }
                if (!empty($_SESSION[$name . '_class'])) {
                    unset($_SESSION[$name . '_class']);
                }
                $_SESSION[$name] = $message;
                $_SESSION[$name . '_class'] = $class;
            } elseif (empty($message) && !empty($_SESSION[$name])) {
                $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
                echo '<div class="' . $class . ' alert-dismissible fade show" role="alert" id="msg-flash">' 
                     . $_SESSION[$name] . 
                     '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_class']);
            }
        }
    }
    // Check if user is logged in
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    // Check user role
    public static function checkRole($roles = []) {
        if (!self::isLoggedIn()) {
            Response::redirect('/auth/login');
        }
        $userRole = self::get('user_role');
        if (!in_array($userRole, $roles)) {
            self::flash('auth_error', 'Unauthorized access to portal.', 'alert alert-danger');
            Response::redirect('/auth/login');
        }
    }
}
