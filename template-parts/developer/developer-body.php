<?php
$term = get_queried_object();
$term_id = $term->term_id;

$developer_body = get_term_meta($term_id, 'developer_body', true);

if (!empty($developer_body)) :
  ?>
  <div class="developer-body-content">
    <?php echo wp_kses_post($developer_body); ?>
  </div>
<?php
endif;
?>
