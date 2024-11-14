<?php
$types_terms = get_the_terms(get_the_ID(), 'property_type');
$finish_types = get_the_terms(get_the_ID(), 'finish_type');
$city_terms = get_the_terms(get_the_ID(), 'city');
$project_details = get_post_meta(get_the_ID(), 'project_details', true);
$unit_price = get_post_meta(get_the_ID(), 'unit_price', true);
$project_location = $project_details['project_location'] ?? '';
$unit_space = $project_details['unit_space'] ?? '';

$types_name = '';
$finish_types_name = '';
$types_link = '';
$finish_types_link = '';

// Check for types terms
if ($types_terms && !is_wp_error($types_terms)) {
  $types_name = esc_html($types_terms[0]->name);
  $types_link = get_term_link($types_terms[0]);
}

// Check for finish types
if ($finish_types && !is_wp_error($finish_types)) {
  $finish_types_name = esc_html($finish_types[0]->name);
  $finish_types_link = get_term_link($finish_types[0]);
}
?>

<div class="veelBlogHeaderTitle">
  <h2><?php _e('Project details', 'veelinvestments'); ?></h2>
</div>

<div class="project-details-grid">
  <div class="project-details-grid-item-title"><?php _e('Project Name', 'veelinvestments'); ?></div>
  <div class="project-details-grid-item-value"><?php echo esc_html(secondary_title(get_the_ID())); ?></div>

  <?php if (!empty($project_location)) : ?>
    <div class="project-details-grid-item-title"><?php _e('Project Location', 'veelinvestments'); ?></div>
    <div class="project-details-grid-item-value"><?php echo esc_html($project_location); ?></div>
  <?php endif; ?>

  <?php if (!empty($unit_space)) : ?>
    <div class="project-details-grid-item-title"><?php _e('Unit Space', 'veelinvestments'); ?></div>
    <div class="project-details-grid-item-value"><?php echo esc_html($unit_space) .' ' . __('Meter', 'veelinvestments'); ?></div>

    <?php if (!empty($unit_price) && is_numeric($unit_price) && is_numeric($unit_space) && $unit_space > 0) : ?>
      <div class="project-details-grid-item-title"><?php _e('Starting Price', 'veelinvestments'); ?></div>
      <div class="project-details-grid-item-value">
        <?php
        echo esc_html(round(floatval($unit_price) / floatval($unit_space))) . ' ';
        _e('EGP', 'veelinvestments');
        echo ' / ';
        _e('Meter', 'veelinvestments');
        ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>

  <?php if (!empty($types_name)) : ?>
    <div class="project-details-grid-item-title"><?php _e('Unit Types', 'veelinvestments'); ?></div>
    <div class="project-details-grid-item-value"><?php echo esc_html($types_name); ?></div>

    <?php if (!empty($finish_types_name)) : ?>
      <div class="project-details-grid-item-title"><?php _e('Finish Type', 'veelinvestments'); ?></div>
      <div class="project-details-grid-item-value"><?php echo esc_html($finish_types_name); ?></div>
    <?php endif; ?>
  <?php endif; ?>
</div>
