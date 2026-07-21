<?php require_once APPROOT . '/views/layouts/header.php'; ?>
<section class="py-5" style="margin-top: 100px; min-height: 80vh; position: relative; z-index: 2;">
  <div class="container">
    <div class="text-center mb-5">
      <div class="badge bg-primary bg-opacity-25 text-primary border border-primary-subtle px-3 py-2 rounded-5 mb-3">
        Apply Now
      </div>
      <h1 class="font-display font-weight-800 text-white">Online Admission Form</h1>
      <p class="text-secondary col-md-6 mx-auto">Fill in student and parent details to submit a formal application for the upcoming academic session.</p>
    </div>
    <div class="admission-form-wrapper">
      <div class="glass-card">
        <?php Session::flash('adm_success'); ?>
        <?php Session::flash('adm_err'); ?>
        <form action="<?php echo URLROOT; ?>/admissions" method="POST">
          <?php echo Session::csrfTokenInput(); ?>
          <h5 class="text-white font-display mb-4"><i class="fa-solid fa-user text-primary me-2"></i>Student Details</h5>
          <div class="row mb-4">
            <div class="col-md-6 mb-3">
              <label class="text-secondary small mb-2">First Name</label>
              <input type="text" name="first_name" class="form-control" placeholder="e.g. John" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="text-secondary small mb-2">Last Name</label>
              <input type="text" name="last_name" class="form-control" placeholder="e.g. Doe" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="text-secondary small mb-2">Date of Birth</label>
              <input type="date" name="dob" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="text-secondary small mb-2">Gender</label>
              <select name="gender" class="form-select" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label class="text-secondary small mb-2">Class Level</label>
              <select name="class_id" class="form-select" required>
                <?php foreach($classes as $class): ?>
                  <option value="<?php echo $class->id; ?>"><?php echo $class->name; ?></option>
                <?php endindex; // wait, php foreach ends with endforeach! Let's write standard endforeach. ?>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label class="text-secondary small mb-2">Student Email</label>
              <input type="email" name="email" class="form-control" placeholder="student@example.com" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="text-secondary small mb-2">Student Phone</label>
              <input type="text" name="phone" class="form-control" placeholder="+1 (555) 000-0000" required>
            </div>
            <div class="col-md-12 mb-3">
              <label class="text-secondary small mb-2">Home Address</label>
              <textarea name="address" class="form-control" rows="3" placeholder="Residential location details..." required></textarea>
            </div>
          </div>
          <hr class="border-secondary opacity-25 mb-4">
          <h5 class="text-white font-display mb-4"><i class="fa-solid fa-users text-primary me-2"></i>Parent / Guardian Details</h5>
          
          <div class="row mb-4">
            <div class="col-md-6 mb-3">
              <label class="text-secondary small mb-2">Parent First & Last Name</label>
              <input type="text" name="parent_name" class="form-control" placeholder="e.g. Robert Downey" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="text-secondary small mb-2">Parent Phone Number</label>
              <input type="text" name="parent_phone" class="form-control" placeholder="+1 (555) 019-2831" required>
            </div>
          </div>
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-glow btn-lg px-5">
              Submit Application
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php require_once APPROOT . '/views/layouts/footer.php'; ?>
