<?php
/**
 * Template Name: home-page
 */
get_header();

get_template_part('template-parts/homePage/hero');
get_template_part('template-parts/global/whatsappAndPhoneIcons');
get_template_part('template-parts/homePage/modernProjects');
get_template_part('template-parts/homePage/topCities');
get_template_part('template-parts/homePage/needHelp');
get_template_part('template-parts/homePage/developers');
get_template_part('template-parts/homePage/blogs');
get_template_part('template-parts/homePage/feedback');

get_footer();
?>