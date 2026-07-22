<?php require_once APPROOT . '/views/layouts/header.php'; ?>
<!-- Hero Section with Three.js 3D canvas -->
<section class="hero-section">
  <!-- Glowing Background Blobs -->
  <div class="aurora-circle-1"></div>
  <div class="aurora-circle-2"></div>
  
  <!-- Interactive Three.js Viewport -->
  <div id="three-canvas-container"></div>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 hero-content text-start">
        <div class="badge bg-primary bg-opacity-25 text-primary border border-primary-subtle px-3 py-2 rounded-5 mb-4">
          <i class="fa-solid fa-atom me-2 animate-spin"></i>Welcome to Academic Innovation
        </div>
        <h1 class="hero-title">Shaping the Minds of Tomorrow</h1>
        <p class="text-secondary leading-relaxed mb-4">
          Aether Academy of Sciences integrates modern immersive curriculum, advanced research labs, and next-generation portal analytics tools to nurture future science and engineering leaders.
        </p>
        
        <div class="d-flex gap-3">
          <a href="<?php echo URLROOT; ?>/admissions" class="btn btn-glow btn-lg px-4 py-3">
            <i class="fa-solid fa-file-signature me-2"></i>Apply Online
          </a>
          <a href="<?php echo URLROOT; ?>/auth/login" class="btn btn-outline-secondary btn-lg border border-secondary border-opacity-25 text-white px-4 py-3 glass-card m-0" style="backdrop-filter: blur(10px)">
            <i class="fa-solid fa-right-to-bracket me-2"></i>Enter Portal
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Stats Grid -->
<section class="py-5" style="background: rgba(11, 13, 31, 0.4); position: relative; z-index: 2;">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-6 mb-4">
        <div class="glass-card text-center">
          <h2 class="text-white font-display font-weight-700">99.2%</h2>
          <p class="text-secondary mb-0">Graduation Rate</p>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-4">
        <div class="glass-card text-center">
          <h2 class="text-white font-display font-weight-700">1:8</h2>
          <p class="text-secondary mb-0">Faculty Student Ratio</p>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-4">
        <div class="glass-card text-center">
          <h2 class="text-white font-display font-weight-700">12+</h2>
          <p class="text-secondary mb-0">Astrophysics Labs</p>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-4">
        <div class="glass-card text-center">
          <h2 class="text-white font-display font-weight-700">1.2k+</h2>
          <p class="text-secondary mb-0">Alumni in SpaceX / NASA</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Core Features Section -->
<section class="py-5 my-5" style="position: relative; z-index: 2;">
  <div class="container">
    <h2 class="section-title">An Immersive Experience</h2>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="glass-card h-100">
          <div class="stat-icon mb-4"><i class="fa-solid fa-globe text-primary"></i></div>
          <h4 class="text-white font-display mb-3">Global Curriculum</h4>
          <p class="text-secondary">Fully aligned with global science institutions, ensuring accreditation with Ivy League standards.</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="glass-card h-100">
          <div class="stat-icon mb-4"><i class="fa-solid fa-brain text-gold"></i></div>
          <h4 class="text-white font-display mb-3">Cognitive Analytics</h4>
          <p class="text-secondary">AI-driven portals track progress, recommending subjects based on cognitive profiles.</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="glass-card h-100">
          <div class="stat-icon mb-4"><i class="fa-solid fa-shield-halved text-info"></i></div>
          <h4 class="text-white font-display mb-3">Secure Operations</h4>
          <p class="text-secondary">Role-based login portals, encrypted database connections, and secure transaction logs.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once APPROOT . '/views/layouts/footer.php'; ?>
