<?php
// Get the post ID
$post_id = get_the_ID();
get_header();
?>
<?php get_template_part('template-parts/projects/project-post-header'); ?>

<div class="project-body">
  <?php
  echo veel_display_gallery_or_featured_image($post_id, 'full');
  echo  display_project_main_location();
  ?>
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
    <div class="col-4">
      <div class="sidebar">
    <?php get_template_part('template-parts/projects/price-container'); ?>
    </div>
    </div>
  </div>
</div>
<style>
  .sidebar {
    position: relative;
    width: 80%;
    max-width: 300px;
  }
  .sidebar.fixed {
    position: fixed;
    top: 85px;
    width: 300px;
    z-index: 1000;
  }

</style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    var sidebar = $('.sidebar');
    var sidebarOffset = sidebar.offset().top;

    $(window).scroll(function() {
      if ($(window).scrollTop() >= sidebarOffset) {
        sidebar.addClass('fixed');
      } else {
        sidebar.removeClass('fixed');
      }
    });
  });
</script>
<?php
// Include additional template parts for the footer sections
get_template_part('template-parts/help-form');
get_template_part('template-parts/projects/related-projects');
get_template_part('template-parts/home-page/blog');
get_footer();
?>
