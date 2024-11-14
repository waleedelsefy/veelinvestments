<?php
/**
 * Template Name: main-developer-page
 */

get_header();

get_template_part('template-parts/developerPage/heroDeveloperPage');
get_template_part('template-parts/developerPage/aboutTheDeveloper');
get_template_part('template-parts/homePage/modernProjects');
get_template_part('template-parts/developerPage/developerProjects');
get_template_part('template-parts/developerPage/anotherInfo');
get_template_part('template-parts/homePage/blogs');

get_footer();
?>