<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row">
  <div class="col-md-12">
    <div class="glass-card mb-4">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-list-check text-primary me-2"></i>Upcoming Exams Schedule</h5>
      
      <div class="table-responsive">
        <table class="table table-glass">
          <thead>
            <tr>
              <th>Exam Name</th>
              <th>Subject</th>
              <th>Date</th>
              <th>Max Marks</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($exams as $ex): ?>
              <tr>
                <td><?php echo e($ex->name); ?> (<?php echo e($ex->type); ?>)</td>
                <td><?php echo e($ex->subject_name); ?></td>
                <td><?php echo e($ex->date); ?></td>
                <td><?php echo e($ex->max_marks); ?></td>
              </tr>
            <?php endforeach; ?>
            <?php if(empty($exams)): ?>
              <tr>
                <td colspan="4" class="text-center text-secondary">No exams scheduled currently.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="glass-card">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-square-poll-vertical text-gold me-2"></i>Exam Results Transcript</h5>
      
      <div class="table-responsive">
        <table class="table table-glass">
          <thead>
            <tr>
              <th>Exam</th>
              <th>Subject</th>
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
                <td colspan="5" class="text-center text-secondary">No exam results published yet.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php require_once APPROOT . '/views/layouts/portal_footer.php'; ?>