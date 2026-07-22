<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row">
  <div class="col-md-12">
    <div class="glass-card mb-4">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-calendar-check text-primary me-2"></i>Mark Attendance Sheet</h5>
      
      <!-- Selection filters -->
      <form action="<?php echo URLROOT; ?>/portal/teacher/attendance" method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
          <label class="text-secondary small mb-2">Select Class</label>
          <select name="class_id" class="form-select">
            <?php foreach($classes as $c): ?>
              <option value="<?php echo $c->id; ?>" <?php echo ($c->id == $selectedClass) ? 'selected' : ''; ?>><?php echo e($c->name); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label class="text-secondary small mb-2">Select Date</label>
          <input type="date" name="date" class="form-control" value="<?php echo $selectedDate; ?>">
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <button type="submit" class="btn btn-glow w-100 py-3">Load Student List</button>
        </div>
      </form>
    </div>
    <!-- Attendance Marker Grid -->
    <?php if(!empty($students)): ?>
      <div class="glass-card">
        <?php Session::flash('att_success'); ?>
        <?php Session::flash('att_err'); ?>
        <form action="<?php echo URLROOT; ?>/portal/teacher/attendance?class_id=<?php echo $selectedClass; ?>&date=<?php echo $selectedDate; ?>" method="POST">
          <?php echo Session::csrfTokenInput(); ?>
          
          <div class="table-responsive">
            <table class="table table-glass">
              <thead>
                <tr>
                  <th>Admission No</th>
                  <th>Student Name</th>
                  <th>Attendance Status</th>
                  <th>Remarks / Delay Reason</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($students as $st): ?>
                  <tr>
                    <td class="align-middle"><?php echo e($st->admission_no); ?></td>
                    <td class="align-middle text-white font-weight-600"><?php echo e($st->first_name . ' ' . $st->last_name); ?></td>
                    <td class="align-middle">
                      <div class="btn-group btn-group-sm" role="group">
                        <input type="radio" class="btn-check" name="attendance[<?php echo $st->student_id; ?>]" id="pres-<?php echo $st->student_id; ?>" value="present" <?php echo ($st->status === 'present' || empty($st->status)) ? 'checked' : ''; ?>>
                        <label class="btn btn-outline-success px-3" for="pres-<?php echo $st->student_id; ?>">Present</label>
                        <input type="radio" class="btn-check" name="attendance[<?php echo $st->student_id; ?>]" id="abs-<?php echo $st->student_id; ?>" value="absent" <?php echo ($st->status === 'absent') ? 'checked' : ''; ?>>
                        <label class="btn btn-outline-danger px-3" for="abs-<?php echo $st->student_id; ?>">Absent</label>
                        <input type="radio" class="btn-check" name="attendance[<?php echo $st->student_id; ?>]" id="late-<?php echo $st->student_id; ?>" value="late" <?php echo ($st->status === 'late') ? 'checked' : ''; ?>>
                        <label class="btn btn-outline-warning px-3" for="late-<?php echo $st->student_id; ?>">Late</label>
                      </div>
                    </td>
                    <td class="align-middle">
                      <input type="text" name="remarks[<?php echo $st->student_id; ?>]" class="form-control form-control-sm" placeholder="Optional comments..." value="<?php echo e($st->remarks); ?>">
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          
          <div class="text-end mt-4">
            <button type="submit" class="btn btn-glow btn-lg px-4">Submit Attendance Sheet</button>
          </div>
        </form>
      </div>
    <?php else: ?>
      <div class="glass-card text-center py-5">
        <i class="fa-solid fa-people-group text-secondary fs-1 mb-3"></i>
        <h5 class="text-secondary">No students enrolled in this division.</h5>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php require_once APPROOT . '/views/layouts/portal_footer.php'; ?>
