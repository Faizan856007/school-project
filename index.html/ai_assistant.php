<?php require_once APPROOT . '/views/layouts/portal_header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-9 mb-4">
    
    <!-- AI Assist Header -->
    <div class="glass-card mb-4 text-center border border-primary border-opacity-25" style="background: linear-gradient(135deg, rgba(11, 13, 31, 0.9) 0%, rgba(111, 54, 255, 0.05) 100%);">
      <i class="fa-solid fa-robot text-primary fs-1 mb-3 animate-pulse"></i>
      <h3 class="font-display text-white">Aether AI Study Assistant</h3>
      <p class="text-secondary small col-md-8 mx-auto">Ask me questions about physics, math, schedules, fees, or algorithms, and I will parse your textbook datasets to reply.</p>
    </div>
    <!-- Chat console -->
    <div class="glass-card">
      <div id="ai-chat-box" class="chat-container" style="height: 350px;">
        <div id="ai-message-log" class="d-flex flex-column">
          <!-- Initial AI greeting -->
          <div class="chat-bubble received">
            <div class="small text-secondary mb-1 opacity-75">Aether AI</div>
            <div>Hello <?php echo e($student->first_name); ?>! I am Aether AI. How can I help you in your astrophysics or mathematics assignments today?</div>
          </div>
        </div>
      </div>
      <!-- Text Inputs -->
      <form id="ai-chat-form" class="d-flex gap-2">
        <input type="text" id="ai-query-input" class="form-control" placeholder="Ask a science question..." required autocomplete="off">
        <button type="submit" class="btn btn-glow"><i class="fa-solid fa-paper-plane me-2"></i>Ask</button>
      </form>
    </div>
  </div>
</div>
<script>
  document.getElementById('ai-chat-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const query = document.getElementById('ai-query-input').value;
    
    // Add user bubble
    const userBubble = document.createElement('div');
    userBubble.className = "chat-bubble sent";
    userBubble.innerHTML = `<div class="small text-secondary mb-1 opacity-75">You</div><div>${query}</div>`;
    document.getElementById('ai-message-log').appendChild(userBubble);
    document.getElementById('ai-query-input').value = '';
    const box = document.getElementById('ai-chat-box');
    box.scrollTop = box.scrollHeight;
    // Add typing loader bubble
    const loaderBubble = document.createElement('div');
    loaderBubble.className = "chat-bubble received";
    loaderBubble.id = "ai-loader-temp";
    loaderBubble.innerHTML = `<div class="small text-secondary mb-1 opacity-75">Aether AI</div><div><i class="fa-solid fa-ellipsis fa-bounce"></i> Processing...</div>`;
    document.getElementById('ai-message-log').appendChild(loaderBubble);
    box.scrollTop = box.scrollHeight;
    // Post to askAi handler
    fetch('<?php echo URLROOT; ?>/portal/student/ask-ai', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `query=${encodeURIComponent(query)}`
    })
    .then(res => res.json())
    .then(data => {
      // Remove loader
      const loader = document.getElementById('ai-loader-temp');
      if(loader) loader.remove();
      // Add AI reply bubble
      const aiBubble = document.createElement('div');
      aiBubble.className = "chat-bubble received";
      aiBubble.innerHTML = `<div class="small text-secondary mb-1 opacity-75">Aether AI</div><div>${data.answer}</div>`;
      document.getElementById('ai-message-log').appendChild(aiBubble);
      box.scrollTop = box.scrollHeight;
    });
  });
</script>
<?php require_once APPROOT . '/views/layouts/portal_footer.php'; ?>
