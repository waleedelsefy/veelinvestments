<?php
/*
Template Name: Single Project
Template Post Type: projects
*/

$post_id = get_the_ID();
get_header();
?>
<?php get_template_part('template-parts/projects/project-post-header'); ?>

<?php
if (function_exists('veel_display_gallery_or_featured_image')) {
  veel_display_gallery_or_featured_image(get_the_ID(), 'full');
}
?>
<div class="project-body">
    <div class="project-contains">
      <div class="project-details-card">
        <?php get_template_part('template-parts/projects/project-details-card'); ?>
      </div>
      <div class="project-details">
        <?php get_template_part('template-parts/projects/project-details'); ?>
      </div>
      <div>
        <?php get_template_part('template-parts/projects/payment-systems'); ?>
      </div>
      <div>
        <?php get_template_part('template-parts/projects/project-facilities'); ?>
      </div>
      <div class="price-container-mobile">
        <?php get_template_part('template-parts/projects/price-container'); ?>
      </div>

      <div class="veelBlogHeaderTitle">
        <h2><?php _e('Additional Information', 'veelinvestments'); ?></h2>
      </div>
      <div class="content-body">
        <?php the_content(); ?>
      </div>

      <?php get_template_part('template-parts/projects/author-card'); ?>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php
get_template_part('template-parts/help-form');
get_template_part('template-parts/projects/related-projects');
get_template_part('template-parts/home-page/blog');
get_footer();
?>
