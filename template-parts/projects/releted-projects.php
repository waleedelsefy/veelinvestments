<div class="relatedProjectsSection">
  <div class="veelRelatedProjects">
    <div class="veelRelatedProjectsHeader">
      <div class="veelRelatedProjectsHeaderTitle">
        <h2>مشروعات ذات صلة</h2>
        <div class="veelRelatedProjectsHeaderShowAll mobileOnly">
          <a class="showAllButton"> عرض الكل</a>
          <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15" fill="none">
            <path d="M2.32537 7.39485L7.43045 12.4959C7.80801 12.8735 7.80801 13.484 7.43045 13.8575C7.05289 14.2311 6.44237 14.2311 6.06481 13.8575L0.280927 8.07767C-0.0845857 7.71216 -0.0926156 7.12574 0.252809 6.74818L6.0608 0.928141C6.24958 0.739363 6.49861 0.64698 6.74362 0.64698C6.98863 0.64698 7.23766 0.739363 7.42644 0.928141C7.80399 1.3057 7.80399 1.91622 7.42644 2.28976L2.32537 7.39485Z" fill="black"/>
          </svg>
        </div>
      </div>
    </div>
    <div class="relatedProjectsImgGallery" id="veelRelatedProjectsImageGallery">


      <?php
      $args = array(
        'post_type' => 'projects',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC'
      );
      $related_projects = new WP_Query($args);

      if ($related_projects->have_posts()) :
        while ($related_projects->have_posts()) : $related_projects->the_post();
          get_template_part('template-parts/content', 'related-card');
        endwhile;
        wp_reset_postdata();
      else :
        echo '<p>لا توجد مشروعات لعرضها.</p>';
      endif;
      ?>
    </div>

  </div>
</div>
