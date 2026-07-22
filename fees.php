<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row">
  <div class="col-md-12">
    <div class="glass-card">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-credit-card text-primary me-2"></i>Fees Invoice Statement</h5>
      
      <?php Session::flash('fee_success'); ?>
      <?php Session::flash('fee_err'); ?>
      <div class="table-responsive">
        <table class="table table-glass">
          <thead>
            <tr>
              <th>Invoice Description</th>
              <th>Due Date</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Transaction ID / Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($fees as $f): ?>
              <tr>
                <td class="align-middle"><?php echo e($f->title); ?></td>
                <td class="align-middle text-secondary"><?php echo e($f->due_date); ?></td>
                <td class="align-middle font-weight-600 text-white">$<?php echo number_format($f->amount, 2); ?></td>
                <td class="align-middle">
                  <span class="badge-status <?php echo ($f->status === 'paid') ? 'badge-present' : 'badge-absent'; ?>">
                    <?php echo ucfirst($f->status); ?>
                  </span>
                </td>
                <td class="align-middle text-secondary small">
                  <?php if($f->status === 'paid'): ?>
                    <div>ID: <?php echo e($f->transaction_id); ?></div>
                    <div>Paid: <?php echo e($f->paid_at); ?></div>
                  <?php else: ?>
                    --
                  <?php endif; ?>
                </td>
                <td class="align-middle">
                  <?php if($f->status === 'unpaid'): ?>
                    <button class="btn btn-sm btn-glow" data-bs-toggle="modal" data-bs-target="#payModal-<?php echo $f->id; ?>">
                      Pay Invoice
                    </button>
                    
                    <!-- Checkout Modal -->
                    <div class="modal fade" id="payModal-<?php echo $f->id; ?>" tabindex="-1">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content glass-card border border-primary p-4" style="background: var(--bg-dark);">
                          <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title text-white font-display"><i class="fa-solid fa-shield-halved text-primary me-2"></i>Checkout Portal</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                          </div>
                          
                          <form action="<?php echo URLROOT; ?>/portal/student/fees" method="POST">
                            <?php echo Session::csrfTokenInput(); ?>
                            <input type="hidden" name="fee_id" value="<?php echo $f->id; ?>">
                            
                            <div class="modal-body border-0 text-start">
                              <p class="text-secondary small">Pay securely using Aether Payment Gateway.</p>
                              <div class="mb-3">
                                <label class="text-secondary small mb-2">Invoice Amount</label>
                                <input type="text" class="form-control bg-dark bg-opacity-50 text-white border-0 font-weight-600" value="$<?php echo number_format($f->amount, 2); ?>" disabled>
                              </div>
                              <div class="mb-3">
                                <label class="text-secondary small mb-2">Card Holder Name</label>
                                <input type="text" class="form-control" placeholder="Peter Downey" required>
                              </div>
                              <div class="mb-3">
                                <label class="text-secondary small mb-2">Credit Card Details</label>
                                <input type="text" class="form-control" placeholder="4242 4242 4242 4242" required>
                              </div>
                              <div class="row">
                                <div class="col-6 mb-3">
                                  <label class="text-secondary small mb-2">Exp Date</label>
                                  <input type="text" class="form-control" placeholder="12/28" required>
                                </div>
                                <div class="col-6 mb-3">
                                  <label class="text-secondary small mb-2">CVC</label>
                                  <input type="password" class="form-control" placeholder="•••" required>
                                </div>
                              </div>
                            </div>
                            
                            <div class="modal-footer border-0">
                              <button type="submit" class="btn btn-glow w-100 py-3">Authorize Secure Payment</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  <?php else: ?>
                    <button class="btn btn-sm btn-outline-secondary text-white border border-secondary border-opacity-25" disabled>Paid</button>
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
