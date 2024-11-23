<?php
/**
 * إضافة مربع ميتا لنموذج ثلاثي الأبعاد
 */
function add_3d_model_meta_box() {
  add_meta_box(
    '3d_model_meta_box', // معرف المربع
    __('3D Model', 'veelinvestments'), // عنوان المربع
    'render_3d_model_meta_box', // دالة العرض
    'projects', // نوع المنشور
    'normal', // مكان العرض
    'high' // الأولوية
  );
}
add_action('add_meta_boxes', 'add_3d_model_meta_box');

/**
 * دالة عرض مربع الميتا لنموذج ثلاثي الأبعاد
 */
function render_3d_model_meta_box($post) {
  // إضافة نونس للحماية
  wp_nonce_field('save_3d_model_meta_data', '3d_model_meta_box_nonce');

  // الحصول على قيمة iframe المحفوظة (إذا كانت موجودة)
  $model_3d_iframe = get_post_meta($post->ID, 'model_3d_iframe', true);

  // عرض حقل الإدخال
  echo '<label for="model_3d_iframe">' . __('Enter the iframe code for the 3D model:', 'veelinvestments') . '</label>';
  echo '<textarea id="model_3d_iframe" name="model_3d_iframe" rows="5" style="width:100%;">' . esc_textarea($model_3d_iframe) . '</textarea>';
}

/**
 * حفظ بيانات مربع الميتا لنموذج ثلاثي الأبعاد
 */
function save_3d_model_meta_data($post_id) {
  // التحقق من وجود النونس وصلاحيته
  if (!isset($_POST['3d_model_meta_box_nonce']) || !wp_verify_nonce($_POST['3d_model_meta_box_nonce'], 'save_3d_model_meta_data')) {
    return;
  }

  // منع الحفظ التلقائي من الكتابة فوق البيانات
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // التحقق من صلاحيات المستخدم
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // التحقق من وجود البيانات
  if (isset($_POST['model_3d_iframe'])) {
    // السماح بعلامات iframe فقط لأمان
    $allowed_tags = array(
      'iframe' => array(
        'src' => array(),
        'width' => array(),
        'height' => array(),
        'frameborder' => array(),
        'allow' => array(),
        'allowfullscreen' => array(),
      ),
    );

    // تنظيف البيانات والسماح بالعلامات المسموح بها فقط
    $sanitized_iframe = wp_kses($_POST['model_3d_iframe'], $allowed_tags);

    // حفظ البيانات
    update_post_meta($post_id, 'model_3d_iframe', $sanitized_iframe);
  } else {
    // حذف البيانات إذا كانت القيمة فارغة
    delete_post_meta($post_id, 'model_3d_iframe');
  }
}
add_action('save_post_projects', 'save_3d_model_meta_data');
