<div class="veelFooterSubscription">
  <div class="subscriptionHeader"><?php _e('Newsletter', 'veelinvestments'); ?></div>
  <form method="post" action="<?php echo esc_url(home_url('/')); ?>" class="subscriptionForm">
    <div class="subscriptionInput">
      <input type="email" name="newsletter_email" placeholder="<?php _e('Your Email Address', 'veelinvestments'); ?>" required>
    </div>
    <div class="subscriptionButton">
      <button type="submit"><?php _e('Subscribe', 'veelinvestments'); ?></button>
    </div>
  </form>
</div>
