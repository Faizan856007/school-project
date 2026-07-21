<?php
/**
 * Register Routing rules inside the App instance
 */
function registerRoutes(App $app) {
    // ----------------------------------------
    // Public Website Routes
    // ----------------------------------------
    $app->get('/', ['WebsiteController', 'index']);
    $app->get('/about', ['WebsiteController', 'about']);
    $app->get('/academics', ['WebsiteController', 'academics']);
    $app->get('/admissions', ['WebsiteController', 'admissions']);
    $app->post('/admissions', ['WebsiteController', 'admissions']);
    $app->get('/contact', ['WebsiteController', 'contact']);
    $app->post('/contact', ['WebsiteController', 'contact']);
    $app->get('/faq', ['WebsiteController', 'faq']);
    $app->get('/notice-board', ['WebsiteController', 'noticeBoard']);
    // ----------------------------------------
    // Authentication Routes
    // ----------------------------------------
    $app->get('/auth/login', ['AuthController', 'login']);
    $app->post('/auth/login', ['AuthController', 'login']);
    $app->get('/auth/logout', ['AuthController', 'logout']);
    $app->get('/auth/register', ['AuthController', 'register']);
    $app->post('/auth/register', ['AuthController', 'register']);
    // ----------------------------------------
    // Student Portal Routes
    // ----------------------------------------
    $app->get('/portal/student/dashboard', ['StudentController', 'dashboard'], ['student']);
    $app->get('/portal/student/profile', ['StudentController', 'profile'], ['student']);
    $app->get('/portal/student/attendance', ['StudentController', 'attendance'], ['student']);
    $app->get('/portal/student/homework', ['StudentController', 'homework'], ['student']);
    $app->post('/portal/student/homework', ['StudentController', 'homework'], ['student']);
    $app->get('/portal/student/exams', ['StudentController', 'exams'], ['student']);
    $app->get('/portal/student/fees', ['StudentController', 'fees'], ['student']);
    $app->post('/portal/student/fees', ['StudentController', 'fees'], ['student']);
    $app->get('/portal/student/library', ['StudentController', 'library'], ['student']);
    $app->get('/portal/student/ai', ['StudentController', 'aiAssistant'], ['student']);
    $app->post('/portal/student/ask-ai', ['StudentController', 'askAi'], ['student']);
    $app->get('/portal/student/timetable', ['StudentController', 'timetable'], ['student']);
    $app->get('/portal/student/leave', ['StudentController', 'leaveRequest'], ['student']);
    $app->post('/portal/student/leave', ['StudentController', 'leaveRequest'], ['student']);
    $app->get('/portal/student/messages', ['StudentController', 'messages'], ['student']);
    $app->post('/portal/student/messages', ['StudentController', 'messages'], ['student']);
    // ----------------------------------------
    // Teacher Portal Routes
    // ----------------------------------------
    $app->get('/portal/teacher/dashboard', ['TeacherController', 'dashboard'], ['teacher']);
    $app->get('/portal/teacher/attendance', ['TeacherController', 'attendance'], ['teacher']);
    $app->post('/portal/teacher/attendance', ['TeacherController', 'attendance'], ['teacher']);
    $app->get('/portal/teacher/homework', ['TeacherController', 'homework'], ['teacher']);
    $app->post('/portal/teacher/homework', ['TeacherController', 'homework'], ['teacher']);
    $app->get('/portal/teacher/grade', ['TeacherController', 'gradeSubmissions'], ['teacher']);
    $app->post('/portal/teacher/grade', ['TeacherController', 'gradeSubmissions'], ['teacher']);
    $app->get('/portal/teacher/exams', ['TeacherController', 'examResults'], ['teacher']);
    $app->post('/portal/teacher/exams', ['TeacherController', 'examResults'], ['teacher']);
    // ----------------------------------------
    // Parent Portal Routes
    // ----------------------------------------
    $app->get('/portal/parent/dashboard', ['ParentController', 'dashboard'], ['parent']);
    $app->get('/portal/parent/results', ['ParentController', 'results'], ['parent']);
    $app->get('/portal/parent/fees', ['ParentController', 'fees'], ['parent']);
    // ----------------------------------------
    // Admin Control Panel Routes
    // ----------------------------------------
    $app->get('/portal/admin/dashboard', ['AdminController', 'dashboard'], ['admin']);
    $app->get('/portal/admin/students', ['AdminController', 'students'], ['admin']);
    $app->post('/portal/admin/students/add', ['AdminController', 'addStudent'], ['admin']);
    $app->post('/portal/admin/students/delete', ['AdminController', 'deleteStudent'], ['admin']);
    $app->get('/portal/admin/settings', ['AdminController', 'settings'], ['admin']);
    $app->post('/portal/admin/settings', ['AdminController', 'settings'], ['admin']);
    $app->get('/portal/admin/backup', ['AdminController', 'backup'], ['admin']);
}
