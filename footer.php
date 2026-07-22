 <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4">
          <h5 class="mb-3 text-white font-display"><i class="fa-solid fa-graduation-cap text-primary me-2"></i>Aether Academy</h5>
          <p class="text-secondary">Empowering future astrophysicists, computer scientists, and innovative engineers through next-generation immersive learning systems.</p>
        </div>
        <div class="col-md-2 mb-4">
          <h6 class="text-white mb-3">Links</h6>
          <a class="footer-link" href="<?php echo URLROOT; ?>/about">About Us</a>
          <a class="footer-link" href="<?php echo URLROOT; ?>/academics">Curriculum</a>
          <a class="footer-link" href="<?php echo URLROOT; ?>/admissions">Admissions</a>
          <a class="footer-link" href="<?php echo URLROOT; ?>/notice-board">Notice Board</a>
        </div>
        <div class="col-md-2 mb-4">
          <h6 class="text-white mb-3">Portals</h6>
          <a class="footer-link" href="<?php echo URLROOT; ?>/auth/login">Student Login</a>
          <a class="footer-link" href="<?php echo URLROOT; ?>/auth/login">Faculty Portal</a>
          <a class="footer-link" href="<?php echo URLROOT; ?>/auth/login">Parent Portal</a>
        </div>
        <div class="col-md-4 mb-4">
          <h6 class="text-white mb-3">Contact Details</h6>
          <p class="text-secondary"><i class="fa-solid fa-location-dot me-2 text-gold"></i> 101 Cybernetic Parkway, Neo City, CA</p>
          <p class="text-secondary"><i class="fa-solid fa-phone me-2 text-gold"></i> +1 (555) AETHER-0</p>
          <p class="text-secondary"><i class="fa-solid fa-envelope me-2 text-gold"></i> registrar@aether.edu</p>
        </div>
      </div>
      <hr class="border-secondary opacity-25">
      <div class="text-center text-secondary pt-3">
        <p>&copy; <?php echo date('Y'); ?> Aether Academy of Sciences. All rights reserved.</p>
      </div>
    </div>
  </footer>
  <!-- Core Javascript CDNs -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
  
  <!-- Project Scripts -->
  <script src="<?php echo URLROOT; ?>/assets/js/main.js"></script>
  <script src="<?php echo URLROOT; ?>/assets/js/three-scene.js"></script>
  
  <!-- PWA Service Worker Registration -->
  <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('<?php echo URLROOT; ?>/sw.js')
          .then(reg => console.log('Aether PWA Service Worker online.'))
          .catch(err => console.log('PWA Sw initialization failed.', err));
      });
    }
  </script>
</body>
</html>
