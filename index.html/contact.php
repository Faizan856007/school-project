<?php require_once APPROOT . '/views/layouts/header.php'; ?>
<section class="py-5" style="margin-top: 100px; min-height: 80vh; position: relative; z-index: 2;">
  <div class="container">
    <div class="text-center mb-5">
      <div class="badge bg-primary bg-opacity-25 text-primary border border-primary-subtle px-3 py-2 rounded-5 mb-3">
        Reach Out
      </div>
      <h1 class="font-display font-weight-800 text-white">Contact Our Team</h1>
      <p class="text-secondary col-md-6 mx-auto">Get in touch with our office administrators for immediate inquiries and site tours.</p>
    </div>
    <div class="row">
      <div class="col-md-5 mb-4">
        <div class="glass-card mb-4">
          <h4 class="text-white font-display mb-3">Office Location</h4>
          <p class="text-secondary mb-2"><i class="fa-solid fa-location-dot text-gold me-2"></i> 101 Cybernetic Parkway, Neo City, CA</p>
          <p class="text-secondary mb-2"><i class="fa-solid fa-phone text-gold me-2"></i> +1 (555) AETHER-0</p>
          <p class="text-secondary"><i class="fa-solid fa-envelope text-gold me-2"></i> info@aether.edu</p>
        </div>
        
        <!-- Google Map Iframe Mock -->
        <div class="glass-card p-0 overflow-hidden" style="height: 250px;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215234563456!2d-73.985428!3d40.748817" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
      <div class="col-md-7 mb-4">
        <div class="glass-card">
          <?php Session::flash('contact_success'); ?>
          <form action="<?php echo URLROOT; ?>/contact" method="POST">
            <?php echo Session::csrfTokenInput(); ?>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="text-secondary small mb-2">Your Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. John Doe" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="text-secondary small mb-2">Your Email</label>
                <input type="email" name="email" class="form-control" placeholder="e.g. john@example.com" required>
              </div>
              <div class="col-md-12 mb-3">
                <label class="text-secondary small mb-2">Subject</label>
                <input type="text" name="subject" class="form-control" placeholder="e.g. Course Admission Question" required>
              </div>
              <div class="col-md-12 mb-3">
                <label class="text-secondary small mb-2">Message</label>
                <textarea name="message" class="form-control" rows="5" placeholder="Write your inquiry here..." required></textarea>
              </div>
            </div>
            <div class="text-end mt-3">
              <button type="submit" class="btn btn-glow px-4 py-2">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once APPROOT . '/views/layouts/footer.php'; ?>
