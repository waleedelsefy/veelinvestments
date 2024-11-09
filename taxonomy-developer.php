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
get_template_part('template-parts/help-form');

?>
</div>
  <?php
get_template_part('template-parts/home-page/blog');

get_footer();

