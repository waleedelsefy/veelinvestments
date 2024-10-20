<?php
/**
 *
 * Register City Taxonomy
 * @package Didos
 * @version 0.0.1
 *
 */
defined('ABSPATH') || exit;

function register_city_taxonomy() {
  $labels = array(
    'name'                       => __('Cities', 'veelinvestments'),
    'singular_name'              => __('City', 'veelinvestments'),
    'search_items'               => __('Search Cities', 'veelinvestments'),
    'all_items'                  => __('All Cities', 'veelinvestments'),
    'parent_item'                => __('Parent City', 'veelinvestments'),
    'parent_item_colon'          => __('Parent City:', 'veelinvestments'),
    'edit_item'                  => __('Edit City', 'veelinvestments'),
    'update_item'                => __('Update City', 'veelinvestments'),
    'add_new_item'               => __('Add New City', 'veelinvestments'),
    'new_item_name'              => __('New City Name', 'veelinvestments'),
    'menu_name'                  => __('Cities', 'veelinvestments'),
  );

  $args = array(
    'labels'            => $labels,
    'hierarchical'      => true,
    'public'            => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array(
      'slug'         => 'city',
      'hierarchical' => true,
      'with_front'   => false,
    ),
  );

  register_taxonomy('city', array('projects','post'), $args);
}
add_action('init', 'register_city_taxonomy');

/**
 * Add City Image Field
 */
function add_city_image_field($term) {
  $term_id = $term->term_id ?? 0;
  $city_image = '';
  if ($term_id) {
    $city_image = get_term_meta($term_id, 'city_image', true);
  }
  ?>
  <tr class="form-field">
    <th scope="row">
      <label for="city-image"><?php _e('City Image', 'veelinvestments'); ?></label>
    </th>
    <td>
      <input type="hidden" name="city_image" id="city-image" value="<?php echo esc_attr($city_image); ?>" />
      <button class="button" id="upload-city-image"><?php _e('Upload Image', 'veelinvestments'); ?></button>
      <img src="<?php echo esc_url($city_image); ?>" id="selected-city-image" style="max-width: 150px; <?php echo $city_image ? '' : 'display:none;'; ?>" />
      <p class="description"><?php _e('Upload an image for the city.', 'veelinvestments'); ?></p>
    </td>
  </tr>
  <script>
    jQuery(document).ready(function ($) {
      var file_frame;
      $('#upload-city-image').on('click', function (e) {
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
          $('#city-image').val(attachment.url);
          $('#selected-city-image').attr('src', attachment.url).show();
        });
        file_frame.open();
      });
    });
  </script>
  <?php
}
add_action('city_add_form_fields', 'add_city_image_field');
add_action('city_edit_form_fields', 'add_city_image_field');

/**
 * Save City Image Field
 */
function save_city_image_field($term_id) {
  if (isset($_POST['city_image'])) {
    update_term_meta($term_id, 'city_image', esc_url_raw($_POST['city_image']));
  }
}
add_action('created_city', 'save_city_image_field');
add_action('edited_city', 'save_city_image_field');

/**
 * Add City Image Column
 */
function add_city_image_column($columns) {
  $columns['city_image'] = __('Image', 'veelinvestments');
  return $columns;
}
add_filter('manage_edit-city_columns', 'add_city_image_column');

/**
 * Display City Image in Column
 */
function display_city_image_column($content, $column_name, $term_id) {
  if ($column_name === 'city_image') {
    $city_image = get_term_meta($term_id, 'city_image', true);
    if ($city_image) {
      $content = '<img src="' . esc_url($city_image) . '" style="max-width:50px;height:auto;" />';
    } else {
      $content = __('No Image', 'veelinvestments');
    }
  }
  return $content;
}
add_filter('manage_city_custom_column', 'display_city_image_column', 10, 3);

/**
 * Add City FAQs Fields
 */
function add_city_faq_fields($term) {
  $term_id = $term->term_id ?? 0;
  $faqs = get_term_meta($term_id, '_faqs', true);
  $faqs = is_array($faqs) ? $faqs : array();
  wp_nonce_field('save_city_faqs', 'city_faqs_nonce');
  ?>
  <tr class="form-field">
    <th scope="row" valign="top">
      <label><?php _e('City FAQs', 'veelinvestments'); ?></label>
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
      <p class="description"><?php _e('Add frequently asked questions for the city.', 'veelinvestments'); ?></p>
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
add_action('city_edit_form_fields', 'add_city_faq_fields');

/**
 * Save City FAQs Fields
 */
function save_city_faq_fields($term_id) {
  if (!isset($_POST['city_faqs_nonce']) || !wp_verify_nonce($_POST['city_faqs_nonce'], 'save_city_faqs')) {
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
add_action('edited_city', 'save_city_faq_fields');

/**
 * Add City Content Editor
 */
function add_city_content_editor($term) {
  $term_id = $term->term_id ?? 0;
  $city_content = get_term_meta($term_id, 'city_content', true);
  wp_nonce_field('save_city_content', 'city_content_nonce');
  ?>
  <tr class="form-field">
    <th scope="row" valign="top">
      <label for="city-content"><?php _e('City Content', 'veelinvestments'); ?></label>
    </th>
    <td>
      <?php
      wp_editor($city_content, 'city_content', array(
        'textarea_name' => 'city_content',
        'media_buttons' => true,
        'textarea_rows' => 10,
      ));
      ?>
      <p class="description"><?php _e('Add detailed content for the city.', 'veelinvestments'); ?></p>
    </td>
  </tr>
  <?php
}
add_action('city_edit_form_fields', 'add_city_content_editor');

/**
 * Save City Content
 */
function save_city_content($term_id) {
  if (!isset($_POST['city_content_nonce']) || !wp_verify_nonce($_POST['city_content_nonce'], 'save_city_content')) {
    return;
  }
  if (isset($_POST['city_content'])) {
    update_term_meta($term_id, 'city_content', wp_kses_post($_POST['city_content']));
  }
}
add_action('edited_city', 'save_city_content');
