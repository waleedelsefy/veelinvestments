<?php
$project_details = get_post_meta(get_the_ID(), 'project_details', true);

if (!empty($project_details)) {
  $installments = [];

  for ($i = 1; $i <= 3; $i++) {
    $percent_key = 'installment_' . $i;
    $years_key = 'installment_' . $i . '_years';

    if (!empty($project_details[$percent_key])) {
      $installments[] = [
        'percent' => esc_attr($project_details[$percent_key]),
        'years' => !empty($project_details[$years_key]) ? esc_attr($project_details[$years_key]) : '',
      ];
    }
  }

  if (!empty($installments)) {
    ?>
    <div class="PaymentSystems">
      <div class="">
        <h3><?php _e('Payment Systems', 'veelinvestments'); ?></h3>
      </div>
      <div class="PaymentSystemsBlocks">
        <?php foreach ($installments as $installment) { ?>
          <div class="PaymentSystemsBlock">
            <div class="installment-percent">
              <?php echo esc_html($installment['percent']) . '% '; ?>
            </div>
            <div><?php echo esc_html__('Down Payment', 'veelinvestments'); ?></div>
            <?php if (!empty($installment['years'])) : ?>
              <div><?php echo esc_html($installment['years'] . ' ' . __('years', 'veelinvestments')); ?></div>
            <?php endif; ?>
          </div>
        <?php } ?>
      </div>
    </div>
    <?php
  }
}
?>
