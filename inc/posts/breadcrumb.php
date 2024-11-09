<?php
/**
 * Breadcrumb
 *
 * @package Didos
 * @version 0.0.1
 */
// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Function to shorten titles to 6 words and add "..." if necessary
 */
function veel_shorten_title($title) {
  $words = explode(' ', $title);
  if (count($words) > 4) {
    return implode(' ', array_slice($words, 0, 4)) . '...';
  }
  return $title;
}

/**
 * Breadcrumb
 */
if (!function_exists('the_breadcrumb')) :
  function the_breadcrumb()
  {
    if (function_exists('rank_math_the_breadcrumbs')) {
      rank_math_the_breadcrumbs();
    }

    if (!is_home()) {
      echo '<nav aria-label="breadcrumb" class="breadcrumb-scroller bg-body-tertiary rounded">';
      echo '<ul class="breadcrumb-item list">';
      echo '<li class="cil"><a class="li breadcrumb-item" href="' . home_url() . '">' . __('Home', 'veelinvestments') . '</a><span class="separator"> &gt; </span></li>';

      // Breadcrumb for Developer taxonomy, displaying developer name as H1
      if (is_tax('developer')) {
        echo '<li class="cil"><a class="li breadcrumb-item" href="' . home_url('/developer/') . '">' . veel_shorten_title(__('Developers', 'veelinvestments')) . '</a><span class="separator"> &gt; </span></li>';
        $developer_term = get_queried_object();
        if ($developer_term && !is_wp_error($developer_term)) {
          echo '</ul>';
          echo '</nav>';
          echo '<h1 class="post-title">' . esc_html($developer_term->name) . '</h1>'; // Keep H1 unshortened
          return;
        }
      }

      // Breadcrumb for City taxonomy, displaying city name as H1
      if (is_tax('city')) {
        echo '<li class="cil"><a class="li breadcrumb-item" href="' . home_url('/city/') . '">' . veel_shorten_title(__('Cities', 'veelinvestments')) . '</a><span class="separator"> &gt; </span></li>';
        $city_term = get_queried_object();
        if ($city_term && !is_wp_error($city_term)) {
          echo '</ul>';
          echo '</nav>';
          echo '<h1 class="post-title">' . esc_html($city_term->name) . '</h1>'; // Keep H1 unshortened
          return;
        }
      }

      // Breadcrumb for Projects
      if (is_singular('projects')) {
        echo '<li class="cil"><a class="li breadcrumb-item" href="' . home_url('/projects/') . '">' . veel_shorten_title(__('Projects', 'veelinvestments')) . '</a><span class="separator"> &gt; </span></li>';

        // Display city if available
        $city_terms = get_the_terms(get_the_ID(), 'city');
        if ($city_terms && !is_wp_error($city_terms)) {
          foreach ($city_terms as $city_term) {
            echo '<li class="cil"><a class="li breadcrumb-item" href="' . get_term_link($city_term->term_id) . '">' . veel_shorten_title(esc_html($city_term->name)) . '</a><span class="separator"> &gt; </span></li>';
          }
        }
      }

      // Breadcrumb for Units
      if (is_singular('units')) {
        echo '<li class="cil"><a class="li breadcrumb-item" href="' . home_url('/units/') . '">' . veel_shorten_title(__('Units', 'veelinvestments')) . '</a><span class="separator"> &gt; </span></li>';

        // Display project linked to the unit
        $project_id = get_post_meta(get_the_ID(), '_unit_project_id', true);
        if ($project_id) {
          echo '<li class="cil"><a class="li breadcrumb-item" href="' . get_permalink($project_id) . '">' . veel_shorten_title(get_the_title($project_id)) . '</a><span class="separator"> &gt; </span></li>';
        }

        // Display city linked to the project
        $city_terms = get_the_terms($project_id, 'city');
        if ($city_terms && !is_wp_error($city_terms)) {
          foreach ($city_terms as $city_term) {
            echo '<li class="cil"><a class="li breadcrumb-item" href="' . get_term_link($city_term->term_id) . '">' . veel_shorten_title(esc_html($city_term->name)) . '</a><span class="separator"> &gt; </span></li>';
          }
        }
      }

      // Breadcrumb for Posts
      if (is_singular('post')) {
        echo '<li class="cil"><a class="li breadcrumb-item" href="' . home_url('/blog/') . '">' . __('Blog', 'veelinvestments') . '</a><span class="separator"> &gt; </span></li>';

        // Display category linked to the post
        $category = get_the_category();
        if ($category) {
          echo '<li class="cil"><a class="li breadcrumb-item" href="' . get_category_link($category[0]->term_id) . '">' . veel_shorten_title(esc_html($category[0]->name)) . '</a><span class="separator"> &gt; </span></li>';
        }
      }

      echo '</ul>';
      echo '</nav>';

      // Display the title for pages, single posts, or custom post types
      if (is_page() || is_single()) {
        echo '<h1 class="post-title">' . get_the_title() . '</h1>'; // Keep H1 unshortened
      }
    }
  }
  add_filter('breadcrumbs', 'breadcrumbs');
endif;
?>
