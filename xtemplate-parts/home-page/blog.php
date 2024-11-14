<div class="veelBolgSection">
  <div class="veelBlog">
    <div class="veelBlogHeader">
      <div class="veelBlogHeaderTitle">
        <h2><?php _e('Blog', 'veelinvestments'); ?></h2>
      </div>
      <div class="veelBlogSubHeading">
        <div class="subHeadingParagraph">
          <p><?php _e('The latest real estate news in all of our partner’s residential, commercial, and administrative projects.', 'veelinvestments'); ?></p>
        </div>
        <div class="veelBlogHeaderShowAll desktopOnly">
          <a class="showAllButton"><?php _e('Show All', 'veelinvestments'); ?></a>
          <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15" fill="none">
            <path d="M2.32537 7.39485L7.43045 12.4959C7.80801 12.8735 7.80801 13.484 7.43045 13.8575C7.05289 14.2311 6.44237 14.2311 6.06481 13.8575L0.280927 8.07767C-0.0845857 7.71216 -0.0926156 7.12574 0.252809 6.74818L6.0608 0.928141C6.24958 0.739363 6.49861 0.64698 6.74362 0.64698C6.98863 0.64698 7.23766 0.739363 7.42644 0.928141C7.80399 1.3057 7.80399 1.91622 7.42644 2.28976L2.32537 7.39485Z" fill="black" />
          </svg>
        </div>
      </div>
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

    <div class="veelGoldenCursor">
      <div class="cursorLine"></div>
      <div class="goldenArrows">
        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="41" viewBox="0 0 96 41" fill="none">
          <rect class="right-arrow" id="right-arrow" x="55" width="41" height="41" rx="6.07407" fill="#E9DEBE" />
          <path d="M78.7901 13.6665L77.6304 15.0047L82.2201 20.31L65.6296 20.31L65.6296 22.2082L82.2201 22.2082L77.6221 27.504L78.7901 28.8517L85.3704 21.2591L78.7901 13.6665Z" fill="white" />
          <rect class="left-arrow" id="left-arrow" width="41" height="41" rx="6.07407" fill="#E9DEBE" />
          <path d="M17.2099 28.852L18.3696 27.5139L13.7799 22.2085L30.3704 22.2085L30.3704 20.3104L13.7799 20.3104L18.3779 15.0145L17.2099 13.6669L10.6296 21.2595L17.2099 28.852Z" fill="white" />
        </svg>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const veelblogImageGallery = document.getElementById('veelblogImageGallery');
    const rightArrow = document.getElementById('right-arrow');
    const leftArrow = document.getElementById('left-arrow');

    rightArrow.addEventListener('click', function() {
      veelblogImageGallery.scrollBy({ left: 300, behavior: 'smooth' });
    });

    leftArrow.addEventListener('click', function() {
      veelblogImageGallery.scrollBy({ left: -300, behavior: 'smooth' });
    });
  });
</script>
