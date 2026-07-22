<?php
/**
 * Website Controller for Public Landing Pages and Front Office Actions
 */
class WebsiteController extends Controller {
    private $academicModel;
    public function __construct() {
        $this->academicModel = $this->model('Academic');
    }
    public function index() {
        $data = [
            'title' => 'Aether Academy - High Tech School Management System',
            'settings' => $this->academicModel->getSettings()
        ];
        $this->view('website/home', $data);
    }
    public function about() {
        $this->view('website/about');
    }
    public function academics() {
        $this->view('website/academics');
    }
    public function admissions() {
        $request = new Request();
        if ($request->isPost()) {
            $data = $request->getBody();
            // Validate CSRF token
            if (!Session::validateCsrf($data['csrf_token'] ?? '')) {
                Session::flash('adm_err', 'CSRF verification failed.', 'alert alert-danger');
                Response::redirect('/admissions');
            }
            if ($this->academicModel->createAdmissionInquiry($data)) {
                Session::flash('adm_success', 'Admission application registered successfully! Our registrar will contact you shortly.', 'alert alert-success');
            } else {
                Session::flash('adm_err', 'Failed to submit application. Try again.', 'alert alert-danger');
            }
            Response::redirect('/admissions');
        } else {
            $classes = $this->academicModel->getClasses();
            $this->view('website/admissions', ['classes' => $classes]);
        }
    }
    public function contact() {
        $request = new Request();
        if ($request->isPost()) {
            // Mock contact mail submission
            Session::flash('contact_success', 'Thank you! Your message has been received.', 'alert alert-success');
            Response::redirect('/contact');
        } else {
            $this->view('website/contact');
        }
    }
    public function faq() {
        $this->view('website/faq');
    }
    public function noticeBoard() {
        $this->view('website/notice_board');
    }
}
