</body>
<footer>

  <?php get_template_part('template-parts/global/footer'); ?>
  <?php get_template_part('template-parts/global/copy-rights'); ?>

  <div id="target-section">
  </div>
  <script>
    document.querySelector('.arrow span').addEventListener('click', function() {
      document.getElementById('target-section').scrollIntoView({
        behavior: 'smooth'
      });
    });
  </script>


<?php
wp_footer();
?>
</footer>
</html>
