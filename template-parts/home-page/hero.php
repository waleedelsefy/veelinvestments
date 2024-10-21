<div class="hero" style="background-image: linear-gradient(rgba(0, 0, 0, 0.15), #000000), url('<?php echo esc_url(get_template_directory_uri() . '/src/img/herobackground.webp'); ?>');">
  <div class="veelContent">
    <div class="heroH1">
      <h1><?php _e('Find Your Home', 'veelinvestments'); ?></h1>
    </div>
    <div class="HeroParagraph">
      <p><?php _e('Search through a selection of the finest properties at the best prices.', 'veelinvestments'); ?></p>
    </div>

    <div class="HeroForm">
      <form action="<?php echo esc_url(home_url('/')); ?>" method="GET">
        <div class="veelSearchBar">
          <input type="text" id="search" name="s" placeholder="<?php _e('Search by compound, location, developer', 'veelinvestments'); ?>" value="<?php echo esc_attr(get_search_query()); ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.16659 2.08337C5.083 2.08337 2.58325 4.58312 2.58325 7.66671C2.58325 10.7503 5.083 13.25 8.16659 13.25C11.2502 13.25 13.7499 10.7503 13.7499 7.66671C13.7499 4.58312 11.2502 2.08337 8.16659 2.08337ZM1.08325 7.66671C1.08325 3.75469 4.25457 0.583374 8.16659 0.583374C12.0786 0.583374 15.2499 3.75469 15.2499 7.66671C15.2499 11.5787 12.0786 14.75 8.16659 14.75C4.25457 14.75 1.08325 11.5787 1.08325 7.66671Z" fill="#081945"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.3029 12.803C13.5958 12.5102 14.0707 12.5102 14.3636 12.803L15.6969 14.1364C15.9898 14.4293 15.9898 14.9041 15.6969 15.197C15.404 15.4899 14.9291 15.4899 14.6363 15.197L13.3029 13.8637C13.01 13.5708 13.01 13.0959 13.3029 12.803Z" fill="#081945"/>
          </svg>
        </div>

        <div class="veelDropdown">
          <select class="dropdown" name="property_type">
            <option value=""><?php _e('Property Type', 'veelinvestments'); ?></option>
            <?php
            $property_types = get_terms(array('taxonomy' => 'property_type', 'hide_empty' => false));
            foreach ($property_types as $type) {
              echo '<option value="' . esc_attr($type->slug) . '">' . esc_html($type->name) . '</option>';
            }
            ?>
          </select>

          <select class="dropdown" name="bedrooms">
            <option value=""><?php _e('Bedrooms', 'veelinvestments'); ?></option>
            <option value="1"><?php _e('1 Bedroom', 'veelinvestments'); ?></option>
            <option value="2"><?php _e('2 Bedrooms', 'veelinvestments'); ?></option>
            <option value="3"><?php _e('3 Bedrooms', 'veelinvestments'); ?></option>
            <option value="4"><?php _e('4 Bedrooms', 'veelinvestments'); ?></option>
            <option value="5"><?php _e('5 Bedrooms or more', 'veelinvestments'); ?></option>
          </select>

          <select class="dropdown" name="price_range">
            <option value=""><?php _e('Price', 'veelinvestments'); ?></option>
            <option value="0-500000"><?php _e('0 - 500,000 EGP', 'veelinvestments'); ?></option>
            <option value="500000-1000000"><?php _e('500,000 - 1,000,000 EGP', 'veelinvestments'); ?></option>
            <option value="1000000-2000000"><?php _e('1,000,000 - 2,000,000 EGP', 'veelinvestments'); ?></option>
            <option value="2000000-5000000"><?php _e('2,000,000 - 5,000,000 EGP', 'veelinvestments'); ?></option>
            <option value="5000000+"><?php _e('More than 5,000,000 EGP', 'veelinvestments'); ?></option>
          </select>
        </div>

        <div class="veelSearchButton">
          <button type="submit"><?php _e('Search', 'veelinvestments'); ?></button>
        </div>
      </form>
    </div>
  </div>

  <div class="veelSocialAndArrow">
    <div class="arrow">
      <span style='font-size:30px;'>&#8595;</span>
    </div>
    <div class="socialHtml">
      <?php get_template_part('template-parts/global/social'); ?>
    </div>
  </div>
</div>
