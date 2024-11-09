<?php
/*
Template Name: single projects
Template Post Type: projects
*/

$post_id = get_the_ID();
get_header();
?>

<?php get_template_part('template-parts/projects/project-post-header'); ?>

<div class="project-body">

  <div class="flex-row">
    <div class="col-8">
      <div class="post-thumbnail">
      <img class="post-thumbnail-img" src="<?php
      $featured_image_id = get_post_thumbnail_id($post_id);
      $image_data = wp_get_attachment_image_src($featured_image_id, 'full');
      $image_width = $image_data[1];
      $image_height = $image_data[2];
      $image_alt = get_post_meta($featured_image_id, '_wp_attachment_image_alt', true);

      echo get_the_post_thumbnail_url($post_id, 'full')?>" height="<?php echo $image_height; ?>" width="<?php echo $image_width; ?>" alt="<?php echo $image_alt; ?>"/>
      </div>
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
// Include additional template parts for the footer sections
get_template_part('template-parts/help-form');
get_template_part('template-parts/projects/related-projects');
get_template_part('template-parts/home-page/blog');
get_footer();
?>
<script>
  function checkStickyIssues(element) {
    const computedStyle = getComputedStyle(element);

    if (computedStyle.position !== 'sticky') {
      console.log("الخاصية position ليست 'sticky'.");
    }

    if (computedStyle.top === 'auto' && computedStyle.bottom === 'auto') {
      console.log("يجب تحديد قيمة 'top' أو 'bottom' لتفعيل 'sticky'.");
    }

    let parent = element.parentElement;
    let isInsideScrollableParent = false;

    while (parent) {
      const parentStyle = getComputedStyle(parent);

      if (parentStyle.overflow !== 'visible' && parentStyle.position !== 'static') {
        isInsideScrollableParent = true;
        console.log("المشكلة: العنصر داخل عنصر ذو 'overflow' مختلف عن 'visible' مما قد يمنع عمل 'sticky'.");
        break;
      }

      parent = parent.parentElement;
    }

    if (!isInsideScrollableParent) {
      console.log("العنصر غير موجود داخل عنصر يحتوي على 'overflow: hidden' أو 'overflow: auto' أو 'overflow: scroll'.");
    }
  }

  // استخدام الدالة على العنصر الذي تريد فحصه
  const element = document.querySelector('.your-sticky-element-class');
  checkStickyIssues(element);

</script>
