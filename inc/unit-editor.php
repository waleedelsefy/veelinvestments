<?php
function update_project_association() {
    if (
        isset($_POST['post_id'])
        && isset($_POST['project_association'])
        && isset($_POST['nonce'])
        && wp_verify_nonce($_POST['nonce'], 'update_project_association_nonce')
    ) {
        update_post_meta($_POST['post_id'], '_unit_project_id', sanitize_text_field($_POST['project_association']));
    }
    wp_die();
}
add_action('wp_ajax_update_project_association', 'update_project_association');
function save_project_meta_data($post_id) {
    if (!isset($_POST['project_meta_box_nonce']) || !wp_verify_nonce($_POST['project_meta_box_nonce'], 'save_project_meta_data')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['unit_project_id'])) {
        // Update the post meta with sanitized 'unit_project_id'
        update_post_meta($post_id, '_unit_project_id', sanitize_text_field($_POST['unit_project_id']));
    }
}
add_action('save_post', 'save_project_meta_data');
function add_project_meta_box() {
    add_meta_box(
        'project_meta_box',
        __('Project Information', 'veelinvestments'),
        'project_meta_box_callback',
        'units',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_project_meta_box');
function project_meta_box_callback($post) {
    $project_id = get_post_meta($post->ID, '_unit_project_id', true);
    $projects = get_posts(array('post_type' => 'projects', 'posts_per_page' => -1));
    $project_options = get_project_options();
    echo '<label for="unit_project_id">' . __('Select Project:', 'veelinvestments') . '</label>';
    echo '<select name="unit_project_id" id="unit_project_id" class="project-association-select">';
    echo '<option value="">' . esc_html__('Select Project', 'veelinvestments') . '</option>';
    foreach ($project_options as $option) {
        echo '<option value="' . esc_attr($option['id']) . '" ' . selected($option['id'], $project_id, false) . '>' . esc_html($option['text']) . '</option>';
    }
    echo '</select>';

    wp_nonce_field('save_project_meta_data', 'project_meta_box_nonce');
}

function get_project_options() {
    $cached_projects = get_transient('cached_projects_options');
    if ($cached_projects !== false) {
        if (is_string($cached_projects)) {
            $cached_projects = json_decode($cached_projects, true);
            if ($cached_projects !== null) {
                return $cached_projects;
            }
        } else {
            return $cached_projects;
        }
    }
    $projects = get_posts(array('post_type' => 'projects', 'posts_per_page' => -1));
    $options = array();
    foreach ($projects as $project) {
        $options[] = array(
            'id'    => $project->ID,
            'text'  => $project->post_title,
        );
    }
    $json_options = json_encode($options);
    if ($json_options !== false) {
        set_transient('cached_projects_options', $json_options, MONTH_IN_SECONDS);
    }
    return $options;
}

function enqueue_select2_script() {
    wp_enqueue_script('select2');
    wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css');
    $projectsData = json_encode(get_project_options());
    ?>
    <script>
        jQuery(document).ready(function ($) {
            var projectsData = <?php echo $projectsData; ?>;
            // Check if projects data is stored in localStorage
            var cachedProjectsData = localStorage.getItem('cached_projects_data');
            if (cachedProjectsData !== null) {
                projectsData = JSON.parse(cachedProjectsData);
            }
            $('.project-association-select').select2({
                data: projectsData,
                width: '100%'
            });
            $(document).on('change', '.project-association-select', function () {
                var postId = $(this).data('post-id');
                var projectAssociation = $(this).val();
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'update_project_association',
                        post_id: postId,
                        project_association: projectAssociation,
                        nonce: '<?php echo wp_create_nonce("update_project_association_nonce"); ?>'
                    },
                    success: function (response) {
                        // Update localStorage with new data
                        localStorage.setItem('cached_projects_data', JSON.stringify(projectsData));
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
    <?php
}
add_action('admin_footer', 'enqueue_select2_script');


function add_units_custom_fields() {
    add_post_type_support('units', 'custom-fields');
}
add_action('init', 'add_units_custom_fields');
function add_project_custom_fields() {
    add_post_type_support('projects', 'custom-fields');
}
add_action('init', 'add_project_custom_fields');

function update_unit_type_from_project($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (get_post_type($post_id) !== 'units') return;
    $unit_type = get_post_meta($post_id, '_unit_type', true);
    $project_id = get_post_meta($post_id, '_unit_project_id', true);
    if (empty($unit_type) && $project_id) {
        $project_type = get_the_terms($project_id, 'type');
        if (!empty($project_type) && !is_wp_error($project_type)) {
            $project_type_slug = $project_type[0]->slug;
            if (!empty($project_type_slug)) {
                wp_set_object_terms($post_id, $project_type_slug, 'type', true);
            }
        }
    }
}
add_action('save_post', 'update_unit_type_from_project');

function register_units_post_type() {
    $labels = array(
        'name'               => __('Units', 'veelinvestments'),
        'singular_name'      => __('Unit', 'veelinvestments'),
        'add_new'            => __('Add New Unit', 'veelinvestments'),
        'add_new_item'       => __('Add New Unit', 'veelinvestments'),
        'edit_item'          => __('Edit Unit', 'veelinvestments'),
        'new_item'           => __('New Unit', 'veelinvestments'),
        'all_items'          => __('All Units', 'veelinvestments'),
        'view_item'          => __('View Unit', 'veelinvestments'),
        'search_items'       => __('Search for Unit', 'veelinvestments'),
        'not_found'          => __('No unit found', 'veelinvestments'),
        'not_found_in_trash' => __('No unit found in trash', 'veelinvestments'),
        'menu_name'          => __('Units', 'veelinvestments'),
    );
    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-building',
        'rewrite'       => array('slug' => 'units'),
        'supports'      => array('title', 'editor', 'thumbnail', 'author'),
        'taxonomies'    => array('type'),
        'capability_type' => 'post',
    );
    register_post_type('units', $args);
}
add_action('init', 'register_units_post_type');
function veel_unit_permalink($permalink, $post_id) {
    if (get_post_type($post_id) === 'units') {
        $project_id = get_post_meta($post_id, 'project_association', true);
        $project_slug = get_post_field('post_name', $project_id);
$permalink = trailingslashit(home_url('/units/' . get_post_field('post_name', $post_id)));
    }
    return $permalink;
}
add_filter('post_type_link', 'veel_unit_permalink', 10, 2);

add_action('wp_ajax_save_unit_space', 'veel_save_unit_space');
function veel_save_unit_space() {
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $unit_space = isset($_POST['unit_space']) ? sanitize_text_field($_POST['unit_space']) : '';
    if ($post_id && $unit_space !== '') {
        update_post_meta($post_id, 'unit_details', array('unit_space' => $unit_space));
        wp_send_json_success('تم حفظ المساحة بنجاح.');
    } else {
        wp_send_json_error('حدث خطأ أثناء حفظ المساحة.');
    }
}
function veel_add_unit_details_meta_boxes() {
    add_meta_box('unit_details_metabox', 'Unit Details', 'veel_render_unit_details_metabox', 'units', 'normal', 'high');
}
add_action('add_meta_boxes', 'veel_add_unit_details_meta_boxes');
function veel_render_unit_details_metabox($post) {
    wp_nonce_field('save_unit_meta_data', 'unit_meta_box_nonce');
    $unit_details = get_post_meta($post->ID, 'unit_details', true);
    $unit_project = get_post_meta($post->ID, '_unit_project_id', true);
    $project_details = get_post_meta($unit_project, 'project_details', true);
    $project_price = isset($project_details['project_price']) ? esc_attr($project_details['project_price']) : 0;
    $unit_space = isset($unit_details['unit_space']) ? esc_attr($unit_details['unit_space']) : '';
    $down_payment = isset($unit_details['down_payment']) ? esc_attr($unit_details['down_payment']) : '';
    $delivery = isset($unit_details['delivery']) ? esc_attr($unit_details['delivery']) : '';
    $installment = isset($unit_details['installment']) ? esc_attr($unit_details['installment']) : '';
    $votes = isset($unit_details['votes']) ? esc_attr($unit_details['votes']) : '';
    $number_of_votes = isset($unit_details['number_of_votes']) ? esc_attr($unit_details['number_of_votes']) : '';
    $number_of_voters = isset($unit_details['number_of_voters']) ? esc_attr($unit_details['number_of_voters']) : '';
    $payment_systems = isset($unit_details['payment_systems']) ? esc_attr($unit_details['payment_systems']) : '';
    if (is_numeric($project_price) && is_numeric($unit_space)) {
        $unit_price_auto = $project_price * $unit_space;
    } else {
        $unit_price_auto = 0;
        echo 'Cannot calculate the price currently.';
    }
    $unit_price = isset($unit_details['unit_price']) ? esc_attr($unit_details['unit_price']) : $unit_price_auto;
    ?>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="unit_details[unit_space]"><?php _e('Unit Space:', 'veelinvestments'); ?></label>
            </th>
            <td>
                <input type="number" name="unit_details[unit_space]" value="<?php echo esc_attr($unit_space); ?>" placeholder="<?php esc_attr_e('Enter the unit space', 'veelinvestments'); ?>" step="any">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="unit_details[unit_price]"><?php _e('Unit Price:', 'veelinvestments'); ?></label>
            </th>
            <td>
                <input type="number" name="unit_details[unit_price]" value="<?php echo esc_attr($unit_price); ?>" placeholder="<?php esc_attr_e('Enter the unit price', 'veelinvestments'); ?>" step="any">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="unit_details[votes]"><?php _e('Votes:', 'veelinvestments'); ?></label>
            </th>
            <td>
                <input type="checkbox" name="unit_details[votes]" value="true" <?php checked($votes, 'true'); ?>>
                <label><?php esc_html_e('Enable Votes', 'veelinvestments'); ?></label>
                <input width="100px" type="number" step=".01" min="3" max="5" name="unit_details[number_of_votes]" id="number-of-votes" value="<?php echo esc_attr($number_of_votes); ?>" placeholder="<?php esc_attr_e('Votes', 'veelinvestments'); ?>" <?php echo ($votes === 'true') ? '' : 'style="display: none;"'; ?>>
                <input width="100px"  type="number" min="0" max="1000" name="unit_details[number_of_voters]" id="number-of-voters" value="<?php echo esc_attr($number_of_voters); ?>" placeholder="<?php esc_attr_e('Voters', 'veelinvestments'); ?>" <?php echo ($votes === 'true') ? '' : 'style="display: none;"'; ?>>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="unit_details[payment_systems]"><?php _e('Payment Systems:', 'veelinvestments'); ?></label>
            </th>
            <td>
                <input type="text" name="unit_details[payment_systems]" value="<?php echo esc_attr($payment_systems); ?>" placeholder="<?php esc_attr_e('Enter payment systems', 'veelinvestments'); ?>">
                <input type="number" name="unit_details[down_payment]" value="<?php echo esc_attr($down_payment); ?>" placeholder="<?php esc_attr_e('Enter down payment', 'veelinvestments'); ?>" step="any">
                <input type="number" name="unit_details[installment]" value="<?php echo esc_attr($installment); ?>" placeholder="<?php esc_attr_e('Enter unit installment', 'veelinvestments'); ?>" step="any">
                <input type="number" name="unit_details[delivery]" value="<?php echo esc_attr($delivery); ?>" placeholder="<?php esc_attr_e('Enter unit delivery', 'veelinvestments'); ?>" step="any">
            </td>
        </tr>
    </table>
    <?php
}
function veel_save_unit_meta($post_id) {
    if (!isset($_POST['unit_meta_box_nonce']) || !wp_verify_nonce($_POST['unit_meta_box_nonce'], 'save_unit_meta_data')) {
        error_log('Nonce verification failed.');
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        error_log('Autosave ignored.');
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        error_log('User does not have permission to edit this post.');
        return;
    }
    if (!isset($_POST['unit_details']) || !is_array($_POST['unit_details'])) {
        error_log('unit_details is not set or is not an array.');
        return;
    }
    $sanitized_unit_details = array_map('sanitize_text_field', $_POST['unit_details']);
    if (update_post_meta($post_id, 'unit_details', $sanitized_unit_details)) {
        error_log('unit_details updated successfully.');
    } else {
        error_log('Failed to update unit_details.');
    }
}
add_action('save_post', 'veel_save_unit_meta');
