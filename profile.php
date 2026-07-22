<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row justify-content-center pt-4">
  <div class="col-md-6 d-flex flex-column align-items-center">
    
    <div class="student-id-card mb-4" id="print-area">
      <div class="id-card-content">
        <!-- Logo -->
        <h5 class="text-white font-display mb-4"><i class="fa-solid fa-graduation-cap text-primary me-2"></i>AETHER PASS</h5>
        
        <!-- Profile Pic -->
        <img class="profile-avatar mb-3" style="width: 100px; height: 100px; border-width: 3px;" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150" alt="Student Photo">
        
        <!-- Info -->
        <h4 class="text-white font-display m-0"><?php echo e($student->first_name . ' ' . $student->last_name); ?></h4>
        <div class="text-gold small font-weight-600 mb-3"><?php echo e($student->admission_no); ?></div>
        
        <!-- Meta grid -->
        <div class="row mb-4 text-start text-secondary border border-secondary border-opacity-10 rounded p-2 bg-dark bg-opacity-50">
          <div class="col-6 mb-2">
            <span class="small d-block text-muted">CLASS</span>
            <span class="text-white small font-weight-500"><?php echo e($student->class_name); ?></span>
          </div>
          <div class="col-6 mb-2">
            <span class="small d-block text-muted">DOB</span>
            <span class="text-white small font-weight-500"><?php echo e($student->dob); ?></span>
          </div>
          <div class="col-12">
            <span class="small d-block text-muted">PARENT CONTACT</span>
            <span class="text-white small font-weight-500"><?php echo e($student->parent_fname . ' ' . $student->parent_lname); ?></span>
          </div>
        </div>
        <!-- Student QR Scanner Code -->
        <div class="qr-code-img d-flex align-items-center justify-content-center">
          <i class="fa-solid fa-qrcode text-dark fs-1"></i>
        </div>
        <div class="text-secondary small font-weight-500">Scan for registrar validation</div>
      </div>
    </div>
    <button onclick="window.print()" class="btn btn-glow">
      <i class="fa-solid fa-print me-2"></i>Print Identity Card
    </button>
  </div>
</div>
<?php require_once APPROOT . '/views/layouts/portal_footer.php'; ?>