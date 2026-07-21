<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<!-- Stats Overview -->
<div class="row mb-5">
  <div class="col-md-6 mb-3">
    <div class="stat-card">
      <div class="stat-icon"><i class="fa-solid fa-users text-primary"></i></div>
      <div>
        <div class="stat-number"><?php echo $studentCount; ?></div>
        <div class="text-secondary small">Students Registered</div>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 mb-3">
    <div class="stat-card">
      <div class="stat-icon"><i class="fa-solid fa-graduation-cap text-gold"></i></div>
      <div>
        <div class="stat-number"><?php echo count($classes); ?></div>
        <div class="text-secondary small">Classes Assigned</div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="glass-card">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-school text-primary me-2"></i>My Class Divisions</h5>
      
      <div class="table-responsive">
        <table class="table table-glass">
          <thead>
            <tr>
              <th>Class Name</th>
              <th>Capacity</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($classes as $c): ?>
              <tr>
                <td><?php echo e($c->name); ?></td>
                <td><?php echo e($c->capacity); ?> Students</td>
                <td>
                  <a href="<?php echo URLROOT; ?>/portal/teacher/attendance?class_id=<?php echo $c->id; ?>" class="btn btn-sm btn-glow">
                    Open Attendance
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php require_once APPROOT . '/views/layouts/portal_footer.php'; ?>
