<?php
function display_real_estate_advisor_card($atts = []) {
    $atts = shortcode_atts( array(
        'post_id' => get_the_ID(),
    ), $atts, 'advisor_card' );
    $post_id = $atts['post_id'];
    $reviewer_id = get_post_meta($post_id, '_expert_reviewer_id', true);
    if ($reviewer_id) {
        $review_content = get_post_meta($post_id, '_expert_review_content', true);
        $review_rating = get_post_meta($post_id, '_expert_review_rating', true);

        $reviewer = get_userdata($reviewer_id);

        if ($reviewer) {
            $reviewer_name = $reviewer->display_name;
            $reviewer_description = get_user_meta($reviewer_id, 'description', true);
            $reviewer_photo = get_avatar_url($reviewer_id, ['size' => '150']);
            $reviewer_phone = get_user_meta($reviewer_id, 'phone_number', true);

            if (!$reviewer_phone) {
                $reviewer_phone = '+201025717671';
            }

            ob_start();
            ?>
            <div class="advisor-profile">
            <div class="advisor-contacts">

            <div class="advisor-first-col">
                    <img class="advisor-photo" src="<?php echo esc_url($reviewer_photo); ?>" alt="<?php echo esc_attr($reviewer_name); ?>">
                </div>
            <div class="advisor-sac-col">

            <div class="advisor-name"><?php echo esc_html($reviewer_name); ?></div>
                <div class="advisor-desc"><?php _e('Contact our real estate advisor', 'veelinvestments'); ?></div>
            </div>
            </div>
                <div class="advisor-contact">
                    <a href="tel:<?php echo esc_attr($reviewer_phone); ?>" class="advisor-button"><?php _e('Call Now', 'veelinvestments'); ?></a>
                </div>
            </div>
            <?php
            return ob_get_clean();
        } else {
            return '<div class="advisor-no-contact"></div>';
        }
    } else {
        return '<div class="advisor-no-contact"></div>';
    }
}

add_shortcode('advisor_card', 'display_real_estate_advisor_card');
