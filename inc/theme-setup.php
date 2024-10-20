<?php
/**
 * Theme setup
 *
 * @package Didos
 * @version 5.3.4
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
/**
 * Setup theme
 */
if (!function_exists('veelinvestments_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function veelinvestments_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Bootscore, use a find and replace
         * to change 'veelinvestments' to the name of your theme in all the template files.
        */
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
        */
        add_theme_support('title-tag');
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
        add_theme_support('post-thumbnails');
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
        */
        add_theme_support('html5', array(
            'comment-form',
            'comment-list',
            'search-form',
            'gallery',
            'caption',
            'script',
            'style',
        ));
        add_theme_support( 'custom-logo' );
        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
    }
endif;
add_action('after_setup_theme', 'veelinvestments_setup');
/*if ( !is_admin() ) {
    wp_nav_menu([
        'container' => false,
        'theme_location' => 'main-menu',
        'menu_id' => 'respMenu',
        'menu_class' => 'nav-tabs ace-responsive-menu custom-menu',
        'link_before' => '<span class="menu-item-text">',
        'link_after' => '</span>',
    ]);
}*/

function register_veelinvestments_menu() {
  register_nav_menu('footer-menu', __('Footer Menu'));
  register_nav_menu('header-menu', __('Header Menu'));
}
add_action('init', 'register_veelinvestments_menu');


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function veelinvestments_content_width() {
    $GLOBALS['content_width'] = apply_filters('veelinvestments_content_width', 640);
}
add_action('after_setup_theme', 'veelinvestments_content_width', 0);
function custom_theme_logo_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'theme_logo_section', array(
        'title'    => __( 'Logo Settings', 'veelinvestments' ),
        'priority' => 30,
    ) );
    $wp_customize->add_setting( 'custom_logo_upload', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_logo_upload', array(
        'label'    => __( 'Upload Logo', 'veelinvestments' ),
        'section'  => 'theme_logo_section',
        'settings' => 'custom_logo_upload',
    ) ) );
}
add_action( 'customize_register', 'custom_theme_logo_customize_register' );
