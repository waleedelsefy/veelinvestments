<?php
/**
 *
 * Register Projects Post Type
 * @package Didos
 * @version 0.0.1
 *
 */
function register_project_post_type()
{
    $labels = array(
        'name'               => __('Projects', 'veelinvestments'),
        'singular_name'      => __('Project', 'veelinvestments'),
        'add_new'            => __('Add New Project', 'veelinvestments'),
        'add_new_item'       => __('Add New Project', 'veelinvestments'),
        'edit_item'          => __('Edit Project', 'veelinvestments'),
        'new_item'           => __('New Project', 'veelinvestments'),
        'all_items'          => __('All Projects', 'veelinvestments'),
        'view_item'          => __('View Project', 'veelinvestments'),
        'search_items'       => __('Search for Project', 'veelinvestments'),
        'not_found'          => __('No project found', 'veelinvestments'),
        'not_found_in_trash' => __('No project found in trash', 'veelinvestments'),
        'menu_name'          => __('Projects', 'veelinvestments'),
    );
    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive' => true,
        'menu_icon'     => 'dashicons-admin-multisite',
        'rewrite'       => array('slug' => 'projects'),
        'supports'      => array('title', 'editor', 'thumbnail', 'author'),
        'capability_type' => 'post',
    );
    register_post_type('projects', $args);
}
add_action('init', 'register_project_post_type');
function custom_project_permalink($permalink, $post_id) {
    if (get_post_type($post_id) === 'projects') {
        $custom_field_value = get_post_meta($post_id, 'custom_field_name', true);
$permalink = trailingslashit(home_url('/projects/' . get_post_field('post_name', $post_id)));
    }
    return $permalink;
}
add_filter('post_type_link', 'custom_project_permalink', 10, 2);
function register_types_taxonomy() {
    $labels = array(
        'name'              => _x('Types', 'taxonomy general name', 'veelinvestments'),
        'singular_name'     => _x('Type', 'taxonomy singular name', 'veelinvestments'),
        'search_items'      => __('Search Types', 'veelinvestments'),
        'all_items'         => __('All Types', 'veelinvestments'),
        'edit_item'         => __('Edit Type', 'veelinvestments'),
        'update_item'       => __('Update Type', 'veelinvestments'),
        'add_new_item'      => __('Add New Type', 'veelinvestments'),
        'new_item_name'     => __('New Type Name', 'veelinvestments'),
        'menu_name'         => __('Types', 'veelinvestments'),
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'type'),
    );
    register_taxonomy('type', 'projects', $args);
}
add_action('init', 'register_types_taxonomy');
function add_project_details_meta_boxes() {
    add_meta_box('project_details_metabox', 'Project Details', 'render_project_details_metabox', 'projects', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_project_details_meta_boxes');
function render_project_details_metabox($post) {
    wp_nonce_field('save_project_meta_data', 'project_meta_box_nonce');
    $project_details = get_post_meta($post->ID, 'project_details', true);
    $project_space = '';
    $project_price = '';
    $payment_systems = '';
    $down_payment = '';
    $delivery = '';
    $installment = '';
    $number_of_votes = '';
    $number_of_voters = '';
    $votes= '';
    if (is_array($project_details) && !empty($project_details)) {
        $project_space = $project_details['project_space'] ?? '';
        $payment_systems = isset($project_details['payment_systems']) ? esc_attr($project_details['payment_systems']) : '';
        $project_price = isset($project_details['project_price']) ? esc_attr($project_details['project_price']) : '';
        $down_payment = isset($project_details['down_payment']) ? esc_attr($project_details['down_payment']) : '';
        $delivery = isset($project_details['delivery']) ? esc_attr($project_details['delivery']) : '';
        $installment = isset($project_details['installment']) ? esc_attr($project_details['installment']) : '';
        $installment_1 = isset($project_details['installment_1']) ? esc_attr($project_details['installment_1']) : '';
        $installment_2 = isset($project_details['installment_2']) ? esc_attr($project_details['installment_2']) : '';
        $installment_3 = isset($project_details['installment_3']) ? esc_attr($project_details['installment_3']) : '';
        $votes = isset($project_details['votes']) ? esc_attr($project_details['votes']) : '';
        $enable_faqs = isset($project_details['faqs']) ? esc_attr($project_details['faqs']) : '';
        $number_of_votes = isset($project_details['number_of_votes']) ? esc_attr($project_details['number_of_votes']) : '';
        $number_of_voters = isset($project_details['number_of_voters']) ? esc_attr($project_details['number_of_voters']) : '';
    }
    ?>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="project_details[project_space]"><?php _e('Project Space:', 'veelinvestments'); ?></label>
            </th>
            <td>
                <input type="number" name="project_details[project_space]" value="<?php echo esc_attr($project_space); ?>" placeholder="<?php esc_attr_e('Enter Project Space', 'aqarround'); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="project_details[project_price]"><?php _e('Project Price:', 'veelinvestments'); ?></label>
            </th>
            <td>
                <input type="number" name="project_details[project_price]" value="<?php echo esc_attr($project_price); ?>" placeholder="<?php esc_attr_e('Enter Project Price', 'veelinvestments'); ?>">
            </td>
        </tr>
        <!-- Payment Systems -->
        <tr>
            <th scope="row">
                <label for="project_details[payment_systems]"><?php _e('Payment Systems:', 'veelinvestments'); ?></label>
            </th>
            <td>
                <select name="project_details[payment_systems]">
                    <option value="cash" <?php selected($payment_systems, 'cash'); ?>><?php esc_html_e('Cash', 'veelinvestments'); ?></option>
                    <option value="installment" <?php selected($payment_systems, 'installment'); ?>><?php esc_html_e('Installment', 'veelinvestments'); ?></option>
                    <option value="both" <?php selected($payment_systems, 'both'); ?>><?php esc_html_e('Both Cash and Installment', 'veelinvestments'); ?></option>
                </select>
              <input type="number" min="0" max="99" name="project_details[down_payment]" value="<?php echo esc_attr($down_payment); ?>" placeholder="<?php esc_attr_e('Enter down payment', 'veelinvestments'); ?>"> %
              <input type="number" min="0" max="30" name="project_details[installment]" value="<?php echo esc_attr($installment); ?>" placeholder="<?php esc_attr_e('Enter installment payment', 'veelinvestments'); ?>">
          <td>
      </tr>
      <tr>
          <th scope="row">
          </th>
          <td>
            <label for="project_details[installment_1]"><?php _e('7 سنوات:', 'veelinvestments'); ?></label>
            <input type="number" min="0" max="30" name="project_details[installment_1]" value="<?php echo esc_attr($installment_1); ?>" placeholder="<?php esc_attr_e('ادخل المقدم لـ 3 سنوات', 'veelinvestments'); ?>">
            <label for="project_details[installment_2]"><?php _e('5 سنوات:', 'veelinvestments'); ?></label>
            <input type="number" min="0" max="30" name="project_details[installment_2]" value="<?php echo esc_attr($installment_2); ?>" placeholder="<?php esc_attr_e('ادخل المقدم لـ 5 سنوات', 'veelinvestments'); ?>">
            <label for="project_details[installment_3]"><?php _e('3 سنوات:', 'veelinvestments'); ?></label>

                <input type="number" min="0" max="30" name="project_details[installment_3]" value="<?php echo esc_attr($installment_3); ?>" placeholder="<?php esc_attr_e('ادخل المقدم لـ 7 سنوات', 'veelinvestments'); ?>">
            </td>
        </tr>
        <!-- Votes -->
        <tr>
            <th scope="row">
                <label for="project_details[votes]"><?php _e('Votes:', 'veelinvestments'); ?></label>
            </th>
            <td>
                <input type="checkbox" name="project_details[votes]" value="true" <?php checked($votes, 'true'); ?>>
                <label><?php esc_html_e('Enable Votes', 'veelinvestments'); ?></label>
                <input width="100px" step=".01" type="number" min="3" max="5" name="project_details[number_of_votes]" id="number-of-votes" value="<?php echo esc_attr($number_of_votes); ?>" placeholder="<?php esc_attr_e('Votes', 'veelinvestments'); ?>" <?php echo ($votes === 'true') ? '' : 'style=""'; ?>>
                <input width="100px"  type="number" min="0" max="1000" name="project_details[number_of_voters]" id="number-of-voters" value="<?php echo esc_attr($number_of_voters); ?>" placeholder="<?php esc_attr_e('Voters', 'veelinvestments'); ?>" <?php echo ($votes === 'true') ? '' : 'style=""'; ?>>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="project_details[delivery]"><?php _e('Delivery Time:', 'veelinvestments'); ?></label>
            </th>
            <td>
                <input type="number" name="project_details[delivery]" value="<?php echo esc_attr($delivery); ?>" placeholder="<?php esc_attr_e('Enter delivery year', 'veelinvestments'); ?>">
            </td>
        </tr>
    </table>
    <?php
}
function save_project_meta($post_id) {
    if (!isset($_POST['project_meta_box_nonce']) || !wp_verify_nonce($_POST['project_meta_box_nonce'], 'save_project_meta_data')) {
        return;
    }
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Check user capabilities
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    // Verify if project_details is set and is an array
    if (!isset($_POST['project_details']) || !is_array($_POST['project_details'])) {
        return;
    }
    // Sanitize project_details values
    $sanitized_project_details = array_map('sanitize_text_field', $_POST['project_details']);
    update_post_meta($post_id, 'project_details', $sanitized_project_details);
}
add_action('save_post', 'save_project_meta');
function add_faq_meta_box() {
    add_meta_box(
        'faq_meta_box',                 // $id (string) (required) - Meta box ID
        __('FAQs', 'veelinvestments'),        // $title (string) (required) - Meta box title
        'faq_meta_box_callback',        // $callback (callable) (required) - Callback function to display the contents of the meta box
        'projects',                     // $screen (string|array|WP_Screen) (required) - The screen or screens on which to show the box
        'normal',                       // $context (string) (optional) - The context within the screen where the boxes should display ('normal', 'advanced', or 'side')
        'high'                           // $priority (string) (optional) - The priority within the context where the boxes should show ('high', 'core', 'default' or 'low')
    );
}
add_action('add_meta_boxes', 'add_faq_meta_box');
function faq_meta_box_callback($post) {
    $faqs = get_post_meta($post->ID, '_faqs', true);
    ?>
    <table class="form-table">
        <thead>
        <tr>
            <th><?php _e('Question', 'veelinvestments');?></th>
            <th><?php _e('Answer', 'veelinvestments');?></th>
        </tr>
        </thead>
        <tbody>
        <?php if ($faqs) : ?>
            <?php foreach ($faqs as $index => $faq) : ?>
                <tr>
                    <td><input type="text" name="faqs[<?php echo $index; ?>][question]" value="<?php echo esc_attr($faq['question']); ?>" minlength="5" /></td>
                    <td><input type="text" name="faqs[<?php echo $index; ?>][answer]" value="<?php echo esc_attr($faq['answer']); ?>" minlength="5"/></td>
                    <td>
                        <button class="button faq-delete-button"><?php _e('Delete', 'veelinvestments');?></button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td><input type="text" name="faqs[0][question]" value="" /></td>
                <td><input type="text" name="faqs[0][answer]" value="" /></td>
                <td><button class="button faq-delete-button"><?php _e('Delete', 'veelinvestments');?></button></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <button class="button" id="add-faq-row"><?php _e('Add New Question ', 'veelinvestments');?></button>
    <script>
        jQuery(document).ready(function ($) {
            $('#add-faq-row').on('click', function () {
                var index = $('.form-table tbody tr').length;
                var newRow = '<tr>' +
                    '<td><input type="text" name="faqs[' + index + '][question]" value="" /></td>' +
                    '<td><input type="text" name="faqs[' + index + '][answer]" value="" /></td>' +
                    '<td><button class="button faq-delete-button"> <?php _e('Delete', 'veelinvestments');?> </button></td>' +
                    '</tr>';
                $('.form-table tbody').append(newRow);
                return false;
            });
            $('.faq-delete-button').on('click', function () {
                $(this).closest('tr').remove();
                return false;
            });
        });
    </script>
    <?php
}
function save_faq_meta_data($post_id) {
    if (isset($_POST['faqs'])) {
        $faqs = array();
        foreach ($_POST['faqs'] as $faq) {
            $question = sanitize_text_field($faq['question']);
            $answer = sanitize_text_field($faq['answer']);
            $faqs[] = array('question' => $question, 'answer' => $answer);
        }
        update_post_meta($post_id, '_faqs', $faqs);
    } else {
        delete_post_meta($post_id, '_faqs');
    }
}
add_action('save_post_projects', 'save_faq_meta_data');
function project_gallery_meta_box() {
    add_meta_box(
        'project_gallery_meta_box',
        __('Project Gallery', 'veelinvestments'),
        'project_gallery_meta_box_callback',
        'projects',
        'normal',
        'default'
    );
}
add_action('wp_ajax_save_project_price', 'veel_save_project_price');
function veel_save_project_price() {
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $project_price = isset($_POST['project_price']) ? sanitize_text_field($_POST['project_price']) : '';
    if ($post_id && is_numeric($project_price)) {
        update_post_meta($post_id, 'project_details', array('project_price' => $project_price));
        wp_send_json_success('تم حفظ سعر المشروع بنجاح.');
    } else {
        wp_send_json_error('يرجى إدخال قيمة صحيحة لسعر المشروع.');
    }
}

