<?php
    $project_details = get_post_meta(get_the_ID(), 'project_details', true);
    if (!empty($project_details)) {
      $installment_1 = !empty($project_details['installment_1']) ? esc_attr($project_details['installment_1']) : '';
      $installment_2 = !empty($project_details['installment_2']) ? esc_attr($project_details['installment_2']) : '';
      $installment_3 = !empty($project_details['installment_3']) ? esc_attr($project_details['installment_3']) : '';
      if (!empty($installment_1) || !empty($installment_2) || !empty($installment_3)) {
        if (!empty($installment_1)) { ?>
    <div class="PaymentSystems">
      <div class="">
        <h3><?php _e('Payment Systems', 'veelinvestments'); ?></h3>
      </div>
      <div class="PaymentSystemsBlocks flex-row">
      <div class="PaymentSystemsBlock">
            <div class="installment-percent">
              <?php echo esc_attr($installment_1) . '% '; ?>
            </div>
            <div><?php echo esc_html__('Down Payment', 'veelinvestments'); ?></div>
            <div><?php echo esc_html__('7 years', 'veelinvestments'); ?></div>
          </div>
        <?php }

        if (!empty($installment_2)) { ?>
          <div class="PaymentSystemsBlock">
            <div class="installment-percent">
              <?php echo esc_attr($installment_2) . '% '; ?>
            </div>
            <div><?php echo esc_html__('Down Payment', 'veelinvestments'); ?></div>
            <div><?php echo esc_html__('5 years', 'veelinvestments'); ?></div>
          </div>
        <?php }
        if (!empty($installment_3)) { ?>
          <div class="PaymentSystemsBlock">
            <div class="installment-percent">
              <?php echo esc_attr($installment_3) . '% '; ?>
            </div>
            <div><?php echo esc_html__('Down Payment', 'veelinvestments'); ?></div>
            <div><?php echo esc_html__('3 years', 'veelinvestments'); ?></div>
          </div>

  </div>
</div>
        <?php }
      }
    }
?>
