<?php
/**
 *
 * Register Developer Taxonomy
 * @package Didos
 * @version 0.0.1
 *
 */

defined('ABSPATH') || exit;

function register_developer_taxonomy() {
  $labels = array(
    'name'                       => __('Developers', 'veelinvestments'),
    'singular_name'              => __('Developer', 'veelinvestments'),
    'search_items'               => __('Search Developers', 'veelinvestments'),
    'all_items'                  => __('All Developers', 'veelinvestments'),
    'parent_item'                => __('Parent Developer', 'veelinvestments'),
    'parent_item_colon'          => __('Parent Developer:', 'veelinvestments'),
    'edit_item'                  => __('Edit Developer', 'veelinvestments'),
    'update_item'                => __('Update Developer', 'veelinvestments'),
    'add_new_item'               => __('Add New Developer', 'veelinvestments'),
    'new_item_name'              => __('New Developer Name', 'veelinvestments'),
    'menu_name'                  => __('Developers', 'veelinvestments'),
  );

  $args = array(
    'labels'            => $labels,
    'hierarchical'      => true,
    'public'            => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array(
      'slug'         => 'developer',
      'hierarchical' => true,
      'with_front'   => false,
    ),
  );

  register_taxonomy('developer', array('projects', 'post'), $args);
}
add_action('init', 'register_developer_taxonomy');

/**
 * Add Developer Image Field
 */
function add_developer_image_field($term) {
  $term_id = $term->term_id ?? 0;
  $developer_image = '';
  if ($term_id) {
    $developer_image = get_term_meta($term_id, 'developer_image', true);
  }
  ?>
  <tr class="form-field">
    <th scope="row">
      <label for="developer-image"><?php _e('Developer Image', 'veelinvestments'); ?></label>
    </th>
    <td>
      <input type="hidden" name="developer_image" id="developer-image" value="<?php echo esc_attr($developer_image); ?>" />
      <button class="button" id="upload-developer-image"><?php _e('Upload Image', 'veelinvestments'); ?></button>
      <img src="<?php echo esc_url($developer_image); ?>" id="selected-developer-image" style="max-width: 150px; <?php echo $developer_image ? '' : 'display:none;'; ?>" />
      <p class="description"><?php _e('Upload an image for the developer.', 'veelinvestments'); ?></p>
    </td>
  </tr>
  <script>
    jQuery(document).ready(function ($) {
      var file_frame;
      $('#upload-developer-image').on('click', function (e) {
        e.preventDefault();
        if (file_frame) {
          file_frame.open();
          return;
        }
        file_frame = wp.media.frames.file_frame = wp.media({
          title: '<?php _e('Select or Upload Image', 'veelinvestments'); ?>',
          button: {
            text: '<?php _e('Use this image', 'veelinvestments'); ?>',
          },
          multiple: false
        });
        file_frame.on('select', function () {
          var attachment = file_frame.state().get('selection').first().toJSON();
          $('#developer-image').val(attachment.url);
          $('#selected-developer-image').attr('src', attachment.url).show();
        });
        file_frame.open();
      });
    });
  </script>
  <?php
}
add_action('developer_add_form_fields', 'add_developer_image_field');
add_action('developer_edit_form_fields', 'add_developer_image_field');

/**
 * Save Developer Image Field
 */
function save_developer_image_field($term_id) {
  if (isset($_POST['developer_image'])) {
    update_term_meta($term_id, 'developer_image', esc_url_raw($_POST['developer_image']));
  }
}
add_action('created_developer', 'save_developer_image_field');
add_action('edited_developer', 'save_developer_image_field');

/**
 * Add Developer Image Column
 */
function add_developer_image_column($columns) {
  $columns['developer_image'] = __('Image', 'veelinvestments');
  return $columns;
}
add_filter('manage_edit-developer_columns', 'add_developer_image_column');

/**
 * Display Developer Image in Column
 */
function display_developer_image_column($content, $column_name, $term_id) {
  if ($column_name === 'developer_image') {
    $developer_image = get_term_meta($term_id, 'developer_image', true);
    if ($developer_image) {
      $content = '<img src="' . esc_url($developer_image) . '" style="max-width:50px;height:auto;" />';
    } else {
      $content = __('No Image', 'veelinvestments');
    }
  }
  return $content;
}
add_filter('manage_developer_custom_column', 'display_developer_image_column', 10, 3);

/**
 * Add Developer FAQs Fields
 */
function add_developer_faq_fields($term) {
  $term_id = $term->term_id ?? 0;
  $faqs = get_term_meta($term_id, '_faqs', true);
  $faqs = is_array($faqs) ? $faqs : array();
  wp_nonce_field('save_developer_faqs', 'developer_faqs_nonce');
  ?>
  <tr class="form-field">
    <th scope="row" valign="top">
      <label><?php _e('Developer FAQs', 'veelinvestments'); ?></label>
    </th>
    <td>
      <div id="faqs-wrapper">
        <?php foreach ($faqs as $index => $faq) : ?>
          <div class="faq-item">
            <p>
              <label><?php _e('Question', 'veelinvestments'); ?>:</label>
              <input type="text" name="faqs[<?php echo $index; ?>][question]" value="<?php echo esc_attr($faq['question']); ?>" />
            </p>
            <p>
              <label><?php _e('Answer', 'veelinvestments'); ?>:</label>
              <textarea name="faqs[<?php echo $index; ?>][answer]" rows="3"><?php echo esc_textarea($faq['answer']); ?></textarea>
            </p>
            <button class="button remove-faq"><?php _e('Remove', 'veelinvestments'); ?></button>
            <hr />
          </div>
        <?php endforeach; ?>
      </div>
      <button class="button" id="add-faq"><?php _e('Add FAQ', 'veelinvestments'); ?></button>
      <p class="description"><?php _e('Add frequently asked questions for the developer.', 'veelinvestments'); ?></p>
    </td>
  </tr>
  <script>
    jQuery(document).ready(function ($) {
      var faqIndex = <?php echo count($faqs); ?>;
      $('#add-faq').on('click', function (e) {
        e.preventDefault();
        var faqItem = '<div class="faq-item">' +
          '<p><label><?php _e('Question', 'veelinvestments'); ?>:</label>' +
          '<input type="text" name="faqs[' + faqIndex + '][question]" /></p>' +
          '<p><label><?php _e('Answer', 'veelinvestments'); ?>:</label>' +
          '<textarea name="faqs[' + faqIndex + '][answer]" rows="3"></textarea></p>' +
          '<button class="button remove-faq"><?php _e('Remove', 'veelinvestments'); ?></button><hr /></div>';
        $('#faqs-wrapper').append(faqItem);
        faqIndex++;
      });
      $(document).on('click', '.remove-faq', function (e) {
        e.preventDefault();
        $(this).closest('.faq-item').remove();
      });
    });
  </script>
  <?php
}
add_action('developer_edit_form_fields', 'add_developer_faq_fields');

/**
 * Save Developer FAQs Fields
 */
function save_developer_faq_fields($term_id) {
  if (!isset($_POST['developer_faqs_nonce']) || !wp_verify_nonce($_POST['developer_faqs_nonce'], 'save_developer_faqs')) {
    return;
  }
  if (isset($_POST['faqs']) && is_array($_POST['faqs'])) {
    $faqs = array();
    foreach ($_POST['faqs'] as $faq) {
      $faqs[] = array(
        'question' => sanitize_text_field($faq['question']),
        'answer'   => sanitize_textarea_field($faq['answer']),
      );
    }
    update_term_meta($term_id, '_faqs', $faqs);
  } else {
    delete_term_meta($term_id, '_faqs');
  }
}
add_action('edited_developer', 'save_developer_faq_fields');

/**
 * Add Developer Content Editor
 */
function add_developer_content_editor($term) {
  $term_id = $term->term_id ?? 0;
  $developer_content = get_term_meta($term_id, 'developer_content', true);
  wp_nonce_field('save_developer_content', 'developer_content_nonce');
  ?>
  <tr class="form-field">
    <th scope="row" valign="top">
      <label for="developer-content"><?php _e('Developer Content', 'veelinvestments'); ?></label>
    </th>
    <td>
      <?php
      wp_editor($developer_content, 'developer_content', array(
        'textarea_name' => 'developer_content',
        'media_buttons' => true,
        'textarea_rows' => 10,
      ));
      ?>
      <p class="description"><?php _e('Add detailed content for the developer.', 'veelinvestments'); ?></p>
    </td>
  </tr>
  <?php
}
add_action('developer_edit_form_fields', 'add_developer_content_editor');

/**
 * Save Developer Content
 */
function save_developer_content($term_id) {
  if (!isset($_POST['developer_content_nonce']) || !wp_verify_nonce($_POST['developer_content_nonce'], 'save_developer_content')) {
    return;
  }
  if (isset($_POST['developer_content'])) {
    update_term_meta($term_id, 'developer_content', wp_kses_post($_POST['developer_content']));
  }
}
add_action('edited_developer', 'save_developer_content');
