<?php
/**
 * Admin Panel Controller
 */
class AdminController extends Controller {
    private $studentModel;
    private $teacherModel;
    private $parentModel;
    private $academicModel;
    private $financeModel;
    public function __construct() {
        $this->studentModel = $this->model('Student');
        $this->teacherModel = $this->model('Teacher');
        $this->parentModel = $this->model('ParentModel');
        $this->academicModel = $this->model('Academic');
        $this->financeModel = $this->model('Finance');
    }
    public function dashboard() {
        $students = $this->studentModel->getAllStudents();
        $teachers = $this->teacherModel->getAllTeachers();
        $admissions = $this->academicModel->getAdmissions();
        $collections = $this->financeModel->getTotalCollections();
        $data = [
            'studentCount' => count($students),
            'teacherCount' => count($teachers),
            'admissionCount' => count($admissions),
            'totalRevenue' => $collections,
            'students' => array_slice($students, 0, 5),
            'admissions' => array_slice($admissions, 0, 5)
        ];
        $this->view('admin/dashboard', $data);
    }
    // Students CRUD
    public function students() {
        $students = $this->studentModel->getAllStudents();
        $classes = $this->academicModel->getClasses();
        $parents = $this->parentModel->getAllParents();
        
        $this->view('admin/students', [
            'students' => $students,
            'classes' => $classes,
            'parents' => $parents
        ]);
    }
    // Add Student
    public function addStudent() {
        $request = new Request();
        if ($request->isPost()) {
            $data = $request->getBody();
            if (!Session::validateCsrf($data['csrf_token'] ?? '')) {
                Session::flash('crud_err', 'CSRF validation failed.', 'alert alert-danger');
                Response::redirect('/portal/admin/students');
            }
            // Check email
            $userModel = $this->model('User');
            if ($userModel->findUserByEmail($data['email'])) {
                Session::flash('crud_err', 'Email already in use.', 'alert alert-danger');
                Response::redirect('/portal/admin/students');
            }
            // Create user
            $userId = $userModel->register([
                'username' => strtolower($data['first_name'] . $data['last_name']),
                'email' => $data['email'],
                'password' => 'student123', // Default
                'role' => 'student'
            ]);
            if ($userId) {
                $admissionNo = 'ADM' . date('Y') . str_pad($userId, 3, '0', STR_PAD_LEFT);
                $qrCode = 'QR_' . $data['first_name'] . $data['last_name'] . '_' . $admissionNo;
                
                $this->studentModel->createStudent([
                    'user_id' => $userId,
                    'parent_id' => $data['parent_id'],
                    'admission_no' => $admissionNo,
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'gender' => $data['gender'],
                    'dob' => $data['dob'],
                    'phone' => $data['phone'],
                    'address' => $data['address'],
                    'class_id' => $data['class_id'],
                    'qr_code' => $qrCode,
                    'enrollment_date' => date('Y-m-d'),
                    'status' => 'active'
                ]);
                Session::flash('crud_success', 'Student profile added successfully!', 'alert alert-success');
            } else {
                Session::flash('crud_err', 'Could not create student user account.', 'alert alert-danger');
            }
            Response::redirect('/portal/admin/students');
        }
    }
    // Delete student
    public function deleteStudent() {
        $request = new Request();
        if ($request->isPost()) {
            $data = $request->getBody();
            if ($this->studentModel->deleteStudent($data['id'], $data['user_id'])) {
                Session::flash('crud_success', 'Student profile removed.', 'alert alert-success');
            } else {
                Session::flash('crud_err', 'Deletion failed.', 'alert alert-danger');
            }
            Response::redirect('/portal/admin/students');
        }
    }
    // Settings panel
    public function settings() {
        $request = new Request();
        if ($request->isPost()) {
            $data = $request->getBody();
            if (!Session::validateCsrf($data['csrf_token'] ?? '')) {
                Session::flash('set_err', 'CSRF failed.', 'alert alert-danger');
                Response::redirect('/portal/admin/settings');
            }
            foreach ($data as $key => $val) {
                if ($key !== 'csrf_token') {
                    $this->academicModel->updateSetting($key, $val);
                }
            }
            Session::flash('set_success', 'Global system parameters saved!', 'alert alert-success');
            Response::redirect('/portal/admin/settings');
        } else {
            $settings = $this->academicModel->getSettings();
            $this->view('admin/settings', ['settings' => $settings]);
        }
    }
    // Database backup
    public function backup() {
        // Send simulated sql file download
        $filename = "aether_sms_backup_" . date('Ymd_His') . ".sql";
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        $db = new Database();
        $db->query("SHOW TABLES");
        $tables = $db->resultSet();
        echo "-- Aether SMS SQL Database Backup\n";
        echo "-- Generated on: " . date('Y-m-d H:i:s') . "\n\n";
        foreach ($tables as $table) {
            $prop = "Tables_in_" . DB_NAME;
            $tableName = $table->$prop;
            // Mock table structure output
            echo "DROP TABLE IF EXISTS `$tableName`;\n";
            echo "CREATE TABLE `$tableName` (\n  -- table structure placeholder\n);\n\n";
        }
        exit;
    }
}
