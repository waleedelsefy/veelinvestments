<div class="latestProjectsSectionTax">
  <div class="veelLatestProjects">
    <div class="veelLatestProjectsHeader">
      <div class="veelLatestProjectsHeaderTitle">
        <h2><?php _e('Latest Projects', 'veelinvestments'); ?></h2>
      </div>
    </div>

    <div class="latestProjectsImgGallery" id="veelLatestProjectsImageGallery">
      <?php
      // Get the current term object
      $term = get_queried_object();

      // Set up the query arguments to get projects in the current city (taxonomy term)
      $args = array(
        'post_type' => 'projects', // Ensure 'projects' is the correct post type
        'posts_per_page' => 12,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
          array(
            'taxonomy' => $term->taxonomy,
            'field' => 'term_id',
            'terms' => $term->term_id,
          ),
        ),
      );

      $latest_projects = new WP_Query($args);

      if ($latest_projects->have_posts()) :
        while ($latest_projects->have_posts()) : $latest_projects->the_post();
          get_template_part('template-parts/content', 'project-card-no-cta');
        endwhile;
        wp_reset_postdata();
      else :
        echo '<p>' . __('No projects available to display.', 'veelinvestments') . '</p>';
      endif;
      ?>
    </div>
  </div>
</div>
