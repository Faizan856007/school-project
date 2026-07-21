<?php require_once APPROOT . '/views/layouts/header.php'; ?>
<section class="py-5" style="margin-top: 100px; min-height: 80vh; position: relative; z-index: 2;">
  <div class="container">
    <div class="text-center mb-5">
      <div class="badge bg-primary bg-opacity-25 text-primary border border-primary-subtle px-3 py-2 rounded-5 mb-3">
        Campus Feed
      </div>
      <h1 class="font-display font-weight-800 text-white">Notice Board</h1>
      <p class="text-secondary col-md-6 mx-auto">Latest updates, schedules, and important releases for students, parents, and faculties.</p>
    </div>
    <div class="row">
      <div class="col-md-12 mb-4">
        <div class="glass-card mb-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="badge bg-primary">Academic Notice</span>
            <span class="text-secondary small"><i class="fa-solid fa-calendar me-2"></i>July 17, 2026</span>
          </div>
          <h4 class="text-white font-display mb-2">Midterm Term Examinations Schedule Released</h4>
          <p class="text-secondary mb-0">The official schedule for first-term assessments across Grade 10 to 12 is live. Students can check exact times under their exam dashboards.</p>
        </div>
        
        <div class="glass-card">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="badge bg-warning text-dark font-weight-600">Events Notice</span>
            <span class="text-secondary small"><i class="fa-solid fa-calendar me-2"></i>July 12, 2026</span>
          </div>
          <h4 class="text-white font-display mb-2">Quantum Robotics Exhibition - Aether 2026</h4>
          <p class="text-secondary mb-0">Our robotics department is hosting a live exhibition showing drone swarm controllers on July 25th in the grand assembly hall. Parents and guests are welcome!</p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once APPROOT . '/views/layouts/footer.php'; ?>
