<?php

// Add meta box for image gallery and schema options
function veel_add_gallery_meta_box() {
  add_meta_box(
    'veel_gallery_meta_box',
    __('Image Gallery and Gallery Schema', 'veelinvestments'),
    'veel_gallery_meta_box_callback',
    array('post', 'projects', 'units'), // Post types where the meta box will be displayed
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'veel_add_gallery_meta_box');

//  Render the meta box in the edit screen
function veel_gallery_meta_box_callback($post) {
  // Add nonce for security
  wp_nonce_field('veel_gallery_nonce_action', 'veel_gallery_nonce');

  // Fetch current image IDs
  $gallery_image_ids = wp_cache_get('_gallery_image_ids_' . $post->ID);
  if ($gallery_image_ids === false) {
    $gallery_image_ids = get_post_meta($post->ID, '_gallery_image_ids', true);
    wp_cache_set('_gallery_image_ids_' . $post->ID, $gallery_image_ids);
  }
  $gallery_image_ids = is_array($gallery_image_ids) ? $gallery_image_ids : array();

  // Fetch gallery and schema enable statuses
  $gallery_enabled = get_post_meta($post->ID, '_gallery_enabled', true);
  $gallery_schema_enabled = get_post_meta($post->ID, '_gallery_schema_enabled', true);

  // Display the fields
  ?>
  <p>
    <label for="gallery_enabled">
      <input type="checkbox" name="gallery_enabled" id="gallery_enabled" value="1" <?php checked($gallery_enabled, '1'); ?> />
      <?php _e('Enable Gallery Display', 'veelinvestments'); ?>
    </label>
  </p>
  <p>
    <label for="gallery_schema_enabled">
      <input type="checkbox" name="gallery_schema_enabled" id="gallery_schema_enabled" value="1" <?php checked($gallery_schema_enabled, '1'); ?> />
      <?php _e('Enable Gallery Schema', 'veelinvestments'); ?>
    </label>
  </p>

  <div id="gallery-wrapper">
    <ul>
      <?php
      foreach ($gallery_image_ids as $attachment_id) {
        $img_url = wp_get_attachment_image_url($attachment_id, 'thumbnail');
        echo '<li data-attachment-id="' . esc_attr($attachment_id) . '"><img src="' . esc_url($img_url) . '" /><button class="remove-image-button">×</button></li>';
      }
      ?>
    </ul>
    <button id="add-gallery-images" class="button"><?php _e('Add Images', 'veelinvestments'); ?></button>
  </div>

  <input type="hidden" name="gallery_image_ids" id="gallery_image_ids" value="<?php echo esc_attr(implode(',', $gallery_image_ids)); ?>" />

  <style>
    #gallery-wrapper ul { list-style: none; margin: 0; padding: 0; overflow: auto; }
    #gallery-wrapper ul li { float: left; margin: 5px; position: relative; }
    #gallery-wrapper ul li img { max-width: 100px; height: auto; display: block; }
    .remove-image-button { position: absolute; top: 2px; right: 2px; background: #9f0303; color: #fff; border: none; border-radius: 8px; cursor: pointer; padding: 2px 5px; }
  </style>

  <script>
    jQuery(document).ready(function($) {
      var frame;
      $('#add-gallery-images').on('click', function(e) {
        e.preventDefault();
        if (frame) {
          frame.open();
          return;
        }
        frame = wp.media({
          title: '<?php _e('Choose Images', 'veelinvestments'); ?>',
          button: {
            text: '<?php _e('Add to Gallery', 'veelinvestments'); ?>'
          },
          multiple: true
        });
        frame.on('select', function() {
          var attachments = frame.state().get('selection').map(function(attachment) {
            attachment = attachment.toJSON();
            return attachment;
          });
          var ids = $('#gallery_image_ids').val() ? $('#gallery_image_ids').val().split(',') : [];
          attachments.forEach(function(attachment) {
            ids.push(attachment.id);
            $('#gallery-wrapper ul').append('<li data-attachment-id="' + attachment.id + '"><img src="' + attachment.sizes.thumbnail.url + '" /><button class="remove-image-button">×</button></li>');
          });
          $('#gallery_image_ids').val(ids.join(','));
        });
        frame.open();
      });

      $('#gallery-wrapper').on('click', '.remove-image-button', function() {
        var li = $(this).closest('li');
        var id = li.data('attachment-id').toString();
        li.remove();
        var ids = $('#gallery_image_ids').val().split(',');
        ids = ids.filter(function(item) {
          return item !== id;
        });
        $('#gallery_image_ids').val(ids.join(','));
      });
    });
  </script>
  <?php
}

//  Save gallery and schema data
function veel_save_gallery_meta_box($post_id) {
  // Verify nonce
  if (!isset($_POST['veel_gallery_nonce']) || !wp_verify_nonce($_POST['veel_gallery_nonce'], 'veel_gallery_nonce_action')) {
    return;
  }

  // Check user capabilities
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Check post type
  if (!in_array(get_post_type($post_id), array('post', 'projects'))) {
    return;
  }

  // Save gallery image IDs
  if (isset($_POST['gallery_image_ids'])) {
    $ids = sanitize_text_field($_POST['gallery_image_ids']);
    $ids_array = array_filter(array_map('intval', explode(',', $ids)));
    update_post_meta($post_id, '_gallery_image_ids', $ids_array);
  } else {
    delete_post_meta($post_id, '_gallery_image_ids');
  }

  // Save gallery and schema status
  $gallery_enabled = isset($_POST['gallery_enabled']) ? '1' : '';
  $gallery_schema_enabled = isset($_POST['gallery_schema_enabled']) ? '1' : '';
  update_post_meta($post_id, '_gallery_enabled', $gallery_enabled);
  update_post_meta($post_id, '_gallery_schema_enabled', $gallery_schema_enabled);
}
add_action('save_post', 'veel_save_gallery_meta_box');

//  Manually display gallery or featured image
function veel_display_gallery_or_featured_image($post_id, $size = 'full') {
  $gallery_enabled = get_post_meta($post_id, '_gallery_enabled', true);
  $gallery_image_ids = get_post_meta($post_id, '_gallery_image_ids', true);

  if ($gallery_enabled === '1' && !empty($gallery_image_ids) && is_array($gallery_image_ids)) {
    $total_images = count($gallery_image_ids);

    if ($total_images > 3) {

      echo '<div class="veel-gallery-grid veel-gallery-grid-more">';
    } else {
      echo '<div class="veel-gallery-grid veel-gallery-grid-thrd">';
    }

    foreach ($gallery_image_ids as $index => $attachment_id) {
      $img_url = wp_get_attachment_image_url($attachment_id, $size);
      $img_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

      if ($index == 0) {

        echo '<div class="grid-item grid-item-large">';
        echo '<img src="' . esc_url($img_url) . '" alt="' . esc_attr($img_alt) . '">';
        echo '</div>';
      } elseif ($index == 1) {
        // الصورة الثانية
        echo '<div class="grid-item grid-item-small-top">';
        echo '<img src="' . esc_url($img_url) . '" alt="' . esc_attr($img_alt) . '">';
        echo '</div>';
      } elseif ($index == 2) {
        // الصورة الثالثة
        echo '<div class="grid-item grid-item-small-bottom">';
        echo '<img src="' . esc_url($img_url) . '" alt="' . esc_attr($img_alt) . '">';
        echo '</div>';
      } elseif ($index == 3) {
        // الصورة الرابعة
        echo '<div class="grid-item grid-item-small-top">';
        echo '<img src="' . esc_url($img_url) . '" alt="' . esc_attr($img_alt) . '">';
        echo '</div>';
      } elseif ($index == 4) {
        // الصورة الخامسة
        echo '<div class="grid-item grid-item-small-bottom">';
        echo '<img src="' . esc_url($img_url) . '" alt="' . esc_attr($img_alt) . '">';
        echo '</div>';
      }
    }

    echo '</div>';
  } else {
    if (has_post_thumbnail($post_id)) {
      $featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
      $image_data = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');

      $featured_image_id = get_post_thumbnail_id($post_id); // جلب معرف الصورة المميزة

      if ($featured_image_id) {
        $featured_image_url = get_the_post_thumbnail_url($post_id, 'full'); // جلب رابط الصورة
        $image_data = wp_get_attachment_image_src($featured_image_id, 'full'); // جلب بيانات الصورة (العرض والارتفاع)
        $image_alt = get_post_meta($featured_image_id, '_wp_attachment_image_alt', true);
        if ($featured_image_url && $image_data) {
          $image_width = $image_data[1];
          $image_height = $image_data[2];

          echo '<div class="veel-gallery-single">';
          echo '<img src="' . esc_url($featured_image_url) . '" alt="' . esc_attr($image_alt) . '" width="' . esc_attr($image_width) . '" height="' . esc_attr($image_height) . '">';
          echo '</div>';
        }
      }

      return;


    }
  }

  return null;
}

//  Output gallery schema
function veel_output_image_gallery_schema() {
  if (is_singular(array('post', 'projects'))) {
    global $post;
    $post_id = $post->ID;
    $gallery_schema_enabled = get_post_meta($post_id, '_gallery_schema_enabled', true);
    $gallery_image_ids = get_post_meta($post_id, '_gallery_image_ids', true);

    if ($gallery_schema_enabled === '1' && !empty($gallery_image_ids) && is_array($gallery_image_ids)) {
      $images = array();

      foreach ($gallery_image_ids as $attachment_id) {
        $attachment = get_post($attachment_id);
        $image_url = wp_get_attachment_image_url($attachment_id, 'full');
        $caption = wp_get_attachment_caption($attachment_id);

        $images[] = array(
          '@type' => 'ImageObject',
          'url' => $image_url,
          'caption' => $caption ? $caption : $attachment->post_title,
        );
      }
      $ld_json = array(
        '@context' => 'https://schema.org',
        '@type' => 'ImageGallery',
        'name' => get_the_title($post_id),
        'url' => get_permalink($post_id),
        'description' => get_the_excerpt($post_id),
        'image' => $images,
      );

      echo '<script type="application/ld+json">' . wp_json_encode($ld_json, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . '</script>';
    }
  }
}
add_action('wp_head', 'veel_output_image_gallery_schema');
