<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title ?? 'Aether Academy'; ?></title>
  
  <!-- CSS assets -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  
  <!-- Theme style sheets -->
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/variables.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/main.css">
  
  <!-- PWA Manifest -->
  <link rel="manifest" href="<?php echo URLROOT; ?>/manifest.json">
</head>
<body>
  <!-- Custom Glow Cursor Ring -->
  <div id="custom-cursor"></div>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-glass">
    <div class="container">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>/">
        <i class="fa-solid fa-graduation-cap me-2 text-primary"></i>AETHER <span>ACADEMY</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/academics">Academics</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/admissions">Admissions</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/notice-board">Notice Board</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/contact">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>/faq">FAQ</a></li>
          
          <!-- Theme Toggle -->
          <li class="nav-item ms-2 me-3">
            <button id="theme-toggle" title="Toggle Light/Dark Theme">
              <i class="fa-solid fa-moon"></i>
            </button>
          </li>
          <!-- Auth CTA Button -->
          <li class="nav-item">
            <?php if(isset($_SESSION['user_id'])): ?>
              <a class="btn btn-glow" href="<?php echo URLROOT; ?>/auth/logout">
                <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
              </a>
            <?php else: ?>
              <a class="btn btn-glow" href="<?php echo URLROOT; ?>/auth/login">
                <i class="fa-solid fa-lock me-2"></i>Portal Login
              </a>
            <?php endif; ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
