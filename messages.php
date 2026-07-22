<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row">
  <div class="col-md-4 mb-4">
    <div class="glass-card">
      <h5 class="text-white font-display mb-4"><i class="fa-solid fa-users text-primary me-2"></i>Faculty Contacts</h5>
      <ul class="list-group list-group-flush" style="background: transparent;">
        <?php foreach($teachers as $t): ?>
          <li class="list-group-item bg-transparent border-secondary border-opacity-25 px-0 py-3 d-flex justify-content-between align-items-center">
            <div>
              <div class="text-white font-weight-600"><?php echo e($t->first_name . ' ' . $t->last_name); ?></div>
              <div class="text-secondary small"><?php echo e($t->specialization); ?></div>
            </div>
            <button onclick="startChat(<?php echo $t->user_id; ?>, '<?php echo e($t->first_name . ' ' . $t->last_name); ?>')" class="btn btn-sm btn-glow">Chat</button>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div class="col-md-8 mb-4">
    <div class="glass-card">
      <h5 class="text-white font-display mb-4" id="chat-title"><i class="fa-solid fa-comments text-gold me-2"></i>Select a contact to start chat</h5>
      
      <div id="chat-box" class="chat-container d-none">
        <!-- Message logs -->
        <div id="message-log" class="d-flex flex-column">
          <?php foreach($chats as $c): ?>
            <div class="chat-bubble <?php echo ($c->sender_id == Session::get('user_id')) ? 'sent' : 'received'; ?>">
              <div class="small text-secondary mb-1 opacity-75"><?php echo e($c->sender_name); ?></div>
              <div><?php echo e($c->message); ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      
      <div id="chat-input-wrapper" class="d-none">
        <form id="chat-form" class="d-flex gap-2">
          <?php echo Session::csrfTokenInput(); ?>
          <input type="hidden" id="receiver-id-input" name="receiver_id">
          <input type="text" id="message-text-input" name="message" class="form-control" placeholder="Type your message here..." required autocomplete="off">
          <button type="submit" class="btn btn-glow">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  let activeReceiverId = null;
  function startChat(receiverId, teacherName) {
    activeReceiverId = receiverId;
    document.getElementById('receiver-id-input').value = receiverId;
    document.getElementById('chat-title').innerText = "Chat with " + teacherName;
    document.getElementById('chat-box').classList.remove('d-none');
    document.getElementById('chat-input-wrapper').classList.remove('d-none');
    
    // Auto-scroll chat to bottom
    const box = document.getElementById('chat-box');
    box.scrollTop = box.scrollHeight;
  }
  document.getElementById('chat-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const message = document.getElementById('message-text-input').value;
    const token = document.querySelector('input[name="csrf_token"]').value;
    fetch('<?php echo URLROOT; ?>/portal/student/messages', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `csrf_token=${token}&receiver_id=${activeReceiverId}&message=${encodeURIComponent(message)}`
    })
    .then(res => res.json())
    .then(data => {
      if(data.status === 'sent') {
        const bubble = document.createElement('div');
        bubble.className = "chat-bubble sent";
        bubble.innerHTML = `<div class="small text-secondary mb-1 opacity-75">You</div><div>${message}</div>`;
        document.getElementById('message-log').appendChild(bubble);
        document.getElementById('message-text-input').value = '';
        
        const box = document.getElementById('chat-box');
        box.scrollTop = box.scrollHeight;
      }
    });
  });
</script>
<?php require_once APPROOT . '/views/layouts/portal_footer.php'; ?>