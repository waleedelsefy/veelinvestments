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
    <?php get_template_part('template-parts/projects/schedule-meeting'); ?>
    </div>
    </div>
  </div>
</div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    var sidebar = $('.sidebar');
    var sidebarOffset = sidebar.offset().top;
    var stopAt = 1800;
    var isFixed = false;

    $(window).scroll(function() {
      var scrollPosition = $(window).scrollTop();
      var windowHeight = $(window).height();
      var documentHeight = $(document).height();

      if (scrollPosition >= sidebarOffset && (documentHeight - (scrollPosition + windowHeight)) > stopAt) {
        if (!isFixed) {
          sidebar.fadeOut(50, function() {
            $(this).addClass('fixed').fadeIn(150);
          });
          isFixed = true;
        }
      } else {
        if (isFixed) {
          sidebar.fadeOut(500, function() {
            $(this).removeClass('fixed').fadeIn(150);
          });
          isFixed = false;
        }
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
