<?php
require_once  get_template_directory() . '/admin/int.php';

function theme_contacts_init() {
    add_settings_section('theme_contacts_section', __('Contacts Options', 'veelinvestments'), 'theme_options_section_callback', 'theme-options');
    add_settings_field('phone_number', __('Phone Number', 'veelinvestments'), 'phone_number_callback', 'theme-options', 'theme_contacts_section');
    add_settings_field('whatsapp_number', __('WhatsApp Number', 'veelinvestments'), 'whatsapp_number_callback', 'theme-options', 'theme_contacts_section');
    add_settings_field('whatsapp_message', __('WhatsApp Message', 'veelinvestments'), 'whatsapp_message_callback', 'theme-options', 'theme_contacts_section');
    add_settings_field('email', __('E-mail', 'veelinvestments'), 'email_callback', 'theme-options', 'theme_contacts_section');
    add_settings_field('address_en', __('Address English', 'veelinvestments'), 'address_en_callback', 'theme-options', 'theme_contacts_section');
    add_settings_field('address_ar', __('Address Arabic', 'veelinvestments'), 'address_ar_callback', 'theme-options', 'theme_contacts_section');
    add_settings_field('about_us_en', __('About Us English', 'veelinvestments'), 'about_us_en_callback', 'theme-options', 'theme_contacts_section');
    add_settings_field('about_us_ar', __('About Us Arabic', 'veelinvestments'), 'about_us_ar_callback', 'theme-options', 'theme_contacts_section');
    add_settings_field('hero_description_ar', __('Hero Description Arabic', 'veelinvestments'), 'hero_description_ar_callback', 'theme-options', 'theme_contacts_section');
    add_settings_field('hero_description_en', __('Hero Description English', 'veelinvestments'), 'hero_description_en_callback', 'theme-options', 'theme_contacts_section');
}
add_action('admin_init', 'theme_contacts_init');


function get_theme_contacts_options() {
    $theme_contacts_options = array(
        'phone_number' => get_option('phone_number'),
        'whatsapp_number' => get_option('whatsapp_number'),
        'whatsapp_message' => get_option('whatsapp_message'),
        'email' => get_option('email'),
        'address_en' => get_option('address_en'),
        'address_ar' => get_option('address_ar'),
        'about_us_en' => get_option('about_us_en'),
        'about_us_ar' => get_option('about_us_ar'),
        'hero_description_ar' => get_option('hero_description_ar'),
        'hero_description_en' => get_option('hero_description_en')
    );

    return $theme_contacts_options;
}

function phone_number_callback() {
    $options = get_option('veel_theme_settings');
    $phone_number = isset($options['phone_number']) ? esc_attr($options['phone_number']) : '';
    echo '<input type="text" name="veel_theme_settings[phone_number]" value="' . $phone_number . '" />';
}

function whatsapp_number_callback() {
    $options = get_option('veel_theme_settings');
    $whatsapp_number = isset($options['whatsapp_number']) ? esc_attr($options['whatsapp_number']) : '';
    echo '<input type="text" name="veel_theme_settings[whatsapp_number]" value="' . $whatsapp_number . '" />';
}

function whatsapp_message_callback() {
    $options = get_option('veel_theme_settings');
    $whatsapp_message = isset($options['whatsapp_message']) ? esc_attr($options['whatsapp_message']) : '';
    echo '<textarea name="veel_theme_settings[whatsapp_message]">' . $whatsapp_message . '</textarea>';
}

function email_callback() {
    $options = get_option('veel_theme_settings');
    $email = isset($options['email']) ? esc_attr($options['email']) : '';
    echo '<input type="text" name="veel_theme_settings[email]" value="' . $email . '" />';
}

function address_ar_callback() {
    $options = get_option('veel_theme_settings');
    $address = isset($options['address_ar']) ? esc_attr($options['address_ar']) : '';
    echo '<input type="text" name="veel_theme_settings[address_ar]" value="' . $address . '" />';
}
function address_en_callback() {
    $options = get_option('veel_theme_settings');
    $address = isset($options['address_en']) ? esc_attr($options['address_en']) : '';
    echo '<input type="text" name="veel_theme_settings[address_en]" value="' . $address . '" />';
}

function about_us_ar_callback() {
    $options = get_option('veel_theme_settings');
    $about_us = isset($options['about_us_ar']) ? esc_attr($options['about_us_ar']) : '';
    echo '<textarea name="veel_theme_settings[about_us_ar]">' . $about_us . '</textarea>';
}

function about_us_en_callback() {
    $options = get_option('veel_theme_settings');
    $about_us = isset($options['about_us_en']) ? esc_attr($options['about_us_en']) : '';
    echo '<textarea name="veel_theme_settings[about_us_en]">' . $about_us . '</textarea>';
}
function hero_description_ar_callback() {
    $options = get_option('veel_theme_settings');
    $hero_description_ar = isset($options['hero_description_ar']) ? esc_attr($options['hero_description_ar']) : '';
    echo '<textarea name="veel_theme_settings[hero_description_ar]">' . $hero_description_ar . '</textarea>';
}
function hero_description_en_callback() {
    $options = get_option('veel_theme_settings');
    $hero_description_en = isset($options['hero_description_en']) ? esc_attr($options['hero_description_ar']) : '';
    echo '<textarea name="veel_theme_settings[hero_description_en]">' . $hero_description_en . '</textarea>';
}
