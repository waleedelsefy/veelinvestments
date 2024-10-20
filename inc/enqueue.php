<?php
/**
 * Enqueue styles & scripts
 *
 * @package Didos
 * @version 5.3.4
 */
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue scripts and styles
 **/
function enqueue_theme_assets() {
    load_styles();
    load_scripts();
}

function theme_enqueue_styles() {
        wp_enqueue_style('front-page-style', get_template_directory_uri() . '/dist/css/main.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function load_scripts() {
    wp_enqueue_script('jquery');
}

function load_bootstrap_in_admin() {
    if (is_admin()) {
        wp_enqueue_style('bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css');
        wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
        wp_enqueue_script('popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js', array('jquery'), null, true);
        wp_enqueue_script('admin', get_template_directory_uri() . '/assets/js/admin.js', array(), null, true);
        wp_enqueue_style('admin-styles', get_template_directory_uri() . '/assets/css/admin.css', array('bootstrap-style'), null);
    }
}
add_action('admin_enqueue_scripts', 'load_bootstrap_in_admin');


function enqueue_select2_in_admin() {
    if (is_admin()) {
        wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), null, true);
        wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css');
    }
}
add_action('admin_enqueue_scripts', 'enqueue_select2_in_admin');

function load_media_files() {
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'load_media_files');

add_action('wp_enqueue_scripts', 'load_scripts');

function enqueue_custom_scripts() {
    if (is_page_template('sitemap_index.xml')) {
        wp_register_script('scrollreveal', 'https://unpkg.com/scrollreveal', array(), null, true);

        wp_enqueue_script('scrollreveal');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

add_action('rest_api_init', function () {
    register_rest_route('analytics/v1', '/web-vitals', array(
        'methods'  => 'POST',
        'callback' => 'handle_web_vitals',
    ));
});

function handle_web_vitals(WP_REST_Request $request) {
    $data = $request->get_json_params();
    if ($data) {
        $log_file = __DIR__ . '/web-vitals.log';
        $log_entry = date('Y-m-d H:i:s') . ' - ' . json_encode($data) . PHP_EOL;
        file_put_contents($log_file, $log_entry, FILE_APPEND);
    }

    return new WP_REST_Response(array('status' => 'success'), 200);
}
