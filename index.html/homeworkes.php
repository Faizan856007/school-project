<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row">
  <!-- Publish Form -->
  <div class="col-md-5 mb-4">
    <div class="glass-card">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-plus text-primary me-2"></i>Publish Assignment</h5>
      
      <?php Session::flash('hw_success'); ?>
      <?php Session::flash('hw_err'); ?>
      <form action="<?php echo URLROOT; ?>/portal/teacher/homework" method="POST" enctype="multipart/form-data">
        <?php echo Session::csrfTokenInput(); ?>
        <div class="mb-3">
          <label class="text-secondary small mb-2">Target Class</label>
          <select name="class_id" class="form-select" required>
            <?php foreach($classes as $c): ?>
              <option value="<?php echo $c->id; ?>"><?php echo e($c->name); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label class="text-secondary small mb-2">Subject Course</label>
          <select name="subject_id" class="form-select" required>
            <?php foreach($subjects as $s): ?>
              <option value="<?php echo $s->id; ?>"><?php echo e($s->name); ?> (<?php echo e($s->code); ?>)</option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label class="text-secondary small mb-2">Assignment Title</label>
          <input type="text" name="title" class="form-control" placeholder="e.g. Gravity Experiments" required>
        </div>
        <div class="mb-3">
          <label class="text-secondary small mb-2">Description / Instructions</label>
          <textarea name="description" class="form-control" rows="3" placeholder="Provide instructions..."></textarea>
        </div>
        <div class="mb-3">
          <label class="text-secondary small mb-2">Due Date</label>
          <input type="date" name="due_date" class="form-control" required>
        </div>
        <div class="mb-4">
          <label class="text-secondary small mb-2">Attachment Guide (PDF)</label>
          <input type="file" name="homework_file" class="form-control">
        </div>
        <button type="submit" class="btn btn-glow w-100 py-3">Publish Assignment</button>
      </form>
    </div>
  </div>
  <!-- Published lists -->
  <div class="col-md-7 mb-4">
    <div class="glass-card">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-list-check text-gold me-2"></i>Published Assignments</h5>
      
      <div class="table-responsive">
        <table class="table table-glass">
          <thead>
            <tr>
              <th>Class & Course</th>
              <th>Assignment</th>
              <th>Due</th>
              <th>Grading</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($homework as $hw): ?>
              <tr>
                <td class="align-middle">
                  <div class="text-white font-weight-600"><?php echo e($hw->class_name); ?></div>
                  <div class="text-secondary small mt-1"><?php echo e($hw->subject_name); ?></div>
                </td>
                <td class="align-middle"><?php echo e($hw->title); ?></td>
                <td class="align-middle text-warning"><?php echo e($hw->due_date); ?></td>
                <td class="align-middle">
                  <a href="<?php echo URLROOT; ?>/portal/teacher/grade?homework_id=<?php echo $hw->id; ?>" class="btn btn-sm btn-glow">
                    Review Submissions
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php if(empty($homework)): ?>
              <tr>
                <td colspan="4" class="text-center text-secondary">No homework sheets published yet.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php require_once APPROOT . '/views/layouts/portal_footer.php'; ?>
