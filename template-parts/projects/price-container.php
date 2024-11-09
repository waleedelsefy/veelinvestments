
<?php

$theme_settings = wp_cache_get('veel_theme_settings', 'options');
if ($theme_settings === false) {
  $theme_settings = get_option('veel_theme_settings');
  wp_cache_set('veel_theme_settings', $theme_settings, 'options');
}

$phone_number = isset($theme_settings['phone_number']) ? esc_attr($theme_settings['phone_number']) : '01040300143';
$whatsapp_number = isset($theme_settings['whatsapp_number']) ? esc_attr($theme_settings['whatsapp_number']) : '01040300143';
$whatsapp_message = rawurlencode("اريد الاستفسار عن " . get_the_title() . " قادم من " . get_permalink());
$whatsapp_link = "https://wa.me/2{$whatsapp_number}?text={$whatsapp_message}";

$unit_price = get_post_meta(get_the_ID(), 'unit_price', true);
if (!empty($unit_price)): ?>

<div class="price-container">
  <div class="price-title"><?php _e('Starting Price', 'veelinvestments'); ?></div>
  <div class="price-values">
    <div class="currency"><?php echo _e('EGP', 'veelinvestments'); ?></div>
    <div class="amount"><?php echo esc_html($unit_price); ?></div>
  </div>
  <div class="action-buttons">
    <div class="call-button"  href="+2<?php echo esc_attr($phone_number);?>">
      <svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9.33596 5.60522L8.95846 4.75586C8.71164 4.20051 8.58823 3.92282 8.40366 3.71032C8.17235 3.44401 7.87084 3.24807 7.53354 3.14486C7.26439 3.0625 6.96052 3.0625 6.35279 3.0625C5.46375 3.0625 5.01924 3.0625 4.64609 3.2334C4.20653 3.43471 3.80956 3.87182 3.6514 4.32869C3.51713 4.71652 3.5556 5.11509 3.63251 5.91222C4.45125 14.3971 9.10305 19.0488 17.5878 19.8676C18.385 19.9445 18.7836 19.983 19.1714 19.8487C19.6283 19.6906 20.0654 19.2935 20.2667 18.854C20.4376 18.4808 20.4376 18.0363 20.4376 17.1473C20.4376 16.5395 20.4376 16.2357 20.3552 15.9665C20.252 15.6292 20.0561 15.3277 19.7897 15.0964C19.5773 14.9118 19.2996 14.7885 18.7442 14.5416L17.8949 14.1641C17.2935 13.8968 16.9927 13.7632 16.6872 13.7342C16.3947 13.7063 16.0998 13.7474 15.8261 13.854C15.5401 13.9653 15.2873 14.176 14.7816 14.5973C14.2784 15.0167 14.0267 15.2265 13.7192 15.3388C13.4466 15.4383 13.0862 15.4753 12.7992 15.4329C12.4753 15.3852 12.2273 15.2527 11.7313 14.9876C10.1881 14.163 9.33715 13.312 8.51247 11.7688C8.24741 11.2728 8.11488 11.0248 8.06715 10.701C8.02484 10.4138 8.06173 10.0534 8.16131 9.78091C8.27364 9.47339 8.48335 9.22174 8.90277 8.71844C9.32411 8.21282 9.53478 7.96002 9.64617 7.67398C9.75276 7.40026 9.7938 7.10537 9.76598 6.81295C9.73691 6.50736 9.60326 6.20665 9.33596 5.60522Z" stroke="white" stroke-width="1.40625" stroke-linecap="round"/>
      </svg>
      <div class="button-text"><?php echo _e('Call Us', 'veelinvestments'); ?></div>
    </div>
    <a class="whatsapp-button" href="<?php echo esc_attr($whatsapp_link);?>">
      <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M11.5 20.875C16.6776 20.875 20.875 16.6776 20.875 11.5C20.875 6.32233 16.6776 2.125 11.5 2.125C6.32231 2.125 2.12498 6.32233 2.12498 11.5C2.12498 12.7927 2.38661 14.0243 2.85982 15.1447C3.12134 15.7638 3.2521 16.0735 3.26829 16.3075C3.28448 16.5415 3.21562 16.7988 3.07788 17.3136L2.12498 20.875L5.68633 19.9221C6.20112 19.7844 6.45852 19.7155 6.6925 19.7317C6.92649 19.7478 7.23609 19.8786 7.85531 20.1402C8.97572 20.6133 10.2073 20.875 11.5 20.875Z" stroke="white" stroke-width="1.40625" stroke-linejoin="round"/>
        <path d="M8.30133 11.8537L9.11784 10.8396C9.46196 10.4122 9.88735 10.0143 9.92072 9.44524C9.92906 9.30151 9.828 8.65616 9.62569 7.36549C9.5462 6.85826 9.07262 6.8125 8.66243 6.8125C8.12788 6.8125 7.86061 6.8125 7.5952 6.93373C7.25976 7.08695 6.91537 7.51779 6.83979 7.87875C6.77999 8.16434 6.82443 8.36113 6.9133 8.75471C7.29078 10.4264 8.17632 12.0773 9.54945 13.4505C10.9226 14.8236 12.5736 15.7092 14.2452 16.0866C14.6388 16.1755 14.8356 16.2199 15.1212 16.1601C15.4822 16.0846 15.9129 15.7402 16.0662 15.4047C16.1874 15.1393 16.1874 14.8721 16.1874 14.3375C16.1874 13.9273 16.1417 13.4537 15.6344 13.3742C14.3438 13.1719 13.6985 13.0709 13.5547 13.0792C12.9856 13.1126 12.5877 13.5379 12.1603 13.8821L11.1462 14.6986" stroke="white" stroke-width="1.40625"/>
      </svg>
      <div class="button-text"><?php _e('WhatsApp', 'veelinvestments'); ?></div>

    </a>
    <a class="zoom-button" href="#">
      <svg width="44" height="31" viewBox="0 0 44 31" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M28.8889 11.0258L33.5357 9.44841C35.4813 8.78798 37.5 10.2346 37.5 12.2892V18.5316C37.5 20.5862 35.4813 22.0328 33.5357 21.3724L28.8889 19.795M8.22222 5.9104H27.1667C28.1178 5.9104 28.8889 6.56476 28.8889 7.37194V23.4489C28.8889 24.2561 28.1178 24.9104 27.1667 24.9104H8.22222C7.27107 24.9104 6.5 24.2561 6.5 23.4489V7.37194C6.5 6.56476 7.27107 5.9104 8.22222 5.9104Z" stroke="white" stroke-width="1.41" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <div class="button-text"><?php _e('Zoom', 'veelinvestments'); ?></div>
    </a>

  </div>
</div>
<?php endif; ?>

<style>
  .price-container {
    width: 96%;
    height: 150px;
    padding: 16px 22px;
    border-radius: 12px;
    border: 3px solid #231F20;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 12px;
    background: #FFFFFF;

  }

  .price-title {
    text-align: center;
    color: black;
    font-size: 22px;
    font-weight: 400;
    line-height: 32px;
  }

  .price-values {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
  }

  .currency, .amount {
    text-align: center;
    color: black;
    font-size: 24px;
    font-weight: 700;
    line-height: 32px;
  }

  .action-buttons {
    width: 80%;
    height: 45px;
    display: flex;
    gap: 8px;
    justify-content: center;
  }

  .whatsapp-button, .zoom-button, .call-button {
    width: 33%;
    height: 40px;
    min-width: 85px;
    padding: 5px 2px;
    border-radius: 9px;
    border: 1px solid #FFFFFF;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration-line: none;
  }

  .whatsapp-button {
    background: #00DE3E;
  }

  .zoom-button {
    background: #357CDC;
    left: 0;
  }

  .call-button {
    background: #D1B671;
    left: 238px;
  }

  .button-text {
    text-align: center;
    color: white;
    font-size: 14px;
    font-weight: 700;
    line-height: 18px;
  }
@media screen  and (max-width: 1024px ){
  .whatsapp-button, .zoom-button, .call-button {
    width: 33%;
    height: 40px;
    min-width: 80px;
    padding: 5px 2px;
    border-radius: 9px;
    border: 1px solid #FFFFFF;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration-line: none;
    font-size: 14px;
  }
  .button-text {

    display: none;
  }

}
</style>
