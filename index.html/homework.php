<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row">
  <div class="col-md-12">
    <div class="glass-card">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-book-open text-primary me-2"></i>Class Homework Assignments</h5>
      
      <?php Session::flash('homework_success'); ?>
      <?php Session::flash('homework_err'); ?>
      <div class="table-responsive">
        <table class="table table-glass">
          <thead>
            <tr>
              <th>Subject</th>
              <th>Assignment Title</th>
              <th>Due Date</th>
              <th>Task File</th>
              <th>Your Submission</th>
              <th>Grade / Feedback</th>
              <th>Upload Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($homework as $hw): ?>
              <tr>
                <td class="align-middle"><?php echo e($hw->subject_name); ?></td>
                <td class="align-middle">
                  <div class="font-weight-600 text-white"><?php echo e($hw->title); ?></div>
                  <div class="text-secondary small mt-1"><?php echo e($hw->description); ?></div>
                </td>
                <td class="align-middle text-warning"><?php echo e($hw->due_date); ?></td>
                <td class="align-middle">
                  <?php if($hw->file_path): ?>
                    <a href="<?php echo URLROOT; ?>/<?php echo $hw->file_path; ?>" class="btn btn-sm btn-outline-light border border-secondary" download>
                      <i class="fa-solid fa-download"></i> Download Task
                    </a>
                  <?php else: ?>
                    No Attachments
                  <?php endif; ?>
                </td>
                <td class="align-middle">
                  <span class="badge-status <?php echo ($hw->submission_status) ? 'badge-present' : 'badge-late'; ?>">
                    <?php echo ucfirst($hw->submission_status ?? 'pending'); ?>
                  </span>
                </td>
                <td class="align-middle">
                  <?php if($hw->submission_status === 'graded'): ?>
                    <div class="text-success font-weight-600">Grade: <?php echo e($hw->grade); ?></div>
                    <div class="text-secondary small"><?php echo e($hw->feedback); ?></div>
                  <?php else: ?>
                    <span class="text-muted">Not graded</span>
                  <?php endif; ?>
                </td>
                <td class="align-middle">
                  <?php if($hw->submission_status !== 'graded'): ?>
                    <form action="<?php echo URLROOT; ?>/portal/student/homework" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
                      <?php echo Session::csrfTokenInput(); ?>
                      <input type="hidden" name="homework_id" value="<?php echo $hw->id; ?>">
                      <input type="file" name="homework_file" class="form-control form-control-sm" style="max-width: 150px;" required>
                      <button type="submit" class="btn btn-sm btn-glow">Submit</button>
                    </form>
                  <?php else: ?>
                    <span class="text-success small"><i class="fa-solid fa-circle-check me-1"></i>Graded</span>
                  <?php endif; ?>
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
