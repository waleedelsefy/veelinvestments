<?php

// Add extra fields to user profile for social media links
function add_social_media_fields($user) { ?>
  <h3><?php _e('Social Media Information', 'veelinvestments'); ?></h3>

  <table class="form-table">
    <tr>
      <th><label for="youtube"><?php _e('YouTube URL', 'veelinvestments'); ?></label></th>
      <td><input type="text" name="youtube" id="youtube" value="<?php echo esc_attr(get_the_author_meta('youtube', $user->ID)); ?>" class="regular-text" /></td>
    </tr>
    <tr>
      <th><label for="linkedin"><?php _e('LinkedIn URL', 'veelinvestments'); ?></label></th>
      <td><input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr(get_the_author_meta('linkedin', $user->ID)); ?>" class="regular-text" /></td>
    </tr>
    <tr>
      <th><label for="facebook"><?php _e('Facebook URL', 'veelinvestments'); ?></label></th>
      <td><input type="text" name="facebook" id="facebook" value="<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)); ?>" class="regular-text" /></td>
    </tr>
    <tr>
      <th><label for="instagram"><?php _e('Instagram URL', 'veelinvestments'); ?></label></th>
      <td><input type="text" name="instagram" id="instagram" value="<?php echo esc_attr(get_the_author_meta('instagram', $user->ID)); ?>" class="regular-text" /></td>
    </tr>
  </table>
<?php }
add_action('show_user_profile', 'add_social_media_fields');
add_action('edit_user_profile', 'add_social_media_fields');

// Save the custom social media fields
function save_social_media_fields($user_id) {
  if (!current_user_can('edit_user', $user_id)) return false;
  update_user_meta($user_id, 'youtube', $_POST['youtube']);
  update_user_meta($user_id, 'linkedin', $_POST['linkedin']);
  update_user_meta($user_id, 'facebook', $_POST['facebook']);
  update_user_meta($user_id, 'instagram', $_POST['instagram']);
}
add_action('personal_options_update', 'save_social_media_fields');
add_action('edit_user_profile_update', 'save_social_media_fields');
