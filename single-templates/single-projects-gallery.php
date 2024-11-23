<?php
/*
Template Name: Single Project with Gallery
Template Post Type: projects
*/

$post_id = get_the_ID();
get_header();
?>

<?php get_template_part('template-parts/projects/project-gallery'); ?>

<div class="project-body">
  <?php get_template_part('template-parts/projects/project-details-card'); ?>


  <div class="flex-row">
    <div class="col-8">
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

      <div class="veelBlogHeaderTitle">
        <h2><?php _e('Additional Information', 'veelinvestments'); ?></h2>
      </div>
      <div class="content-body">
        <?php the_content(); ?>
      </div>

      <?php get_template_part('template-parts/projects/author-card'); ?>
    </div>

    <div class="sidebarAria col-4">
      <div class="sidebar">
        <?php get_template_part('template-parts/projects/price-container'); ?>
        <?php get_template_part('template-parts/projects/schedule-meeting'); ?>
      </div>
    </div>
  </div>
</div>

<?php
get_template_part('template-parts/help-form');
get_template_part('template-parts/projects/related-projects');
get_template_part('template-parts/home-page/blog');
get_footer();
?>
