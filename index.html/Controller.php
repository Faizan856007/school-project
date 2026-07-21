<?php
/**
 * Base Controller Class
 */
class Controller {
    // Load model
    public function model($model) {
        $modelPath = APPROOT . '/models/' . $model . '.php';
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        } else {
            die("Model file not found: " . $model);
        }
    }
    // Load view
    public function view($view, $data = []) {
        $viewPath = APPROOT . '/views/' . $view . '.php';
        if (file_exists($viewPath)) {
            // Extract data array to local variables
            extract($data);
            require_once $viewPath;
        } else {
            die("View file not found: " . $view);
        }
    }
}
<?php
/**
 * Parent Portal Controller
 */
class ParentController extends Controller {
    private $parentModel;
    private $attendanceModel;
    private $gradeModel;
    private $financeModel;
    public function __construct() {
        $this->parentModel = $this->model('ParentModel');
        $this->attendanceModel = $this->model('Attendance');
        $this->gradeModel = $this->model('Grade');
        $this->financeModel = $this->model('Finance');
    }
    private function getParentSession() {
        $userId = Session::get('user_id');
        $parent = $this->parentModel->getParentByUserId($userId);
        if (!$parent) {
            Session::flash('auth_error', 'Profile not found.', 'alert alert-danger');
            Response::redirect('/auth/login');
        }
        return $parent;
    }
    public function dashboard() {
        $parent = $this->getParentSession();
        $children = $this->parentModel->getChildren($parent->id);
        
        $childrenData = [];
        foreach ($children as $child) {
            $attendanceRate = $this->attendanceModel->getAttendanceStats($child->id);
            $fees = $this->financeModel->getStudentFees($child->id);
            
            $childrenData[] = [
                'profile' => $child,
                'attendanceRate' => $attendanceRate,
                'fees' => $fees
            ];
        }
        $this->view('parent/dashboard', [
            'parent' => $parent,
            'children' => $childrenData
        ]);
    }
    public function results() {
        $parent = $this->getParentSession();
        $children = $this->parentModel->getChildren($parent->id);
        
        $selectedChildId = $_GET['student_id'] ?? ($children[0]->id ?? null);
        $results = [];
        if ($selectedChildId) {
            $results = $this->gradeModel->getStudentResults($selectedChildId);
        }
        $this->view('parent/results', [
            'parent' => $parent,
            'children' => $children,
            'selectedChildId' => $selectedChildId,
            'results' => $results
        ]);
    }
    public function fees() {
        $parent = $this->getParentSession();
        $children = $this->parentModel->getChildren($parent->id);
        
        $selectedChildId = $_GET['student_id'] ?? ($children[0]->id ?? null);
        $fees = [];
        if ($selectedChildId) {
            $fees = $this->financeModel->getStudentFees($selectedChildId);
        }
        $this->view('parent/fees', [
            'parent' => $parent,
            'children' => $children,
            'selectedChildId' => $selectedChildId,
            'fees' => $fees
        ]);
    }
}