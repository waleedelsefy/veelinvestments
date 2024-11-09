<div class="ProjectCard">
  <div  href="<?php echo get_permalink(get_the_ID()); ?>" class="imgProjectCard" style="background-image: url('<?php if (has_post_thumbnail()) : echo get_the_post_thumbnail_url(get_the_ID(), 'full'); endif; ?>');">
    <div class="ProjectCardCta">
      <?php get_template_part('template-parts/global/img-cta'); ?>
    </div>
    <?php
    $project_details = get_post_meta(get_the_ID(), 'project_details', true);
    if (!empty($project_details['project_price'])): // تحقق من وجود قيمة فعلية
      ?>
      <div class="veelPrice">
        <p class="realPrice">
          <?php echo esc_html($project_details['project_price']) . ' ' . __('EGP', 'veelinvestments'); ?>
        </p>
      </div>
    <?php endif; ?>
  </div>
  <div class="ProjectCardContent">
    <a class="ProjectCardTitle" href="<?php echo get_permalink(get_the_ID()); ?>"><?php secondary_title(); ?></a>
    <?php
    $terms = wp_get_post_terms(get_the_ID(), 'developer');
    if (!empty($terms) && !is_wp_error($terms)) {
      $developer_link = get_term_link($terms[0]->term_id, 'developer');
      echo '<a class="ProjectCardDeveloper" href="' . esc_url($developer_link) . '">' . esc_html($terms[0]->name) . '</a>';
    }
    ?>
  </div>
</div>
