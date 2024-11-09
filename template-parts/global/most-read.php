<div class="mostReadSectionContent">
  <div class="mostReadSection">
    <h3><?php _e('Most Read', 'veelinvestments'); ?></h3>
    <ol class="mostReadContent">
      <?php
      $args = array(
        'posts_per_page' => 5,
        'meta_key' => 'post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
      );
      $most_read_query = new WP_Query($args);
      if ($most_read_query->have_posts()) :
        while ($most_read_query->have_posts()) : $most_read_query->the_post();
          ?>
          <li><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php
        endwhile;
        wp_reset_postdata();
      else :
        echo '<li>' . __('No posts to display.', 'veelinvestments') . '</li>';
      endif;
      ?>
    </ol>
  </div>
  <div class="mostReadSocialMedia">
    <p><?php _e('Follow us on', 'veelinvestments'); ?></p>
    <?php get_template_part('template-parts/global/social-big'); ?>
  </div>
</div>
