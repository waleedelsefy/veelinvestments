<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Didos
 */
get_header();
?>


<div class="veelHomePage">
  <?php
  get_template_part('template-parts/home-page/hero');
  get_template_part('template-parts/home-page/latest-projects');
  get_template_part('template-parts/home-page/top-city');
  get_template_part('template-parts/help-form');
  get_template_part('template-parts/home-page/developers-section');
  get_template_part('template-parts/home-page/blog');
  get_template_part('template-parts/home-page/testimonial');
  ?>
</div>
<?php
get_footer();
?>
