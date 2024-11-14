<div class="contactForm">
  <div class="contactFormImg col-4 desktopOnly tabletOnly">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/src/img/formimg.svg'); ?>" alt="<?php esc_attr_e('Contact Form Image', 'veelinvestments'); ?>">
  </div>

  <div class="flex-column contactFormBox col-8 contactFormGap">
    <div class="flex-column contactFormHeading">
      <h2><?php _e('Need Real Estate Help?', 'veelinvestments'); ?></h2>
      <p><?php _e('Fill in your details, and a real estate expert will contact you shortly.', 'veelinvestments'); ?></p>
    </div>

    <div class="contactFormBoxInputs contactFormGap">
      <form class="flex-row contactFormGap" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
        <div class="flex-column contactFormGap">
          <input type="text" placeholder="<?php esc_attr_e('Name', 'veelinvestments'); ?>" id="name" name="name" required>

          <select class="dropdown"  id="options" name="options" required>
            <option value=""><?php _e('Preferred Location', 'veelinvestments'); ?></option>
            <?php
            $property_types = get_terms(array('taxonomy' => 'city', 'hide_empty' => false));
            if (!empty($property_types)) {
              foreach ($property_types as $type) {
                echo '<option value="' . esc_attr($type->slug) . '">' . esc_html($type->name) . '</option>';
              }
            }
            ?>
          </select>

          <input type="tel" placeholder="<?php esc_attr_e('Phone Number', 'veelinvestments'); ?>" id="phone" name="phone" required>
        </div>

        <div class="flex-column contactFormGap">
          <textarea placeholder="<?php esc_attr_e('Your Message', 'veelinvestments'); ?>" id="message" name="message" rows="4" required></textarea>

          <input type="hidden" name="action" value="submit_contact_form">
          <button class="submitButton" type="submit"><?php _e('Submit', 'veelinvestments'); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
