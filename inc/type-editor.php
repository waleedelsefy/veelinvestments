<?php
/**
 *
 * Register Property type Taxonomy
 * @package Didos
 * @version 0.0.1
 *
 */

defined('ABSPATH') || exit;

function register_property_type_taxonomy() {
  $labels = array(
    'name'                       => __('Property types', 'veelinvestments'),
    'singular_name'              => __('Property type', 'veelinvestments'),
    'search_items'               => __('Search Property types', 'veelinvestments'),
    'all_items'                  => __('All Property types', 'veelinvestments'),
    'parent_item'                => __('Parent Property type', 'veelinvestments'),
    'parent_item_colon'          => __('Parent Property type:', 'veelinvestments'),
    'edit_item'                  => __('Edit Property type', 'veelinvestments'),
    'update_item'                => __('Update Property type', 'veelinvestments'),
    'add_new_item'               => __('Add New Property type', 'veelinvestments'),
    'new_item_name'              => __('New Property type Name', 'veelinvestments'),
    'menu_name'                  => __('Property types', 'veelinvestments'),
  );

  $args = array(
    'labels'            => $labels,
    'hierarchical'      => true,
    'public'            => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array(
      'slug'         => 'property_type',
      'hierarchical' => true,
      'with_front'   => false,
    ),
  );

  register_taxonomy('property_type', array('projects', 'post'), $args);
}
add_action('init', 'register_property_type_taxonomy');

/**
 * Add Property type Image Field
 */
function add_property_type_image_field($term) {
  $term_id = $term->term_id ?? 0;
  $property_type_image = '';
  if ($term_id) {
    $property_type_image = get_term_meta($term_id, 'property_type_image', true);
  }
  ?>
  <tr class="form-field">
    <th scope="row">
      <label for="property_type-image"><?php _e('Property type Image', 'veelinvestments'); ?></label>
    </th>
    <td>
      <input type="hidden" name="property_type_image" id="property_type-image" value="<?php echo esc_attr($property_type_image); ?>" />
      <button class="button" id="upload-property_type-image"><?php _e('Upload Image', 'veelinvestments'); ?></button>
      <img src="<?php echo esc_url($property_type_image); ?>" id="selected-property_type-image" style="max-width: 150px; <?php echo $property_type_image ? '' : 'display:none;'; ?>" />
      <p class="description"><?php _e('Upload an image for the property_type.', 'veelinvestments'); ?></p>
    </td>
  </tr>
  <script>
    jQuery(document).ready(function ($) {
      var file_frame;
      $('#upload-property_type-image').on('click', function (e) {
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
          $('#property_type-image').val(attachment.url);
          $('#selected-property_type-image').attr('src', attachment.url).show();
        });
        file_frame.open();
      });
    });
  </script>
  <?php
}
add_action('property_type_add_form_fields', 'add_property_type_image_field');
add_action('property_type_edit_form_fields', 'add_property_type_image_field');

/**
 * Save Property type Image Field
 */
function save_property_type_image_field($term_id) {
  if (isset($_POST['property_type_image'])) {
    update_term_meta($term_id, 'property_type_image', esc_url_raw($_POST['property_type_image']));
  }
}
add_action('created_property_type', 'save_property_type_image_field');
add_action('edited_property_type', 'save_property_type_image_field');

/**
 * Add Property type Image Column
 */
function add_property_type_image_column($columns) {
  $columns['property_type_image'] = __('Image', 'veelinvestments');
  return $columns;
}
add_filter('manage_edit-property_type_columns', 'add_property_type_image_column');

/**
 * Display Property type Image in Column
 */
function display_property_type_image_column($content, $column_name, $term_id) {
  if ($column_name === 'property_type_image') {
    $property_type_image = get_term_meta($term_id, 'property_type_image', true);
    if ($property_type_image) {
      $content = '<img src="' . esc_url($property_type_image) . '" style="max-width:50px;height:auto;" />';
    } else {
      $content = __('No Image', 'veelinvestments');
    }
  }
  return $content;
}
add_filter('manage_property_type_custom_column', 'display_property_type_image_column', 10, 3);

/**
 * Add Property type FAQs Fields
 */
function add_property_type_faq_fields($term) {
  $term_id = $term->term_id ?? 0;
  $faqs = get_term_meta($term_id, '_faqs', true);
  $faqs = is_array($faqs) ? $faqs : array();
  wp_nonce_field('save_property_type_faqs', 'property_type_faqs_nonce');
  ?>
  <tr class="form-field">
    <th scope="row" valign="top">
      <label><?php _e('Property type FAQs', 'veelinvestments'); ?></label>
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
      <p class="description"><?php _e('Add frequently asked questions for the property_type.', 'veelinvestments'); ?></p>
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
add_action('property_type_edit_form_fields', 'add_property_type_faq_fields');

/**
 * Save Property type FAQs Fields
 */
function save_property_type_faq_fields($term_id) {
  if (!isset($_POST['property_type_faqs_nonce']) || !wp_verify_nonce($_POST['property_type_faqs_nonce'], 'save_property_type_faqs')) {
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
add_action('edited_property_type', 'save_property_type_faq_fields');

/**
 * Add Property type Content Editor
 */
function add_property_type_content_editor($term) {
  $term_id = $term->term_id ?? 0;
  $property_type_content = get_term_meta($term_id, 'property_type_content', true);
  wp_nonce_field('save_property_type_content', 'property_type_content_nonce');
  ?>
  <tr class="form-field">
    <th scope="row" valign="top">
      <label for="property_type-content"><?php _e('Property type Content', 'veelinvestments'); ?></label>
    </th>
    <td>
      <?php
      wp_editor($property_type_content, 'property_type_content', array(
        'textarea_name' => 'property_type_content',
        'media_buttons' => true,
        'textarea_rows' => 10,
      ));
      ?>
      <p class="description"><?php _e('Add detailed content for the property_type.', 'veelinvestments'); ?></p>
    </td>
  </tr>
  <?php
}
add_action('property_type_edit_form_fields', 'add_property_type_content_editor');

/**
 * Save Property type Content
 */
function save_property_type_content($term_id) {
  if (!isset($_POST['property_type_content_nonce']) || !wp_verify_nonce($_POST['property_type_content_nonce'], 'save_property_type_content')) {
    return;
  }
  if (isset($_POST['property_type_content'])) {
    update_term_meta($term_id, 'property_type_content', wp_kses_post($_POST['property_type_content']));
  }
}
add_action('edited_property_type', 'save_property_type_content');
