<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row">
  <div class="col-md-12">
    <div class="glass-card">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-clock text-primary me-2"></i>Weekly Class Timetable</h5>
      
      <div class="table-responsive">
        <table class="table table-bordered table-glass text-center">
          <thead>
            <tr>
              <th>Time / Period</th>
              <th>Monday</th>
              <th>Tuesday</th>
              <th>Wednesday</th>
              <th>Thursday</th>
              <th>Friday</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-secondary small align-middle">09:00 AM - 10:30 AM</td>
              <td><span class="badge bg-primary w-100 py-2">Physics (PHY101)</span></td>
              <td><span class="badge bg-secondary w-100 py-2">Mathematics (MAT101)</span></td>
              <td><span class="badge bg-primary w-100 py-2">Physics (PHY101)</span></td>
              <td><span class="badge bg-secondary w-100 py-2">Mathematics (MAT101)</span></td>
              <td><span class="badge bg-info w-100 py-2">Computer Science</span></td>
            </tr>
            <tr>
              <td class="text-secondary small align-middle">10:30 AM - 11:00 AM</td>
              <td colspan="5" class="bg-dark bg-opacity-25 text-secondary py-1">Morning Coffee / Tea Break</td>
            </tr>
            <tr>
              <td class="text-secondary small align-middle">11:00 AM - 12:30 PM</td>
              <td><span class="badge bg-info w-100 py-2">Computer Science</span></td>
              <td><span class="badge bg-primary w-100 py-2">Physics (PHY101)</span></td>
              <td><span class="badge bg-secondary w-100 py-2">Mathematics (MAT101)</span></td>
              <td><span class="badge bg-info w-100 py-2">Computer Science</span></td>
              <td><span class="badge bg-warning text-dark w-100 py-2">Astronomy Seminar</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php require_once APPROOT . '/views/layouts/portal_footer.php'; ?>
