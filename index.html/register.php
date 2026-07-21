<?php require_once APPROOT . '/views/layouts/header.php'; ?>
<section class="hero-section d-flex align-items-center justify-content-center" style="position: relative; z-index: 2;">
  <div class="aurora-circle-1"></div>
  <div class="aurora-circle-2"></div>
  <div class="container d-flex justify-content-center" style="margin-top: 50px;">
    <div class="glass-card p-4 p-md-5" style="width: 100%; max-width: 520px;">
      
      <div class="text-center mb-4">
        <i class="fa-solid fa-user-plus text-primary fs-1 mb-3"></i>
        <h3 class="font-display text-white">Create Parent Account</h3>
        <p class="text-secondary small">Register to track student attendance, academic marks and make fee payments.</p>
      </div>
      <?php Session::flash('reg_err'); ?>
      <form action="<?php echo URLROOT; ?>/auth/register" method="POST">
        <?php echo Session::csrfTokenInput(); ?>
        <input type="hidden" name="role" value="parent">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="text-secondary small mb-2">First Name</label>
            <input type="text" name="first_name" class="form-control" placeholder="Robert" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="text-secondary small mb-2">Last Name</label>
            <input type="text" name="last_name" class="form-control" placeholder="Downey" required>
          </div>
          <div class="col-md-12 mb-3">
            <label class="text-secondary small mb-2">Username</label>
            <input type="text" name="username" class="form-control" placeholder="robertd" required>
          </div>
          <div class="col-md-12 mb-3">
            <label class="text-secondary small mb-2">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="robert@example.com" required>
          </div>
          <div class="col-md-12 mb-3">
            <label class="text-secondary small mb-2">Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
          </div>
          <div class="col-md-12 mb-3">
            <label class="text-secondary small mb-2">Phone</label>
            <input type="text" name="phone" class="form-control" placeholder="+1 (555) 000-0000" required>
          </div>
        </div>
        <button type="submit" class="btn btn-glow w-100 py-3 mt-3 mb-3">
          Create Account
        </button>
        <div class="text-center">
          <p class="text-secondary small mb-0">Already registered? <a href="<?php echo URLROOT; ?>/auth/login" class="text-primary text-decoration-none">Login Portal</a></p>
        </div>
      </form>
    </div>
  </div>
</section>
<?php require_once APPROOT . '/views/layouts/footer.php'; ?>
