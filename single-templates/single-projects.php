<?php
// Get the post ID
$post_id = get_the_ID();
get_header();

// Retrieve the author's information safely
$author_id = get_post_field('post_author', $post_id);
$author_name = get_the_author_meta('display_name', $author_id);
$author_bio = get_the_author_meta('description', $author_id);
$author_youtube = get_the_author_meta('youtube', $author_id);
$author_linkedin = get_the_author_meta('linkedin', $author_id);
$author_facebook = get_the_author_meta('facebook', $author_id);
$author_instagram = get_the_author_meta('instagram', $author_id);
?>

<div class="project-body">
  <div class="flex-row">
    <div class="col-8">
      <div class="veelBlogHeaderTitle">
        <h3><?php _e('Payment Systems', 'veelinvestments'); ?></h3>

        <?php
        $project_details = get_post_meta($post_id, 'project_details', true);
        $installment_1 = !empty($project_details['installment_1']) ? esc_attr($project_details['installment_1']) : '';
        ?>

        <div class="installment-div-box" style="width: 112px; height: 118px; background: #FDFCFB; border-radius: 15px; border: 1px black solid">
          <?php echo esc_html__('Down Payment', 'veelinvestments') . ' ' . esc_attr($installment_1) . '% ' . esc_html__('7 years', 'veelinvestments'); ?>
        </div>
      </div>

      <div class="veelBlogHeaderTitle">
        <h2><?php _e('Facilities & Services', 'veelinvestments'); ?></h2>
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

    <div class="col-4"></div>
  </div>
</div>

<?php
// Include additional template parts for the footer sections
get_template_part('template-parts/help-form');
get_template_part('template-parts/projects/related-projects');
get_template_part('template-parts/home-page/blog');
get_footer();
?>
