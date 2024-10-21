
<?php
// Process the form submission
function veelinvestments_process_contact_form() {
  if (isset($_POST['name'], $_POST['phone'], $_POST['message'], $_POST['property_type'])) {
    $name = sanitize_text_field($_POST['name']);
    $phone = sanitize_text_field($_POST['phone']);
    $message = sanitize_textarea_field($_POST['message']);
    $property_type = sanitize_text_field($_POST['property_type']);

    // Handle the form submission (e.g., send email, save to DB, etc.)
    // wp_mail(...); // Use this function to send an email if needed.

    wp_redirect(home_url('/thank-you')); // Redirect to a thank you page or confirmation
    exit;
  }
}
add_action('admin_post_nopriv_submit_contact_form', 'veelinvestments_process_contact_form');
add_action('admin_post_submit_contact_form', 'veelinvestments_process_contact_form');
?>
