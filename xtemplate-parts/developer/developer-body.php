<?php
$term = get_queried_object();
$term_id = $term->term_id;

$developer_body = get_term_meta($term_id, 'developer_body', true);

if (!empty($developer_body)) :
  ?>
<style>
  .developer-body-content {
  color: #707070;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
    line-height: 22px;
    h2 {
    color: #000;
    font-family: Almarai;
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px; /* 175% */
   }
   }
</style>
  <div class="developer-body-content">
    <?php echo wp_kses_post($developer_body); ?>
  </div>
<?php
endif;
?>
