<?php
/**
 * Core Application Router Class
 */
class App {
    private $routes = [];
    // Register a GET route
    public function get($path, $callback, $roles = []) {
        $this->routes['get'][$path] = [
            'callback' => $callback,
            'roles' => $roles
        ];
    }
    // Register a POST route
    public function post($path, $callback, $roles = []) {
        $this->routes['post'][$path] = [
            'callback' => $callback,
            'roles' => $roles
        ];
    }
    // Run router matching
    public function run() {
        $request = new Request();
        $method = $request->getMethod();
        
        // Clean URL request
        $uri = $_SERVER['REQUEST_URI'];
        
        // Strip public folder root if present
        $base = URLROOT;
        if (strpos($uri, $base) === 0) {
            $uri = substr($uri, strlen($base));
        }
        
        // Strip query parameters
        $uri = explode('?', $uri)[0];
        if (empty($uri)) {
            $uri = '/';
        }
        // Default routing fallback to /
        if (!isset($this->routes[$method][$uri])) {
            // Render 404 page
            http_response_code(404);
            echo "<h1 style='text-align:center; color:#FF3E3E; margin-top: 20%; font-family: sans-serif;'>Aether SMS - 404 Page Not Found</h1>";
            exit;
        }
        $route = $this->routes[$method][$uri];
        $callback = $route['callback'];
        $roles = $route['roles'];
        // Enforce role permission checks if defined
        if (!empty($roles)) {
            Session::checkRole($roles);
        }
        // Call the controller action
        if (is_array($callback)) {
            $controllerName = $callback[0];
            $action = $callback[1];
            // Require controller file
            $controllerPath = APPROOT . '/controllers/' . $controllerName . '.php';
            if (file_exists($controllerPath)) {
                require_once $controllerPath;
                $controller = new $controllerName();
                $controller->$action();
            } else {
                die("Controller file not found: " . $controllerName);
            }
        }
    }
}
