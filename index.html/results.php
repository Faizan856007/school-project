<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row">
  <div class="col-md-12">
    <div class="glass-card mb-4">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-graduation-cap text-primary me-2"></i>Select Child Profile</h5>
      <div class="d-flex gap-2">
        <?php foreach($children as $ch): ?>
          <a href="<?php echo URLROOT; ?>/portal/parent/results?student_id=<?php echo $ch->id; ?>" class="btn <?php echo ($ch->id == $selectedChildId) ? 'btn-glow' : 'btn-outline-secondary text-white'; ?>">
            <?php echo e($ch->first_name . ' ' . $ch->last_name); ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php if($selectedChildId): ?>
      <div class="glass-card">
        <h5 class="text-white font-display mb-4"><i class="fa-solid fa-square-poll-vertical text-gold me-2"></i>Child Report Card</h5>
        
        <div class="table-responsive">
          <table class="table table-glass">
            <thead>
              <tr>
                <th>Exam Name</th>
                <th>Subject Course</th>
                <th>Marks Obtained</th>
                <th>Max Marks</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($results as $res): ?>
                <tr>
                  <td><?php echo e($res->exam_name); ?></td>
                  <td><?php echo e($res->subject_name); ?></td>
                  <td class="font-weight-600 text-success"><?php echo e($res->marks_obtained); ?></td>
                  <td><?php echo e($res->max_marks); ?></td>
                  <td><?php echo e($res->remarks ?? '--'); ?></td>
                </tr>
              <?php endforeach; ?>
              <?php if(empty($results)): ?>
                <tr>
                  <td colspan="5" class="text-center text-secondary">No exam results published for this student.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php require_once APPROOT . '/views/layouts/portal_footer.php'; ?>