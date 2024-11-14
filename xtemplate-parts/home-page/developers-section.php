<?php
$developers = get_terms(array(
  'taxonomy'   => 'developer',
  'hide_empty' => false,
));

if (!empty($developers) && !is_wp_error($developers)) :
  ?>

  <div class="veelDevelopersSection">
    <div class="veelDevelopersHeader">
      <div class="veelDevelopersHeaderTitle">
        <h2><?php _e('Developers', 'veelinvestments'); ?></h2>
      </div>
      <div class="veelDevelopersSubHeading">
        <div class="subHeadingParagraph"></div>
        <div class="veelDevelopersHeaderShowAll desktopOnly">
          <a class="showAllButton"><?php _e('Show All', 'veelinvestments'); ?></a>
          <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15" fill="none">
            <path d="M2.32537 7.39485L7.43045 12.4959C7.80801 12.8735 7.80801 13.484 7.43045 13.8575C7.05289 14.2311 6.44237 14.2311 6.06481 13.8575L0.280927 8.07767C-0.0845857 7.71216 -0.0926156 7.12574 0.252809 6.74818L6.0608 0.928141C6.24958 0.739363 6.49861 0.64698 6.74362 0.64698C6.98863 0.64698 7.23766 0.739363 7.42644 0.928141C7.80399 1.3057 7.80399 1.91622 7.42644 2.28976L2.32537 7.39485Z" fill="black"/>
          </svg>
        </div>
      </div>
    </div>

    <div class="developerIcons" id="developer-icons">
      <div class="veelDeveloperGallery">
        <?php foreach ($developers as $developer) :
          $developer_image = get_term_meta($developer->term_id, 'developer_image', true);
          ?>
          <div class="developersImg">
            <a href="<?php echo esc_url(get_term_link($developer)); ?>">
              <img src="<?php echo esc_url(!empty($developer_image) ? $developer_image : get_template_directory_uri() . '/src/img/default-developer.png'); ?>" alt="<?php echo esc_attr($developer->name); ?>" class="developer-logo">
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="veelGoldenCursor">
      <div class="cursorLine"></div>
      <div class="goldenArrows">
        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="41" viewBox="0 0 96 41" fill="none">
          <rect class="right-arrow" id="veelDevelopersright-arrow" x="55" width="41" height="41" rx="6.07407" fill="#E9DEBE"/>
          <path d="M78.7901 13.6665L77.6304 15.0047L82.2201 20.31L65.6296 20.31L65.6296 22.2082L82.2201 22.2082L77.6221 27.504L78.7901 28.8517L85.3704 21.2591L78.7901 13.6665Z" fill="white"/>
          <rect class="left-arrow" id="veelDevelopersleft-arrow" width="41" height="41" rx="6.07407" fill="#E9DEBE"/>
          <path d="M17.2099 28.852L18.3696 27.5139L13.7799 22.2085L30.3704 22.2085L30.3704 20.3104L13.7799 20.3104L18.3779 15.0145L17.2099 13.6669L10.6296 21.2595L17.2099 28.852Z" fill="white"/>
        </svg>
      </div>
    </div>

  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const developerIcons = document.querySelector('#developer-icons .veelDeveloperGallery');
      const rightArrow = document.getElementById('veelDevelopersright-arrow');
      const leftArrow = document.getElementById('veelDevelopersleft-arrow');

      if (developerIcons && rightArrow && leftArrow) {
        rightArrow.addEventListener('click', function() {
          developerIcons.scrollBy({ left: 200, behavior: 'smooth' });
        });

        leftArrow.addEventListener('click', function() {
          developerIcons.scrollBy({ left: -200, behavior: 'smooth' });
        });
      } else {
        console.error('Required elements for scrolling are missing.');
      }
    });
  </script>

  <style>
    .developersImg {
      width: 150px;
      height: 150px;
      overflow: auto;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .developer-logo {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }
  </style>

<?php endif; ?>
