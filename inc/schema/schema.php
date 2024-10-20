<?php
function veel_add_schema_meta_box() {
    add_meta_box(
        'veel_schema_meta_box',
        __('Schema Options', 'veelinvestments'),
        'veel_schema_meta_box_callback',
        array('post', 'projects', 'units'),
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'veel_add_schema_meta_box');

function veel_schema_meta_box_callback($post) {
    wp_nonce_field('veel_schema_nonce_action', 'veel_schema_nonce');

    $product_schema_enabled = get_post_meta($post->ID, '_product_schema_enabled', true);
    $faq_schema_enabled = get_post_meta($post->ID, '_faq_schema_enabled', true);
    $breadcrumb_schema_enabled = get_post_meta($post->ID, '_breadcrumb_schema_enabled', true);
    $author_schema_enabled = get_post_meta($post->ID, '_author_schema_enabled', true);
    $show_units_enabled = get_post_meta($post->ID, '_show_units_enabled', true);

    ?>
    <p>
        <label for="product_schema_enabled">
            <input type="checkbox" name="product_schema_enabled" id="product_schema_enabled" value="1" <?php checked($product_schema_enabled, '1'); ?> />
            <?php _e('Enable Product Schema', 'veelinvestments'); ?>
        </label>
    </p>
    <p>
        <label for="faq_schema_enabled">
            <input type="checkbox" name="faq_schema_enabled" id="faq_schema_enabled" value="1" <?php checked($faq_schema_enabled, '1'); ?> />
            <?php _e('Enable FAQ Schema', 'veelinvestments'); ?>
        </label>
    </p>
    <p>
        <label for="breadcrumb_schema_enabled">
            <input type="checkbox" name="breadcrumb_schema_enabled" id="breadcrumb_schema_enabled" value="1" <?php checked($breadcrumb_schema_enabled, '1'); ?> />
            <?php _e('Enable Breadcrumb Schema', 'veelinvestments'); ?>
        </label>
    </p>
    <p>
        <label for="author_schema_enabled">
            <input type="checkbox" name="author_schema_enabled" id="author_schema_enabled" value="1" <?php checked($author_schema_enabled, '1'); ?> />
            <?php _e('Enable Author Schema', 'veelinvestments'); ?>
        </label>
    </p>
    <p>
       <!-- <label for="show_units_enabled">
            <input type="checkbox" name="show_units_enabled" id="show_units_enabled" value="1" <?php /*checked($show_units_enabled, '1'); */?> />
            <?php /*_e('Show Units for this Project', 'veelinvestments'); */?>
        </label>-->
    </p>
    <?php
}

function veel_save_schema_meta_box($post_id) {
    if (!isset($_POST['veel_schema_nonce'])) {
        return $post_id;
    }
    $nonce = $_POST['veel_schema_nonce'];
    if (!wp_verify_nonce($nonce, 'veel_schema_nonce_action')) {
        return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }
    $fields = [
        'product_schema_enabled',
        'faq_schema_enabled',
        'breadcrumb_schema_enabled',
        'author_schema_enabled',
/*        'show_units_enabled'*/
    ];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, '1');
        } else {
            delete_post_meta($post_id, '_' . $field);
        }
    }
}
add_action('save_post', 'veel_save_schema_meta_box');

function get_best_answer($faqs) {
    return $faqs[0]['answer'];
}

function get_upvote_count($answer) {
    return rand(50, 1000);
}
?>
