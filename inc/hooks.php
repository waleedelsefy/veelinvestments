<?php
/**
 * Hooks
 *
 * @package Didos
 * @version 0.0.1
 */
defined( 'ABSPATH' ) || exit;
/**
 * Hook after #primary
 */
function bs_after_primary() {
  do_action('bs_after_primary');
}
function center_image_in_content($content) {
    preg_match_all('/<img [^>]+>/', $content, $matches);
    if (!empty($matches[0])) {
        foreach ($matches[0] as $img) {
            $centered_img = preg_replace('/<img(.*?)class=[\'"](.*?)[\'"](.*?)>/i', '<img$1class="$2 centered-image"$3>', $img);
            $content = str_replace($img, $centered_img, $content);
        }
    }
    return $content;
}
add_filter('the_content', 'center_image_in_content');
function register_payment_systems_taxonomy() {
    $labels_installment = array(
        'name'              => __('Payment Systems', 'veelinvestments'),
        'singular_name'     => __('payment system', 'veelinvestments'),
        'search_items'      => __('Search Payment Systems', 'veelinvestments'),
        'all_items'         => __('All Payment Systems', 'veelinvestments'),
        'edit_item'         => __('Edit Payment System', 'veelinvestments'),
        'update_item'       => __('Update Payment System', 'veelinvestments'),
        'add_new_item'      => __('Add New Payment System', 'veelinvestments'),
        'new_item_name'     => __('New Payment System Name', 'veelinvestments'),
        'menu_name'         => __('Payment Systems', 'veelinvestments'),
    );
    $args_installment = array(
        'hierarchical'      => true,
        'labels'            => $labels_installment,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'payment_systems'),
        'capabilities'      => array(
            'assign_terms' => 'manage_options',
            'edit_terms'   => 'manage_options',
            'manage_terms' => 'manage_options',
        ),
    );
    // Register the taxonomy for both post types
    register_taxonomy('payment_systems', array('projects', 'units'), $args_installment);
}
add_action('init', 'register_payment_systems_taxonomy');

function generate_table_of_contents() {
    // Get the post content (supports all post types)
    $content = get_the_content();

    // Initialize an empty array to store headings
    $headings = [];

    // Regular expression pattern to match headings (h2-h6)
    $pattern = '/<h([2-6]).*?>(.*?)<\/h\1>/i';

    // Match headings in the content
    preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

    // Loop through matched headings
    foreach ($matches as $match) {
        $level = intval($match[1]); // Heading level (h2-h6)
        $text = strip_tags($match[2]); // Heading text

        // Add heading to the array
        $headings[] = [
            'level' => $level,
            'text' => $text,
        ];
    }

    // If there are no headings, return an empty string
    if (empty($headings)) {
        return '';
    }

    // Start building the table of contents
    $toc = '<div class="table-of-contents"><div class="head-table-of-contents"><p class="headline right">' . __('Table of Contents', 'veelinvestments') . '</p><button id="toggleToc">' . __('show', 'veelinvestments') . '</button></div><ul class="toc-list" style="display: none;">';

    // Loop through headings to build the table of contents
    foreach ($headings as $heading) {
        $level = $heading['level'];
        $text = $heading['text'];

        // Generate a unique ID for the heading
        $id = sanitize_title_with_dashes($text); // Generate a unique ID based on the heading text

        // Add opening list item tag for the current heading
        $toc .= '<li>';

        // Add link to the heading
        $toc .= '<a href="#' . $id . '">' . $text . '</a>';

        // Add closing list item tag for the current heading
        $toc .= '</li>';
    }

    // Close the unordered list
    $toc .= '</ul></div>';

    // Add JavaScript for toggling Table of Contents
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toggleButton = document.getElementById("toggleToc");
            var tocList = document.querySelector(".toc-list");
            toggleButton.addEventListener("click", function() {
                tocList.style.display = (tocList.style.display === "none") ? "block" : "none";
                toggleButton.textContent = (tocList.style.display === "none") ? "<?php echo __('show', 'veelinvestments')  ?>" : "<?php echo __('hide', 'veelinvestments')  ?>";
            });
        });
    </script>
    <?php

    return $toc;
}

function add_heading_ids($content) {
    $pattern = '/<h([2-6]).*?>(.*?)<\/h\1>/i';
    preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
    foreach ($matches as $match) {
        $level = intval($match[1]); // Heading level
        $text = strip_tags($match[2]); // Heading text
        $id = sanitize_title_with_dashes($text); // Generate a unique ID based on the heading text
        $content = str_replace($match[0], '<h' . $level . ' id="' . $id . '">' . $match[2] . '</h' . $level . '>', $content);
    }

    return $content;
}
add_filter('the_content', 'add_heading_ids');
add_action('wp_footer', 'add_table_of_contents_script');
function add_table_of_contents_script() {
    ?>
    <script>
        jQuery(document).ready(function($) {
            var headings = $('h2, h3, h4, h5, h6');
            var counter = 1;
            headings.each(function() {
                var text = $(this).text();
                var id = $(this).attr('id');
                if (!id) {
                    id = 'heading_' + counter;
                    $(this).attr('id', id);
                }
                $('.table-of-contents ul').append(listItem);
                counter++;
            });
        });
    </script>
    <?php
}
