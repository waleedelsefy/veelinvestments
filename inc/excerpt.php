<?php
/**
 * Excerpt
 *
 * @package Dido's Team
 * @version 0.0.1
 */
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
/**
 * Excerpt to pages
 */
add_post_type_support('page', 'excerpt');
