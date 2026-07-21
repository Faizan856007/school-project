 </div> <!-- Closing main-content -->
  </div> <!-- Closing dashboard-wrapper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Custom Glow Cursor Ring tracking inside portal
    const cursor = document.getElementById('custom-cursor');
    document.addEventListener('mousemove', (e) => {
      cursor.style.left = e.clientX + 'px';
      cursor.style.top = e.clientY + 'px';
    });
    const links = document.querySelectorAll('a, button, input, select, textarea');
    links.forEach(link => {
      link.addEventListener('mouseenter', () => {
        document.body.classList.add('cursor-hover');
      });
      link.addEventListener('mouseleave', () => {
        document.body.classList.remove('cursor-hover');
      });
    });
  </script>
</body>
</html>