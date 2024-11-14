<?php
// Retrieve theme settings with caching for better performance
$theme_settings = wp_cache_get('veel_theme_settings', 'options');
if ($theme_settings === false) {
  $theme_settings = get_option('veel_theme_settings');
  wp_cache_set('veel_theme_settings', $theme_settings, 'options');
}

// Default fallback values
$phone_number = !empty($theme_settings['phone_number']) ? esc_attr($theme_settings['phone_number']) : '01040300143';
$whatsapp_number = !empty($theme_settings['whatsapp_number']) ? esc_attr($theme_settings['whatsapp_number']) : '01040300143';
$sales_number = !empty($theme_settings['sales_number']) ? esc_attr($theme_settings['sales_number']) : '01040300143';
$email = !empty($theme_settings['email']) ? esc_attr($theme_settings['email']) : 'sales@veelinvestments.com';
$address = !empty($theme_settings['address']) ? esc_html($theme_settings['address']) : 'مكتب ٢٠٢ مبنى ٣٤ أ الملتقى العربي - شيراتون - مصر الجديدة';
$about_us = !empty($theme_settings['about_us']) ? esc_html($theme_settings['about_us']) : '';

// WhatsApp link generation with dynamic title and link
$whatsapp_message = rawurlencode(sprintf(__('I would like to inquire about %s coming from %s', 'veeltheme'), get_the_title(), get_permalink()));
$whatsapp_link = "https://wa.me/2{$whatsapp_number}?text={$whatsapp_message}";

?>

<div class="veelFooter">

  <div class="logoandSocial">
    <div class="footerLogo">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/src/img/veel-footer-logo.webp'); ?>" alt="<?php _e('Logo', 'veelinvestments'); ?>">
    </div>
    <div class="social">
      <?php get_template_part('template-parts/global/social'); ?>
    </div>
  </div>

  <div class="veelLines mobileOnly">
  </div>

  <div class="quickLinks">
    <div class="quickLinksHeader"><?php _e('Quick Links', 'veelinvestments'); ?>
      <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
        <path d="M14.0604 13.352L8.07919 19.3333L6.37061 17.6247L14.0604 9.93484L21.7503 17.6247L20.0417 19.3333L14.0604 13.352Z" fill="white"/>
      </svg>
    </div>
    <div class="quickLinksList">
      <?php
      if (has_nav_menu('footer-menu')) {
        wp_nav_menu(array(
          'theme_location' => 'footer-menu',
          'container' => 'nav',
          'container_class' => 'footer-nav',
          'menu_class' => 'footer-menu',
          'depth' => 1,
        ));
      }
      ?>
    </div>
  </div>

  <div class="contactUs">
    <div class="cntactUsHeader"><?php _e('Contact Us', 'veelinvestments'); ?>
      <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
        <path d="M14.0604 13.352L8.07919 19.3333L6.37061 17.6247L14.0604 9.93484L21.7503 17.6247L20.0417 19.3333L14.0604 13.352Z" fill="white"/>
      </svg>
    </div>

    <div class="veelPhoneCall">
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.21097 2.76565C6.5918 3.18781 6.47106 3.66606 6.13432 4.11985C6.05449 4.22744 5.96246 4.33345 5.85132 4.45026C5.79797 4.50633 5.75637 4.54849 5.66936 4.63559C5.47176 4.83339 5.30564 4.9996 5.17101 5.13422C5.10573 5.1995 5.55147 6.09021 6.41652 6.95612C7.28111 7.82156 8.17178 8.2676 8.23737 8.20197L8.73538 7.70369C9.00963 7.42917 9.15486 7.29673 9.35444 7.16579C9.76933 6.8936 10.2219 6.81963 10.6035 7.16092C11.8497 8.05232 12.5549 8.59933 12.9004 8.9583C13.5743 9.65847 13.4859 10.7362 12.9042 11.3511C12.7025 11.5643 12.4467 11.8202 12.1447 12.1114C10.3173 13.9397 6.46084 12.8271 3.50526 9.86859C0.549006 6.90943 -0.563051 3.05257 1.26044 1.22811C1.58781 0.895593 1.69574 0.787711 2.01457 0.473557C2.60817 -0.111339 3.73566 -0.202922 4.42105 0.474136C4.78157 0.830271 5.35634 1.56979 6.21097 2.76565ZM9.65412 8.62274L9.15601 9.12112C8.30934 9.96826 6.86743 9.24615 5.49769 7.87507C4.12701 6.50304 3.4057 5.06167 4.25266 4.21478C4.38711 4.08034 4.55307 3.91429 4.75053 3.71664C4.83019 3.63689 4.86664 3.59995 4.91038 3.55398C4.96998 3.49135 5.01895 3.43633 5.05816 3.38766C4.30075 2.33259 3.78587 1.67333 3.5083 1.39914C3.36496 1.25754 3.04398 1.28361 2.92615 1.39972C2.61187 1.70939 2.50857 1.81264 2.18252 2.14378C1.00983 3.31711 1.90756 6.43064 4.4241 8.94964C6.93984 11.4679 10.0529 12.366 11.2345 11.1839C11.5319 10.8971 11.7742 10.6546 11.9608 10.4575C12.0955 10.315 12.1196 10.021 11.9646 9.85994C11.7063 9.59161 11.0741 9.09867 9.98244 8.31471C9.90287 8.37876 9.80505 8.47166 9.65412 8.62274Z" fill="white"/>
      </svg>
      <a href="tel:+2<?php echo esc_attr($phone_number); ?>"><?php echo esc_html($phone_number); ?></a>
    </div>

    <div class="veelGmailContent">
      <div class="gmailIcon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="14" viewBox="0 0 20 14" fill="none">
          <path d="M17.2258 2.73423L10 7.93243L2.77419 2.73423M1.92166 1.01351C1.67722 1.01351 1.44279 1.10843 1.26995 1.27738C1.0971 1.44633 1 1.67548 1 1.91441V12.0991C1 12.338 1.0971 12.5672 1.26995 12.7361C1.44279 12.9051 1.67722 13 1.92166 13H18.0783C18.3228 13 18.5572 12.9051 18.7301 12.7361C18.9029 12.5672 19 12.338 19 12.0991V1.9009C19 1.66197 18.9029 1.43282 18.7301 1.26387C18.5572 1.09492 18.3228 1 18.0783 1H1.92166V1.01351Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="veelGmail">
        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
      </div>
    </div>

    <div class="veelLocationContent">
      <div class="locationIcon">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" viewBox="0 0 18 22" fill="none">
          <path d="M5.57143 9.88889L7.85714 12.1111L12.4286 7.66667M17 9C17 13.4182 13 17 9 21C5 17 1 13.4182 1 9C1 4.58172 4.58173 1 9 1C13.4183 1 17 4.58172 17 9Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="veelLocation">
        <?php echo esc_html($address); ?>
      </div>
    </div>
  </div>

  <div class="veelSubscription">
    <?php get_template_part('template-parts/global/footer-subscription'); ?>
  </div>

</div>

<div class="veelLines">
  <div class="goldenLine"></div>
</div>
