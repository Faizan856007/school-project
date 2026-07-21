<?php require_once APPROOT . '/views/layouts/header.php'; ?>
<section class="hero-section d-flex align-items-center justify-content-center" style="position: relative; z-index: 2;">
  <div class="aurora-circle-1"></div>
  <div class="aurora-circle-2"></div>
  <div class="container d-flex justify-content-center" style="margin-top: 50px;">
    <div class="glass-card p-4 p-md-5" style="width: 100%; max-width: 480px;">
      
      <div class="text-center mb-4">
        <i class="fa-solid fa-key text-primary fs-1 mb-3"></i>
        <h3 class="font-display text-white">Reset Password</h3>
        <p class="text-secondary small">Enter your email to receive recovery instructions.</p>
      </div>
      <form action="<?php echo URLROOT; ?>/auth/login" method="GET">
        <div class="mb-4">
          <label class="text-secondary small mb-2"><i class="fa-solid fa-envelope me-2"></i>Email Address</label>
          <input type="email" name="email" class="form-control" placeholder="username@aether.edu" required>
        </div>
        <button type="submit" class="btn btn-glow w-100 py-3 mb-3">
          Send Recovery Code
        </button>
        <div class="text-center">
          <a href="<?php echo URLROOT; ?>/auth/login" class="small text-secondary text-decoration-none"><i class="fa-solid fa-chevron-left me-2"></i>Back to Security Gateway</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php require_once APPROOT . '/views/layouts/footer.php'; ?>
