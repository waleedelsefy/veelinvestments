<?php
function add_project_facilities_metabox() {
    add_meta_box(
        'project_facilities',
        __('Project Facilities', 'veelinvestments'),
        'render_project_facilities_metabox',
        array('post', 'projects', 'units'),
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'add_project_facilities_metabox');
function render_project_facilities_metabox($post) {
    $stored_facilities = get_post_meta($post->ID, '_project_facilities', true);
    $stored_facilities = maybe_unserialize($stored_facilities);

    $facilities = [
      'electronic_gates' => __('Electronic Gates', 'veelinvestments'),
      'security' => __('Security', 'veelinvestments'),
      'commercial_area' => __('Commercial Area', 'veelinvestments'),
      'social_club' => __('Social Club', 'veelinvestments'),
      'schools' => __('Schools', 'veelinvestments'),
      'shopping_center' => __('Shopping Center', 'veelinvestments'),
      'maintenance_cleaning' => __('Maintenance and Cleaning', 'veelinvestments'),
    ];

    foreach ($facilities as $key => $facility) {
        $checked = (is_array($stored_facilities) && in_array($key, $stored_facilities)) ? 'checked' : '';
        echo '<label><input type="checkbox" name="project_facilities[]" value="' . esc_attr($key) . '" ' . $checked . '> ' . esc_html($facility) . '</label><br>';
    }

    wp_nonce_field('save_project_facilities', 'project_facilities_nonce');
}

function save_project_facilities($post_id) {
    if (!isset($_POST['project_facilities_nonce']) || !wp_verify_nonce($_POST['project_facilities_nonce'], 'save_project_facilities')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['project_facilities']) && is_array($_POST['project_facilities'])) {
        $facilities = array_map('sanitize_text_field', $_POST['project_facilities']);
        update_post_meta($post_id, '_project_facilities', maybe_serialize($facilities));
    } else {
        delete_post_meta($post_id, '_project_facilities');
    }
}
add_action('save_post', 'save_project_facilities');
?>
