<?php
/**
 * Template Name: main-projects-page
 */
get_header();

get_template_part('template-parts/projects/heroProjectsPage');
get_template_part('template-parts/projects/displayProjectsPhotosAndDetails');
get_template_part('template-parts/homePage/needHelp');
get_template_part('template-parts/projects/relatedProjects');
get_template_part('template-parts/homePage/blogs');

get_footer();
?>