<?php
/**
 * Auth Controller for Logging In, Registering, and Session Terminations
 */
class AuthController extends Controller {
    private $userModel;
    public function __construct() {
        $this->userModel = $this->model('User');
    }
    // Login page loader & POST receiver
    public function login() {
        if (Session::isLoggedIn()) {
            $this->redirectByRole(Session::get('user_role'));
        }
        $request = new Request();
        if ($request->isPost()) {
            $data = $request->getBody();
            
            // Validate CSRF
            if (!Session::validateCsrf($data['csrf_token'] ?? '')) {
                Session::flash('login_err', 'Security token invalid. Please try again.', 'alert alert-danger');
                $this->view('auth/login');
                return;
            }
            // Attempt login query
            $user = $this->userModel->login($data['email'], $data['password']);
            if ($user) {
                if ($user->status !== 'active') {
                    Session::flash('login_err', 'Your account has been deactivated.', 'alert alert-warning');
                    $this->view('auth/login');
                    return;
                }
                // Set session variables
                Session::set('user_id', $user->id);
                Session::set('username', $user->username);
                Session::set('user_email', $user->email);
                Session::set('user_role', $user->role);
                // Audit log
                $this->userModel->logActivity($user->id, 'Login', 'Successfully logged into the system.');
                // Redirect based on role
                $this->redirectByRole($user->role);
            } else {
                Session::flash('login_err', 'Invalid email or password credential combination.', 'alert alert-danger');
                $this->view('auth/login');
            }
        } else {
            $this->view('auth/login');
        }
    }
    // Log out action
    public function logout() {
        if (Session::isLoggedIn()) {
            $this->userModel->logActivity(Session::get('user_id'), 'Logout', 'Successfully logged out.');
        }
        Session::destroy();
        Response::redirect('/auth/login');
    }
    // Register loader & action
    public function register() {
        if (Session::isLoggedIn()) {
            $this->redirectByRole(Session::get('user_role'));
        }
        $request = new Request();
        if ($request->isPost()) {
            $data = $request->getBody();
            // Validate CSRF
            if (!Session::validateCsrf($data['csrf_token'] ?? '')) {
                Session::flash('reg_err', 'CSRF validation failed.', 'alert alert-danger');
                $this->view('auth/register');
                return;
            }
            // Check if email exists
            if ($this->userModel->findUserByEmail($data['email'])) {
                Session::flash('reg_err', 'This email is already registered.', 'alert alert-danger');
                $this->view('auth/register');
                return;
            }
            // Register parent or generic user role
            $userId = $this->userModel->register([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $data['role'] ?? 'parent',
                'status' => 'active'
            ]);
            if ($userId) {
                // If register is successful, create details profile based on role
                if (($data['role'] ?? 'parent') === 'parent') {
                    $parentModel = $this->model('ParentModel');
                    $parentModel->createParent([
                        'user_id' => $userId,
                        'first_name' => $data['first_name'] ?? 'John',
                        'last_name' => $data['last_name'] ?? 'Doe',
                        'phone' => $data['phone'] ?? '+1-555-0000',
                        'address' => $data['address'] ?? 'Neo City Address',
                        'occupation' => $data['occupation'] ?? 'Business Owner'
                    ]);
                }
                
                Session::flash('login_success', 'Account created! Please login now.', 'alert alert-success');
                Response::redirect('/auth/login');
            } else {
                Session::flash('reg_err', 'Failed to register account. Check database settings.', 'alert alert-danger');
                $this->view('auth/register');
            }
        } else {
            $this->view('auth/register');
        }
    }
    // Role redirects
    private function redirectByRole($role) {
        switch ($role) {
            case 'admin':
                Response::redirect('/portal/admin/dashboard');
                break;
            case 'teacher':
                Response::redirect('/portal/teacher/dashboard');
                break;
            case 'student':
                Response::redirect('/portal/student/dashboard');
                break;
            case 'parent':
                Response::redirect('/portal/parent/dashboard');
                break;
            default:
                Response::redirect('/');
        }
    }
}
