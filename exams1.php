<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row">
  <!-- Exam Selector -->
  <div class="col-md-4 mb-4">
    <div class="glass-card">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-list-check text-primary me-2"></i>Select Term Assessment</h5>
      <ul class="list-group list-group-flush" style="background: transparent;">
        <?php foreach($exams as $ex): ?>
          <li class="list-group-item bg-transparent border-secondary border-opacity-25 px-0 py-3 d-flex justify-content-between align-items-center">
            <div>
              <div class="text-white font-weight-600"><?php echo e($ex->name); ?></div>
              <div class="text-secondary small"><?php echo e($ex->class_name); ?> - <?php echo e($ex->subject_name); ?></div>
            </div>
            <a href="<?php echo URLROOT; ?>/portal/teacher/exams?exam_id=<?php echo $ex->id; ?>" class="btn btn-sm btn-glow">Select</a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <!-- Marks roster -->
  <div class="col-md-8 mb-4">
    <?php if($selectedExam && !empty($examStudents)): ?>
      <div class="glass-card">
        <h5 class="text-white font-display mb-4"><i class="fa-solid fa-square-poll-vertical text-gold me-2"></i>Enter Student Marks</h5>
        
        <?php Session::flash('exam_success'); ?>
        <form action="<?php echo URLROOT; ?>/portal/teacher/exams?exam_id=<?php echo $selectedExam; ?>" method="POST">
          <?php echo Session::csrfTokenInput(); ?>
          <input type="hidden" name="exam_id" value="<?php echo $selectedExam; ?>">
          
          <div class="table-responsive">
            <table class="table table-glass">
              <thead>
                <tr>
                  <th>Admission No</th>
                  <th>Student Name</th>
                  <th>Marks Obtained</th>
                  <th>Remarks</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($examStudents as $st): ?>
                  <tr>
                    <td class="align-middle"><?php echo e($st->admission_no); ?></td>
                    <td class="align-middle text-white font-weight-600"><?php echo e($st->first_name . ' ' . $st->last_name); ?></td>
                    <td class="align-middle">
                      <input type="number" name="marks[<?php echo $st->student_id; ?>]" class="form-control form-control-sm" style="max-width: 100px;" min="0" max="100" step="0.1" value="<?php echo $st->marks_obtained ?? ''; ?>" required>
                    </td>
                    <td class="align-middle">
                      <input type="text" name="remarks[<?php echo $st->student_id; ?>]" class="form-control form-control-sm" placeholder="e.g. Excellent" value="<?php echo e($st->remarks); ?>">
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="text-end mt-4">
            <button type="submit" class="btn btn-glow btn-lg px-4">Submit Roster Marks</button>
          </div>
        </form>
      </div>
    <?php else: ?>
      <div class="glass-card text-center py-5">
        <i class="fa-solid fa-folder-open text-secondary fs-1 mb-3"></i>
        <h5 class="text-secondary">Please select an assessment to load mark grids.</h5>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php require_once APPROOT . '/views/layouts/portal_footer.php'; ?>