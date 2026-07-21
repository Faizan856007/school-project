<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row">
  <div class="col-md-5 mb-4">
    <div class="glass-card">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-file-signature text-primary me-2"></i>Apply for Leave</h5>
      
      <?php Session::flash('leave_success'); ?>
      <?php Session::flash('leave_err'); ?>
      <form action="<?php echo URLROOT; ?>/portal/student/leave" method="POST">
        <?php echo Session::csrfTokenInput(); ?>
        
        <div class="mb-3">
          <label class="text-secondary small mb-2">Start Date</label>
          <input type="date" name="start_date" class="form-control" required>
        </div>
        
        <div class="mb-3">
          <label class="text-secondary small mb-2">End Date</label>
          <input type="date" name="end_date" class="form-control" required>
        </div>
        <div class="mb-4">
          <label class="text-secondary small mb-2">Reason for Absence</label>
          <textarea name="reason" class="form-control" rows="4" placeholder="Explain the reason for leave..." required></textarea>
        </div>
        <button type="submit" class="btn btn-glow w-100 py-3">Submit Application</button>
      </form>
    </div>
  </div>
  <div class="col-md-7 mb-4">
    <div class="glass-card">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-clock-rotate-left text-gold me-2"></i>Leave Applications History</h5>
      
      <div class="table-responsive">
        <table class="table table-glass">
          <thead>
            <tr>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Reason</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($leaves as $lv): ?>
              <tr>
                <td><?php echo e($lv->start_date); ?></td>
                <td><?php echo e($lv->end_date); ?></td>
                <td><?php echo e($lv->reason); ?></td>
                <td>
                  <span class="badge-status <?php 
                    if($lv->status === 'approved') echo 'badge-present';
                    elseif($lv->status === 'pending') echo 'badge-late';
                    else echo 'badge-absent';
                  ?>">
                    <?php echo ucfirst($lv->status); ?>
                  </span>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php if(empty($leaves)): ?>
              <tr>
                <td colspan="4" class="text-center text-secondary">No leave requests filed yet.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php require_once APPROOT . '/views/layouts/portal_footer.php'; ?>
