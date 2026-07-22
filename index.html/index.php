<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('SITE_NAME', 'Greenfield School');
define('BASE_URL', '');

function e($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function isLoggedIn() {
    return false;
}
?>


<?php
/**
 * Aether SMS - Front Controller & Application Entry Point
 */
// Load Configuration
require_once dirname(dirname(__FILE__)) . '/app/config/config.php';
// Load Core MVC Engine Classes
require_once APPROOT . '/core/App.php';
require_once APPROOT . '/core/Database.php';
require_once APPROOT . '/core/Session.php';
require_once APPROOT . '/core/Request.php';
require_once APPROOT . '/core/Response.php';
// Load Base Controller
require_once APPROOT . '/controllers/Controller.php';
// Initialize Session Security
Session::init();
// Initialize Router & Routes
$app = new App();
require_once APPROOT . '/config/routes.php';
registerRoutes($app);
// Dispatch requests
$app->run();
?>
