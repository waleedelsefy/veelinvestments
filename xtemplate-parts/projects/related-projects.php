<div class="relatedProjectsSection">
  <div class="veelRelatedProjects">
    <div class="veelRelatedProjectsHeader">
      <div class="veelRelatedProjectsHeaderTitle">
        <h2><?php _e('Related Projects', 'veelinvestments'); ?></h2>
        <div class="veelRelatedProjectsHeaderShowAll mobileOnly">
          <a class="showAllButton"><?php _e('Show All', 'veelinvestments'); ?></a>
          <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15" fill="none">
            <path d="M2.32537 7.39485L7.43045 12.4959C7.80801 12.8735 7.80801 13.484 7.43045 13.8575C7.05289 14.2311 6.44237 14.2311 6.06481 13.8575L0.280927 8.07767C-0.0845857 7.71216 -0.0926156 7.12574 0.252809 6.74818L6.0608 0.928141C6.24958 0.739363 6.49861 0.64698 6.74362 0.64698C6.98863 0.64698 7.23766 0.739363 7.42644 0.928141C7.80399 1.3057 7.80399 1.91622 7.42644 2.28976L2.32537 7.39485Z" fill="black"/>
          </svg>
        </div>
      </div>
    </div>
    <div class="relatedProjectsImgGallery" id="veelRelatedProjectsImageGallery">

      <?php
      $post_type = get_post_type();
      $post_id = get_the_ID();
      $relatedPosts = null;

      // Set a unique cache key
      $similar_cache_key = 'similar_' . sanitize_key($post_type . '_' . $post_id);

      // Try fetching from cache
      $relatedPosts = get_transient($similar_cache_key);

      // If not found in cache, query the posts
      if (false === $relatedPosts) {
        $customTaxonomyTerms = wp_get_object_terms($post_id, 'city', ['fields' => 'ids']);
        if (!empty($customTaxonomyTerms) && !is_wp_error($customTaxonomyTerms)) {
          $posts_per_page = wp_is_mobile() ? 3 : 2;

          $args = [
            'post_type'      => 'projects',
            'post_status'    => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'tax_query'      => [
              [
                'taxonomy' => 'city',
                'field'    => 'term_id',
                'terms'    => $customTaxonomyTerms,
              ],
            ],
            'post__not_in'   => [$post_id],
            'no_found_rows'  => true,
          ];

          $relatedPosts = new WP_Query($args);
          // Save the query result in a transient cache for an hour
          set_transient($similar_cache_key, $relatedPosts, HOUR_IN_SECONDS);
        }
      }

      // Check if there are related posts
      if ($relatedPosts && $relatedPosts->have_posts()) :
        while ($relatedPosts->have_posts()) : $relatedPosts->the_post(); ?>
          <div class="related-card-maxi">
            <?php get_template_part('template-parts/content', 'related-card'); ?>
          </div>
        <?php
        endwhile;
        wp_reset_postdata();
      else :
        echo '<p>' . __('No related projects to display.', 'veelinvestments') . '</p>';
      endif;
      ?>

    </div>
  </div>
</div>
