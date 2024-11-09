<?php
/**
 * Template Name: city
 */
get_header();

get_template_part('template-parts/city/city-header');
?>
  <div class="project-body">
<?php

get_template_part('template-parts/city/new-city');
get_template_part('template-parts/city/city-compunds');
get_template_part('template-parts/help-form');

?>
</div>
  <?php
get_template_part('template-parts/home-page/blog');
get_template_part('template-parts/city/about-city');

get_footer();
