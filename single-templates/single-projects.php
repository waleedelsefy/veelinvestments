<?php
/*
Template Name: Single Project
Template Post Type: projects
*/

$post_id = get_the_ID();
get_header();
?>

<?php get_template_part('template-parts/projects/project-post-header'); ?>

<div class="project-body">
  <div class="flex-row">
    <div class="col-8">
      <?php if (has_post_thumbnail($post_id)) : ?>
        <div class="post-thumbnail">
          <?php
          $featured_image_id = get_post_thumbnail_id($post_id);
          $image_data = wp_get_attachment_image_src($featured_image_id, 'full');
          $image_url = $image_data[0];
          $image_width = $image_data[1];
          $image_height = $image_data[2];
          $image_alt = get_post_meta($featured_image_id, '_wp_attachment_image_alt', true);
          ?>
          <img class="post-thumbnail-img" src="<?php echo esc_url($image_url); ?>" height="<?php echo esc_attr($image_height); ?>" width="<?php echo esc_attr($image_width); ?>" alt="<?php echo esc_attr($image_alt); ?>"/>
        </div>
      <?php endif; ?>

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
