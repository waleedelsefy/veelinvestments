<?php
$term = get_queried_object();
$term_id = $term->term_id;
$city_image = get_term_meta($term_id, 'featured_image', true);
$term_description = term_description();

if (!empty($term_description) || !empty($city_image)) :
  ?>
  <div class="aboutcitySection">

    <div class="aboutCityHeading">
      <div class="veelLatestProjectsHeaderTitle">
        <h2><?php echo __('About ', 'veelinvestments') . single_term_title('', false); ?></h2>
      </div>
    </div>

    <div class="aboutcitySectionBody">
      <div class="aboutCityContent">
        <?php if (!empty($term_description)) : ?>
          <div class="aboutCityPara">
            <?php echo $term_description; ?>
          </div>
        <?php endif; ?>

        <div class="aboutCityShowmore">
          <p><?php _e('Show more in the blog', 'veelinvestments'); ?></p>
          <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15" fill="none">
            <path d="M2.32525 7.39485L7.43033 12.4959C7.80789 12.8735 7.80789 13.484 7.43033 13.8575C7.05277 14.2311 6.44225 14.2311 6.06469 13.8575L0.280805 8.07767C-0.0847077 7.71216 -0.0927377 7.12574 0.252687 6.74818L6.06068 0.928141C6.24945 0.739363 6.49848 0.64698 6.74349 0.64698C6.98851 0.64698 7.23753 0.739363 7.42631 0.928141C7.80387 1.3057 7.80387 1.91622 7.42631 2.28976L2.32525 7.39485Z" fill="black"/>
          </svg>
        </div>
      </div>

      <?php if (!empty($city_image)) : ?>
        <div class="aboutCityImgs">
          <div class="image-mask">
            <img src="<?php echo esc_url($city_image); ?>" alt="<?php single_term_title(); ?>">
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>

<style>
  .aboutCityImgs {
    position: relative;
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
  }

  .image-mask {
    width: 100%;
    height: 100%;
    mask-image: url('<?php echo get_template_directory_uri(); ?>/src/img/fiveimgs.webp');
    -webkit-mask-image: url('<?php echo get_template_directory_uri(); ?>/src/img/fiveimgs.webp');
    mask-size: contain;
    -webkit-mask-size: contain;
    overflow: hidden;
  }

  .image-mask img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
</style>
