<div class="topCitySection">
  <div class="topCity">
    <div class="topContentCity">
      <div class="veelCityHeader">
        <div class="veelCityHeaderTitle">
          <h2><?php _e('Top Cities', 'veelinvestments'); ?></h2>
          <div class="veelCityHeaderShowAll mobileOnly">
            <a class="showAllButton"><?php _e('View All', 'veelinvestments'); ?></a>
            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15" fill="none">
              <path d="M2.32537 7.39485L7.43045 12.4959C7.80801 12.8735 7.80801 13.484 7.43045 13.8575C7.05289 14.2311 6.44237 14.2311 6.06481 13.8575L0.280927 8.07767C-0.0845857 7.71216 -0.0926156 7.12574 0.252809 6.74818L6.0608 0.928141C6.24958 0.739363 6.49861 0.64698 6.74362 0.64698C6.98863 0.64698 7.23766 0.739363 7.42644 0.928141C7.80399 1.3057 7.80399 1.91622 7.42644 2.28976L2.32537 7.39485Z" fill="black"/>
            </svg>
          </div>
        </div>
        <div class="veelCitySubHeading">
          <div class="subHeadingParagraph">
            <p><?php _e('Explore a selection of top compounds in the cities', 'veelinvestments'); ?></p>
          </div>
        </div>
      </div>

      <div class="topCitySubHeading">
        <div class="frame">
          <?php
          $terms = get_terms(array(
            'taxonomy' => 'city',
            'hide_empty' => false,
          ));

          if (!empty($terms) && !is_wp_error($terms)) :
            foreach ($terms as $term) :
              $term_link = get_term_link($term);
              ?>
              <a href="<?php echo esc_url($term_link); ?>" class="div-wrapper"><?php echo esc_html($term->name); ?></a>
            <?php endforeach;
          endif;
          ?>
        </div>
      </div>

      <div class="cityImgGallery" id="veelcityImageGallery">
        <div class="veelCursorsCity">
          <div class="veelCitybox" id="veelCitybox">
            <div class="veelCityright-arrow" id="veelCityright-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.25314 19.1219C6.08229 18.951 6.08229 18.674 6.25314 18.5031L14.2563 10.5L6.25314 2.49686C6.08229 2.326 6.08229 2.049 6.25314 1.87814C6.424 1.70729 6.70101 1.70729 6.87186 1.87814L15.1844 10.1906C15.3552 10.3615 15.3552 10.6385 15.1844 10.8094L6.87186 19.1219C6.701 19.2927 6.424 19.2927 6.25314 19.1219Z" fill="white"/>
              </svg>
            </div>
          </div>
          <div class="veelCitylc" id="veelCitylc">
            <div class="veelCityleft-arrow" id="veelCityleft-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7469 1.87814C14.9177 2.049 14.9177 2.32601 14.7469 2.49686L6.74372 10.5L14.7469 18.5031C14.9177 18.674 14.9177 18.951 14.7469 19.1219C14.576 19.2927 14.299 19.2927 14.1281 19.1219L5.81564 10.8094C5.64478 10.6385 5.64478 10.3615 5.81564 10.1906L14.1281 1.87814C14.299 1.70729 14.576 1.70729 14.7469 1.87814Z" fill="white"/>
              </svg>
            </div>
          </div>
        </div>
        <?php
        $projects = new WP_Query(array(
          'post_type' => 'projects',
          'posts_per_page' => 18,
        ));
        if ($projects->have_posts()) :
          while ($projects->have_posts()) : $projects->the_post();
            get_template_part('template-parts/content', 'project-card');
          endwhile;
          wp_reset_postdata();
        endif;
        ?>
      </div>

      <div class="showAll">
        <div class="line"></div>
        <div class="show">
          <p><?php _e('View All', 'veelinvestments'); ?></p>
          <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15" fill="none">
            <path d="M2.32537 7.39485L7.43045 12.4959C7.80801 12.8735 7.80801 13.484 7.43045 13.8575C7.05289 14.2311 6.44237 14.2311 6.06481 13.8575L0.280927 8.07767C-0.0845857 7.71216 -0.0926156 7.12574 0.252809 6.74818L6.0608 0.928141C6.24958 0.739363 6.49861 0.64698 6.74362 0.64698C6.98863 0.64698 7.23766 0.739363 7.42644 0.928141C7.80399 1.3057 7.80399 1.91622 7.42644 2.28976L2.32537 7.39485Z" fill="black"/>
          </svg>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const veelcityImageGallery = document.getElementById('veelcityImageGallery');
    const veelCityrightArrow = document.getElementById('veelCityright-arrow');
    const veelCityleftArrow = document.getElementById('veelCityleft-arrow');

    veelCityrightArrow.addEventListener('click', function() {
      veelcityImageGallery.scrollBy({ left: 300, behavior: 'smooth' });
    });

    veelCityleftArrow.addEventListener('click', function() {
      veelcityImageGallery.scrollBy({ left: -300, behavior: 'smooth' });
    });
  });
</script>
