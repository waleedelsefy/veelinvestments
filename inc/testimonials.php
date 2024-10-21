<?php
function register_testimonial_post_type() {
  $labels = array(
    'name'               => __('Testimonials', 'veeltheme'),
    'singular_name'      => __('Testimonial', 'veeltheme'),
    'add_new'            => __('Add New Testimonial', 'veeltheme'),
    'add_new_item'       => __('Add New Testimonial', 'veeltheme'),
    'edit_item'          => __('Edit Testimonial', 'veeltheme'),
    'new_item'           => __('New Testimonial', 'veeltheme'),
    'all_items'          => __('All Testimonials', 'veeltheme'),
    'view_item'          => __('View Testimonial', 'veeltheme'),
    'search_items'       => __('Search Testimonials', 'veeltheme'),
    'not_found'          => __('No testimonials found', 'veeltheme'),
    'not_found_in_trash' => __('No testimonials found in trash', 'veeltheme'),
    'menu_name'          => __('Testimonials', 'veeltheme'),
  );

  $args = array(
    'labels'        => $labels,
    'public'        => true,
    'has_archive'   => true,
    'rewrite'       => array('slug' => 'testimonials'),
    'supports'      => array('title', 'editor'),
    'show_in_rest'  => true,
    'capability_type' => 'post',
    'taxonomies'    => array(),
  );

  register_post_type('testimonial', $args);
}
add_action('init', 'register_testimonial_post_type');

function add_testimonial_meta_box() {
  add_meta_box(
    'testimonial_meta_box',
    __('Testimonial Details', 'veeltheme'),
    'display_testimonial_meta_box',
    'testimonial',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'add_testimonial_meta_box');

// دالة العرض لحقول الميتا
function display_testimonial_meta_box($post) {
  $author_name = get_post_meta($post->ID, 'testimonial_author_name', true);
  $author_job = get_post_meta($post->ID, 'testimonial_author_job', true);
  ?>
  <table class="form-table">
    <tr>
      <th><label for="testimonial_author_name"><?php _e('Author Name', 'veelinvestments'); ?></label></th>
      <td>
        <input type="text" name="testimonial_author_name" id="testimonial_author_name" value="<?php echo esc_attr($author_name); ?>" size="25" />
      </td>
    </tr>
    <tr>
      <th><label for="testimonial_author_job"><?php _e('Author Job', 'veelinvestments'); ?></label></th>
      <td>
        <input type="text" name="testimonial_author_job" id="testimonial_author_job" value="<?php echo esc_attr($author_job); ?>" size="25" />
      </td>
    </tr>
  </table>
  <?php
}

// حفظ البيانات
function save_testimonial_meta_data($post_id) {
  // تحقق من الصلاحيات
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // تحقق من المستخدم
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // حفظ البيانات
  if (isset($_POST['testimonial_author_name'])) {
    update_post_meta($post_id, 'testimonial_author_name', sanitize_text_field($_POST['testimonial_author_name']));
  }

  if (isset($_POST['testimonial_author_job'])) {
    update_post_meta($post_id, 'testimonial_author_job', sanitize_text_field($_POST['testimonial_author_job']));
  }
}
add_action('save_post', 'save_testimonial_meta_data');
