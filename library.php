<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row">
  <div class="col-md-12">
    <div class="glass-card mb-4">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-book-bookmark text-primary me-2"></i>Library Books Issued</h5>
      
      <div class="table-responsive">
        <table class="table table-glass">
          <thead>
            <tr>
              <th>Book Title</th>
              <th>Author</th>
              <th>Issue Date</th>
              <th>Due Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($issues as $i): ?>
              <tr>
                <td><?php echo e($i->title); ?></td>
                <td><?php echo e($i->author); ?></td>
                <td><?php echo e($i->issue_date); ?></td>
                <td class="text-warning"><?php echo e($i->due_date); ?></td>
                <td>
                  <span class="badge-status <?php echo ($i->status === 'issued') ? 'badge-late' : 'badge-present'; ?>">
                    <?php echo ucfirst($i->status); ?>
                  </span>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php if(empty($issues)): ?>
              <tr>
                <td colspan="5" class="text-center text-secondary">No books currently checked out.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="glass-card">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-book-open-reader text-gold me-2"></i>Aether Library Catalog</h5>
      
      <div class="table-responsive">
        <table class="table table-glass">
          <thead>
            <tr>
              <th>ISBN</th>
              <th>Title</th>
              <th>Author</th>
              <th>Category</th>
              <th>Availability</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($books as $b): ?>
              <tr>
                <td><?php echo e($b->isbn); ?></td>
                <td class="text-white font-weight-600"><?php echo e($b->title); ?></td>
                <td><?php echo e($b->author); ?></td>
                <td><?php echo e($b->category); ?></td>
                <td>
                  <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-25 px-2 py-1">
                    <?php echo $b->available_copies; ?> / <?php echo $b->total_copies; ?> Copies
                  </span>
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
