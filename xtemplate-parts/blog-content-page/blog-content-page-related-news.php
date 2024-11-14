      <div class="veelBlogHeaderTitle">
        <h2><?php _e('Releted News', 'veelinvestments'); ?></h2>
      </div>

    <div class="blogImgGallery" id="veelblogImageGallery">

      <?php
      $args = array(
        'posts_per_page' => 8,
        'post_type'      => 'post',
        'orderby'        => 'date',
        'order'          => 'DESC',
      );

      $recent_posts = get_posts($args);

      if ($recent_posts) :
        foreach ($recent_posts as $post) :
          setup_postdata($post);
          get_template_part('template-parts/content', 'post-card');
        endforeach;
        wp_reset_postdata(); // Reset post data after loop
      else :
        echo '<p>' . __('No posts found.', 'veelinvestments') . '</p>';
      endif;
      ?>

    </div>

