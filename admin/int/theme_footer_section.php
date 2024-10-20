<?php
require_once get_template_directory() . '/admin/int.php';

function theme_footer_init() {
  register_setting('theme_options_group', 'veel_theme_settings', 'sanitize_social_media_input'); // تم تعديل دالة التنظيف
  add_settings_section('theme_footer_section', __('Footer Options', 'veelinvestments'), 'theme_options_section_callback', 'theme-options');
  add_settings_field('footer_logo', __('Footer Logo', 'veelinvestments'), 'footer_logo_callback', 'theme-options', 'theme_footer_section');
  add_settings_field('copyright_txt', __('Copyright Text', 'veelinvestments'), 'copyright_txt_callback', 'theme-options', 'theme_footer_section');
  add_settings_field('facebook', __('Facebook URL', 'veelinvestments'), 'facebook_callback', 'theme-options', 'theme_footer_section');
  add_settings_field('instagram', __('Instagram URL', 'veelinvestments'), 'instagram_callback', 'theme-options', 'theme_footer_section');
  add_settings_field('youtube', __('YouTube URL', 'veelinvestments'), 'youtube_callback', 'theme-options', 'theme_footer_section');
  add_settings_field('linkedin', __('LinkedIn URL', 'veelinvestments'), 'linkedin_callback', 'theme-options', 'theme_footer_section');
}
add_action('admin_init', 'theme_footer_init');

function facebook_callback() {
  $options = get_option('veel_theme_settings');
  $facebook_url = isset($options['facebook']) ? esc_attr($options['facebook']) : '';
  echo '<input type="text" name="veel_theme_settings[facebook]" value="' . $facebook_url . '" />';
}

function instagram_callback() {
  $options = get_option('veel_theme_settings');
  $instagram_url = isset($options['instagram']) ? esc_attr($options['instagram']) : '';
  echo '<input type="text" name="veel_theme_settings[instagram]" value="' . $instagram_url . '" />';
}

function youtube_callback() {
  $options = get_option('veel_theme_settings');
  $youtube_url = isset($options['youtube']) ? esc_attr($options['youtube']) : '';
  echo '<input type="text" name="veel_theme_settings[youtube]" value="' . $youtube_url . '" />';
}

function linkedin_callback() {
  $options = get_option('veel_theme_settings');
  $linkedin_url = isset($options['linkedin']) ? esc_attr($options['linkedin']) : '';
  echo '<input type="text" name="veel_theme_settings[linkedin]" value="' . $linkedin_url . '" />';
}

function copyright_txt_callback() {
  $options = get_option('veel_theme_settings');
  $copywrite_txt = isset($options['copywrite_txt']) ? esc_attr($options['copywrite_txt']) : '';
  echo '<input type="text" name="veel_theme_settings[copywrite_txt]" value="' . $copywrite_txt . '" />';
}

function footer_logo_callback() {
  $options = get_option('veel_theme_settings');
  $footer_logo = isset($options['footer_logo']) ? esc_attr($options['footer_logo']) : '';
  echo '<table>';
  echo '<tr>';
  echo '<td width="200px">';
  echo '<input class="hidden" type="text" id="footer_logo" name="veel_theme_settings[footer_logo]" value="' . $footer_logo . '" />';
  echo '<img id="footer_logo_preview" name="veel_theme_settings[footer_logo]" height="50px" src="' . $footer_logo . '" />';
  echo '</td>';
  echo '<td>';
  echo '<button class="upload_image_button button" data-field="footer_logo">' . __('Choose Image', 'veelinvestments') . '</button>';
  echo '</td>';
  echo '</tr>';
  echo '</table>';
}

function sanitize_social_media_input($input) {
  $sanitized_input = array();

  if (isset($input['facebook'])) {
    $sanitized_input['facebook'] = esc_url_raw($input['facebook']);
  }

  if (isset($input['instagram'])) {
    $sanitized_input['instagram'] = esc_url_raw($input['instagram']);
  }

  if (isset($input['youtube'])) {
    $sanitized_input['youtube'] = esc_url_raw($input['youtube']);
  }

  if (isset($input['linkedin'])) {
    $sanitized_input['linkedin'] = esc_url_raw($input['linkedin']);
  }

  return $sanitized_input;
}
