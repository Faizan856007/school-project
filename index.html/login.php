<?php require_once APPROOT . '/views/layouts/header.php'; ?>
<section class="hero-section d-flex align-items-center justify-content-center" style="position: relative; z-index: 2;">
  <!-- Aurora Background circular animations -->
  <div class="aurora-circle-1"></div>
  <div class="aurora-circle-2"></div>
  <div class="container d-flex justify-content-center" style="margin-top: 50px;">
    <div class="glass-card p-4 p-md-5" style="width: 100%; max-width: 480px;">
      
      <div class="text-center mb-4">
        <i class="fa-solid fa-shield-halved text-primary fs-1 mb-3"></i>
        <h3 class="font-display text-white">Security Gateway</h3>
        <p class="text-secondary small">Access the Aether Portal securely.</p>
      </div>
      <?php Session::flash('login_err'); ?>
      <?php Session::flash('login_success'); ?>
      <?php Session::flash('auth_error'); ?>
      <form action="<?php echo URLROOT; ?>/auth/login" method="POST">
        <?php echo Session::csrfTokenInput(); ?>
        <div class="mb-3">
          <label class="text-secondary small mb-2"><i class="fa-solid fa-envelope me-2"></i>Email Address</label>
          <input type="email" name="email" class="form-control" placeholder="username@aether.edu" required>
        </div>
        <div class="mb-4">
          <div class="d-flex justify-content-between">
            <label class="text-secondary small mb-2"><i class="fa-solid fa-lock me-2"></i>Password</label>
            <a href="<?php echo URLROOT; ?>/auth/forgot-password" class="small text-gold text-decoration-none">Forgot?</a>
          </div>
          <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-glow w-100 py-3 mb-3">
          Authenticate Credentials
        </button>
        <div class="text-center mt-3">
          <p class="text-secondary small">Demo Access: <b>student1@aether.edu</b> / <b>admin123</b></p>
          <p class="text-secondary small mb-0">No parent account? <a href="<?php echo URLROOT; ?>/auth/register" class="text-primary text-decoration-none font-weight-600">Register Parent</a></p>
        </div>
      </form>
    </div>
  </div>
</section>
<?php require_once APPROOT . '/views/layouts/footer.php'; ?>
