<?php
/**
 * Template Name: single posts
 */
get_header();
$post_id = get_the_ID();

?>
<style>
  .post-help-form {
    margin: 50px 0;
  }
</style>
    <?php  get_template_part('template-parts/projects/project-post-header'); ?>
  <div class="project-body">
    <div class="flex-row">
      <div class="col-8">
          <?php
          get_template_part('template-parts/blog-content-page/blog-image-and-content');
          ?>
      </div>
      <div class="sidebarAria">
      <div class="sidebar">

        <?php
          get_template_part('template-parts/global/most-read');
        ?>
      </div>
    </div>
    </div>
    <?php
    get_template_part('template-parts/blog-content-page/blog-content-page-related-news'); ?>
  </div>
<div class="post-help-form">
<?php
get_template_part('template-parts/help-form');?>
</div>
<?php get_footer();
?>
