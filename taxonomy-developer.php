<?php
/**
 * Template Name: developer
 */
get_header();

get_template_part('template-parts/developer/developer-header');

?>
  <div class="project-body">

<?php
get_template_part('template-parts/developer/about-developer');
get_template_part('template-parts/developer/new-developer');

get_template_part('template-parts/developer/developer-compunds');

?>
    <div class="flex-row">
    <div >
      <?php
      get_template_part('template-parts/developer/developer-body');

      ?>
    </div>
    <div class="developer-help-form">
      <?php
      get_template_part('template-parts/developer/developer-help-form');

      ?>
    </div>
    </div>
</div>
  <?php
get_template_part('template-parts/home-page/blog');

get_footer();

