<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  wp_head();
  $theme_settings = get_option('veel_theme_settings');
  $phone_number = esc_attr($theme_settings['phone_number'] ?? '');
  ?>
</head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
<body <?php body_class(); ?>>
<header>
<?php get_template_part('template-parts/global/navbar'); ?>
</header>
<style>
  *, *::before, *::after {
    box-sizing: border-box;
  }
 * {
   outline: 1px solid red;
  }
  html {
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* Internet Explorer و Edge */
  }

  *::-webkit-scrollbar {
    display: none !important; /* Chrome, Safari and Opera */
  }
</style>
