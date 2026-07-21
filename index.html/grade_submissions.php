<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row">
  <div class="col-md-12">
    <div class="glass-card">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-list-check text-primary me-2"></i>Review Submitted Papers</h5>
      
      <?php Session::flash('grade_success'); ?>
      <div class="table-responsive">
        <table class="table table-glass">
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Admission No</th>
              <th>Date Submitted</th>
              <th>Paper Attachment</th>
              <th>Score Status</th>
              <th>Score Entry</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($submissions as $sub): ?>
              <tr>
                <td class="align-middle text-white font-weight-600"><?php echo e($sub->first_name . ' ' . $sub->last_name); ?></td>
                <td class="align-middle"><?php echo e($sub->admission_no); ?></td>
                <td class="align-middle text-secondary"><?php echo e($sub->submission_date); ?></td>
                <td class="align-middle">
                  <a href="<?php echo URLROOT; ?>/<?php echo $sub->file_path; ?>" class="btn btn-sm btn-outline-light border border-secondary" download>
                    <i class="fa-solid fa-file-pdf"></i> Download Paper
                  </a>
                </td>
                <td class="align-middle">
                  <span class="badge-status <?php echo ($sub->status === 'graded') ? 'badge-present' : 'badge-late'; ?>">
                    <?php echo ucfirst($sub->status); ?>
                  </span>
                  <?php if($sub->status === 'graded'): ?>
                    <div class="text-success font-weight-600 mt-1">Grade: <?php echo e($sub->grade); ?></div>
                  <?php endif; ?>
                </td>
                <td class="align-middle">
                  <button class="btn btn-sm btn-glow" data-bs-toggle="modal" data-bs-target="#gradeModal-<?php echo $sub->id; ?>">
                    Enter Grades
                  </button>
                  <!-- Grading Modal -->
                  <div class="modal fade" id="gradeModal-<?php echo $sub->id; ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content glass-card border border-primary p-4" style="background: var(--bg-dark);">
                        <div class="modal-header border-0 pb-0">
                          <h5 class="modal-title text-white font-display">Grade Submission</h5>
                          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="<?php echo URLROOT; ?>/portal/teacher/grade?homework_id=<?php echo $homeworkId; ?>" method="POST">
                          <input type="hidden" name="submission_id" value="<?php echo $sub->id; ?>">
                          <input type="hidden" name="homework_id" value="<?php echo $homeworkId; ?>">
                          
                          <div class="modal-body border-0 text-start">
                            <div class="mb-3">
                              <label class="text-secondary small mb-2">Grade Score (e.g. A+, B, 95)</label>
                              <input type="text" name="grade" class="form-control" value="<?php echo e($sub->grade); ?>" required>
                            </div>
                            <div class="mb-3">
                              <label class="text-secondary small mb-2">Feedback / Comments</label>
                              <textarea name="feedback" class="form-control" rows="3" required><?php echo e($sub->feedback); ?></textarea>
                            </div>
                          </div>
                          <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-glow w-100 py-3">Submit Score Card</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php if(empty($submissions)): ?>
              <tr>
                <td colspan="6" class="text-center text-secondary">No papers submitted by student lists yet.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      
      <div class="mt-4">
        <a href="<?php echo URLROOT; ?>/portal/teacher/homework" class="btn btn-outline-light border border-secondary"><i class="fa-solid fa-chevron-left me-2"></i>Back to homework</a>
      </div>
    </div>
  </div>
</div>
<?php require_once APPROOT . '/views/layouts/portal_footer.php'; ?>
