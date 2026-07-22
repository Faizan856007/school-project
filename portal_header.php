<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aether Portal - <?php echo ucfirst($_SESSION['user_role'] ?? 'User'); ?></title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/variables.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/dashboard.css">
  
  <!-- ChartJS & Exports -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
  <!-- Custom Cursor Ring -->
  <div id="custom-cursor"></div>
  <div class="dashboard-wrapper">
    <!-- Sidebar Navigation -->
    <div class="sidebar">
      <div class="sidebar-header">
        <a class="sidebar-logo" href="<?php echo URLROOT; ?>/">
          <i class="fa-solid fa-graduation-cap text-primary me-2"></i>AETHER <span>PORTAL</span>
        </a>
      </div>
      
      <ul class="sidebar-menu">
        <!-- Render Sidebar options dynamically based on User Role -->
        <?php 
        $role = $_SESSION['user_role'] ?? ''; 
        $active_uri = $_SERVER['REQUEST_URI'];
        ?>
        <?php if ($role === 'student'): ?>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/dashboard') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/student/dashboard">
              <i class="fa-solid fa-chart-line"></i><span>Dashboard</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/profile') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/student/profile">
              <i class="fa-solid fa-id-card"></i><span>Student ID Card</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/attendance') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/student/attendance">
              <i class="fa-solid fa-calendar-check"></i><span>Attendance</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/timetable') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/student/timetable">
              <i class="fa-solid fa-clock"></i><span>Timetable</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/homework') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/student/homework">
              <i class="fa-solid fa-book-open"></i><span>Homework</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/exams') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/student/exams">
              <i class="fa-solid fa-square-poll-vertical"></i><span>Exams & Results</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/fees') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/student/fees">
              <i class="fa-solid fa-credit-card"></i><span>Fees Statement</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/library') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/student/library">
              <i class="fa-solid fa-book-bookmark"></i><span>Library issues</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/leave') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/student/leave">
              <i class="fa-solid fa-envelope-open-text"></i><span>Leave Request</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/ai') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/student/ai">
              <i class="fa-solid fa-robot"></i><span>Aether AI Assistant</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/messages') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/student/messages">
              <i class="fa-solid fa-comments"></i><span>Teacher Messages</span>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($role === 'teacher'): ?>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/dashboard') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/teacher/dashboard">
              <i class="fa-solid fa-house"></i><span>Dashboard</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/attendance') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/teacher/attendance">
              <i class="fa-solid fa-calendar-check"></i><span>Mark Attendance</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/homework') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/teacher/homework">
              <i class="fa-solid fa-book"></i><span>Assignments Creator</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/exams') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/teacher/exams">
              <i class="fa-solid fa-square-poll-vertical"></i><span>Midterm Mark Entry</span>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($role === 'parent'): ?>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/dashboard') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/parent/dashboard">
              <i class="fa-solid fa-house"></i><span>Dashboard</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/results') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/parent/results">
              <i class="fa-solid fa-graduation-cap"></i><span>Child Performance</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/fees') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/parent/fees">
              <i class="fa-solid fa-wallet"></i><span>Fees Statement</span>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($role === 'admin'): ?>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/dashboard') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/admin/dashboard">
              <i class="fa-solid fa-gauge-high"></i><span>Admin Dashboard</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/students') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/admin/students">
              <i class="fa-solid fa-users"></i><span>Manage Students</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link <?php echo (strpos($active_uri, '/settings') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/portal/admin/settings">
              <i class="fa-solid fa-sliders"></i><span>Settings Panel</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="<?php echo URLROOT; ?>/portal/admin/backup">
              <i class="fa-solid fa-download"></i><span>Database Backup</span>
            </a>
          </li>
        <?php endif; ?>
      </ul>
      
      <div class="mt-auto">
        <a class="sidebar-link text-danger border border-danger-subtle bg-danger bg-opacity-10" href="<?php echo URLROOT; ?>/auth/logout">
          <i class="fa-solid fa-right-from-bracket"></i><span>Logout</span>
        </a>
      </div>
    </div>
    <!-- Main Workspace Container -->
    <div class="main-content">
      <!-- Topbar Header -->
      <div class="topbar">
        <div>
          <h2 class="font-display font-weight-600 m-0">Aether Portal</h2>
          <p class="text-secondary m-0">Welcome back, <?php echo e(Session::get('username')); ?>!</p>
        </div>
        <div class="user-profile-widget">
          <img class="profile-avatar" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150" alt="avatar">
          <div>
            <div class="font-weight-600 text-white"><?php echo e(Session::get('username')); ?></div>
            <div class="text-secondary small font-weight-500 text-capitalize"><?php echo e($role); ?></div>
          </div>
        </div>
      </div>
