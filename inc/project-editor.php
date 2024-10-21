<?php
/**
 * Register Projects Post Type
 * @package Didos
 * @version 0.0.1
 */

function register_project_post_type() {
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
    'labels'            => $labels,
    'public'            => true,
    'has_archive'       => true,
    'menu_icon'         => 'dashicons-admin-multisite',
    'rewrite'           => array('slug' => 'projects'),
    'supports'          => array('title', 'editor', 'thumbnail', 'author'),
    'capability_type'   => 'post',
  );

  register_post_type('projects', $args);
}
add_action('init', 'register_project_post_type');

/**
 * Customize the project permalink structure.
 */
function custom_project_permalink($permalink, $post_id) {
  if (get_post_type($post_id) === 'projects') {
    $permalink = trailingslashit(home_url('/projects/' . get_post_field('post_name', $post_id)));
  }
  return $permalink;
}
add_filter('post_type_link', 'custom_project_permalink', 10, 2);

/**
 * Register taxonomy for project types.
 */
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

/**
 * Add project details meta box.
 */
function add_project_details_meta_boxes() {
  add_meta_box('project_details_metabox', __('Project Details', 'veelinvestments'), 'render_project_details_metabox', 'projects', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_project_details_meta_boxes');

/**
 * Render the project details meta box.
 */
function render_project_details_metabox($post) {
  wp_nonce_field('save_project_meta_data', 'project_meta_box_nonce');
  $project_details = get_post_meta($post->ID, 'project_details', true);
  $unit_price = get_post_meta($post->ID, 'unit_price', true);
  $unit_space = $project_details['unit_space'] ?? '';
  $payment_systems = $project_details['payment_systems'] ?? '';
  $down_payment = $project_details['down_payment'] ?? '';
  $installment = $project_details['installment'] ?? '';
  $project_location = $project_details['project_location'] ?? '';
  $delivery = $project_details['delivery'] ?? '';
  $installment_1 = $project_details['installment_1'] ?? '';
  $installment_2 = $project_details['installment_2'] ?? '';
  $installment_3 = $project_details['installment_3'] ?? '';
  $votes = $project_details['votes'] ?? '';
  $number_of_votes = $project_details['number_of_votes'] ?? '';
  $number_of_voters = $project_details['number_of_voters'] ?? '';

  ?>
  <table class="form-table">
    <tr>
      <th><?php _e('Unit Space:', 'veelinvestments'); ?></th>
      <td><input type="number" name="project_details[unit_space]" value="<?php echo esc_attr($unit_space); ?>" placeholder="<?php esc_attr_e('Enter Unit Space', 'veelinvestments'); ?>"></td>
    </tr>
    <tr>
      <th><?php _e('Unit Location:', 'veelinvestments'); ?></th>
      <td><input type="text" name="project_details[project_location]" value="<?php echo esc_attr($project_location); ?>" placeholder="<?php esc_attr_e('Enter Unit Location', 'veelinvestments'); ?>"></td>
    </tr>
    <tr>
      <th><?php _e('unit Price:', 'veelinvestments'); ?></th>
      <td><input type="number" name="unit_price" value="<?php echo esc_attr($unit_price); ?>" placeholder="<?php esc_attr_e('Enter Unit Price', 'veelinvestments'); ?>"></td>
    </tr>
    <tr>
      <th><?php _e('Payment Systems:', 'veelinvestments'); ?></th>
      <td>
        <select name="project_details[payment_systems]">
          <option value="cash" <?php selected($payment_systems, 'cash'); ?>><?php esc_html_e('Cash', 'veelinvestments'); ?></option>
          <option value="installment" <?php selected($payment_systems, 'installment'); ?>><?php esc_html_e('Installment', 'veelinvestments'); ?></option>
          <option value="both" <?php selected($payment_systems, 'both'); ?>><?php esc_html_e('Both Cash and Installment', 'veelinvestments'); ?></option>
        </select>
        <input type="number" min="0" max="99" name="project_details[down_payment]" value="<?php echo esc_attr($down_payment); ?>" placeholder="<?php esc_attr_e('Enter Down Payment', 'veelinvestments'); ?>"> %
        <input type="number" min="0" max="30" name="project_details[installment]" value="<?php echo esc_attr($installment); ?>" placeholder="<?php esc_attr_e('Enter Installment Payment', 'veelinvestments'); ?>">
      </td>
    </tr>
    <th></th>
    <td> <h2 style="font-size: 22px; font-weight: 800"><?php _e('Installments for several years', 'veelinvestments'); ?></h2></td>
    <tr>
      <th><?php _e('7 Years:', 'veelinvestments'); ?></th>
      <td><input type="number" name="project_details[installment_1]" value="<?php echo esc_attr($installment_1); ?>" placeholder="<?php esc_attr_e('Enter for 7 Years', 'veelinvestments'); ?>"></td>
    </tr>
    <tr>
      <th><?php _e('5 Years:', 'veelinvestments'); ?></th>
      <td><input type="number" name="project_details[installment_2]" value="<?php echo esc_attr($installment_2); ?>" placeholder="<?php esc_attr_e('Enter for 5 Years', 'veelinvestments'); ?>"></td>
    </tr>
    <tr>
      <th><?php _e('3 Years:', 'veelinvestments'); ?></th>
      <td><input type="number" name="project_details[installment_3]" value="<?php echo esc_attr($installment_3); ?>" placeholder="<?php esc_attr_e('Enter for 3 Years', 'veelinvestments'); ?>"></td>
    </tr>
  </table>
  <?php
}

/**
 * Save project meta data.
 */
function save_project_meta($post_id) {
  // Check for nonce security
  if (!isset($_POST['project_meta_box_nonce']) || !wp_verify_nonce($_POST['project_meta_box_nonce'], 'save_project_meta_data')) {
    return;
  }

  // Prevent auto-save from overwriting the data
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Ensure the user has permission to edit the post
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Check if the project_details array is set and is an array
  if (isset($_POST['project_details']) && is_array($_POST['project_details'])) {
    // Sanitize and save the meta data
    $sanitized_project_details = array_map('sanitize_text_field', $_POST['project_details']);
    update_post_meta($post_id, 'project_details', $sanitized_project_details);
  }

  // Check if the unit_price field is set
  if (isset($_POST['unit_price'])) {
    // Sanitize the unit price and save it separately
    $sanitized_unit_price = sanitize_text_field($_POST['unit_price']);
    update_post_meta($post_id, 'unit_price', $sanitized_unit_price);
  }
}
add_action('save_post', 'save_project_meta');


/**
 * Add FAQ meta box.
 */
function add_faq_meta_box() {
  add_meta_box('faq_meta_box', __('FAQs', 'veelinvestments'), 'faq_meta_box_callback', 'projects', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_faq_meta_box');

/**
 * Render the FAQ meta box.
 */
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
          <td><input type="text" name="faqs[<?php echo $index; ?>][question]" value="<?php echo esc_attr($faq['question']); ?>" /></td>
          <td><input type="text" name="faqs[<?php echo $index; ?>][answer]" value="<?php echo esc_attr($faq['answer']); ?>" /></td>
          <td><button class="button faq-delete-button"><?php _e('Delete', 'veelinvestments');?></button></td>
        </tr>
      <?php endforeach; ?>
    <?php else : ?>
      <tr>
        <td><input type="text" name="faqs[0][question]" /></td>
        <td><input type="text" name="faqs[0][answer]" /></td>
        <td><button class="button faq-delete-button"><?php _e('Delete', 'veelinvestments');?></button></td>
      </tr>
    <?php endif; ?>
    </tbody>
  </table>
  <button class="button" id="add-faq-row"><?php _e('Add New Question', 'veelinvestments');?></button>
  <script>
    jQuery(document).ready(function ($) {
      $('#add-faq-row').on('click', function () {
        var index = $('.form-table tbody tr').length;
        var newRow = '<tr>' +
          '<td><input type="text" name="faqs[' + index + '][question]" /></td>' +
          '<td><input type="text" name="faqs[' + index + '][answer]" /></td>' +
          '<td><button class="button faq-delete-button"><?php _e('Delete', 'veelinvestments');?></button></td>' +
          '</tr>';
        $('.form-table tbody').append(newRow);
        return false;
      });

      $(document).on('click', '.faq-delete-button', function () {
        $(this).closest('tr').remove();
        return false;
      });
    });
  </script>
  <?php
}

/**
 * Save FAQ meta data.
 */
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

/**
 * Handle AJAX request for saving project price.
 */
function veel_save_project_price() {
  $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
  $project_price = isset($_POST['project_price']) ? sanitize_text_field($_POST['project_price']) : '';

  if ($post_id && is_numeric($project_price)) {
    update_post_meta($post_id, 'project_details', array('project_price' => $project_price));
    wp_send_json_success(__('Project price saved successfully.', 'veelinvestments'));
  } else {
    wp_send_json_error(__('Please enter a valid project price.', 'veelinvestments'));
  }
}
add_action('wp_ajax_save_project_price', 'veel_save_project_price');
