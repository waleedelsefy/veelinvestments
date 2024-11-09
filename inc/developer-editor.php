<?php
/**
 * Register Developer Taxonomy
 * @package Didos
 * @version 0.0.1
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
    'rewrite'           => array('slug' => 'developer', 'hierarchical' => true, 'with_front' => false),
  );

  register_taxonomy('developer', array('projects', 'post'), $args);
}
add_action('init', 'register_developer_taxonomy');

/**
 * Add Logo, Featured Image, and Body Fields for Developer
 */
function add_developer_image_fields($term) {
  $term_id = $term->term_id ?? 0;
  $developer_image = get_term_meta($term_id, 'developer_image', true);
  $featured_image = get_term_meta($term_id, 'featured_image', true);
  $developer_body = get_term_meta($term_id, 'developer_body', true); // استرجاع المحتوى

  ?>
  <!-- Logo Field -->
  <tr class="form-field">
    <th scope="row">
      <label for="developer-logo-image"><?php _e('Developer Logo', 'veelinvestments'); ?></label>
    </th>
    <td>
      <input type="hidden" name="developer_image" id="developer-logo-image" value="<?php echo esc_attr($developer_image); ?>" />
      <button class="button" id="upload-logo-image"><?php _e('Upload Logo', 'veelinvestments'); ?></button>
      <img src="<?php echo esc_url($developer_image); ?>" id="selected-logo-image" style="max-width: 150px; <?php echo $developer_image ? '' : 'display:none;'; ?>" />
      <p class="description"><?php _e('Upload a logo image for the developer.', 'veelinvestments'); ?></p>
    </td>
  </tr>

  <!-- Featured Image Field -->
  <tr class="form-field">
    <th scope="row">
      <label for="developer-featured-image"><?php _e('Featured Image', 'veelinvestments'); ?></label>
    </th>
    <td>
      <input type="hidden" name="featured_image" id="developer-featured-image" value="<?php echo esc_attr($featured_image); ?>" />
      <button class="button" id="upload-featured-image"><?php _e('Upload Featured Image', 'veelinvestments'); ?></button>
      <img src="<?php echo esc_url($featured_image); ?>" id="selected-featured-image" style="max-width: 150px; <?php echo $featured_image ? '' : 'display:none;'; ?>" />
      <p class="description"><?php _e('Upload a featured image for the developer.', 'veelinvestments'); ?></p>
    </td>
  </tr>

  <!-- Body Content Field -->
  <tr class="form-field">
    <th scope="row" valign="top">
      <label for="developer-body"><?php _e('Developer Body', 'veelinvestments'); ?></label>
    </th>
    <td>
      <?php
      wp_editor($developer_body, 'developer_body', array(
        'textarea_name' => 'developer_body',
        'media_buttons' => true,
        'textarea_rows' => 10,
      ));
      ?>
      <p class="description"><?php _e('Add detailed content for the developer.', 'veelinvestments'); ?></p>
    </td>
  </tr>

  <script>
    jQuery(document).ready(function ($) {
      var file_frame;
      // Logo upload
      $('#upload-logo-image').on('click', function (e) {
        e.preventDefault();
        if (file_frame) {
          file_frame.open();
          return;
        }
        file_frame = wp.media.frames.file_frame = wp.media({
          title: '<?php _e('Select or Upload Logo', 'veelinvestments'); ?>',
          button: { text: '<?php _e('Use this image', 'veelinvestments'); ?>' },
          multiple: false
        });
        file_frame.on('select', function () {
          var attachment = file_frame.state().get('selection').first().toJSON();
          $('#developer-logo-image').val(attachment.url);
          $('#selected-logo-image').attr('src', attachment.url).show();
        });
        file_frame.open();
      });
      // Featured Image upload
      $('#upload-featured-image').on('click', function (e) {
        e.preventDefault();
        if (file_frame) {
          file_frame.open();
          return;
        }
        file_frame = wp.media.frames.file_frame = wp.media({
          title: '<?php _e('Select or Upload Featured Image', 'veelinvestments'); ?>',
          button: { text: '<?php _e('Use this image', 'veelinvestments'); ?>' },
          multiple: false
        });
        file_frame.on('select', function () {
          var attachment = file_frame.state().get('selection').first().toJSON();
          $('#developer-featured-image').val(attachment.url);
          $('#selected-featured-image').attr('src', attachment.url).show();
        });
        file_frame.open();
      });
    });
  </script>
  <?php
}
add_action('developer_add_form_fields', 'add_developer_image_fields');
add_action('developer_edit_form_fields', 'add_developer_image_fields');

/**
 * Save Logo, Featured Image, and Body Fields
 */
function save_developer_image_fields($term_id) {
  if (isset($_POST['developer_image'])) {
    update_term_meta($term_id, 'developer_image', esc_url_raw($_POST['developer_image']));
  }
  if (isset($_POST['featured_image'])) {
    update_term_meta($term_id, 'featured_image', esc_url_raw($_POST['featured_image']));
  }
  if (isset($_POST['developer_body'])) {
    update_term_meta($term_id, 'developer_body', wp_kses_post($_POST['developer_body']));
  }
}
add_action('created_developer', 'save_developer_image_fields');
add_action('edited_developer', 'save_developer_image_fields');


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
            <p><label><?php _e('Question', 'veelinvestments'); ?>:</label>
              <input type="text" name="faqs[<?php echo $index; ?>][question]" value="<?php echo esc_attr($faq['question']); ?>" />
            </p>
            <p><label><?php _e('Answer', 'veelinvestments'); ?>:</label>
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
        var faqItem = '<div class="faq-item"><p><label><?php _e('Question', 'veelinvestments'); ?>:</label>' +
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
