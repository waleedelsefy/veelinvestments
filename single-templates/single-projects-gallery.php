<?php
/*
Template Name: single projects with gallery
Template Post Type: projects
*/

$post_id = get_the_ID();
get_header();
?>


<?php get_template_part('template-parts/projects/project-post-header'); ?>

<div class="project-body">
  <?php
  echo veel_display_gallery_or_featured_image($post_id, 'full');
  echo display_project_main_location();
  ?>
  <div class="flex-row">
    <div class="col-8">
      <div class="project-details-card">
        <?php get_template_part('template-parts/projects/project-details-card'); ?>
      </div>
      <div class="project-details">
        <?php get_template_part('template-parts/projects/project-details'); ?>
      </div>
      <div>
        <?php get_template_part('template-parts/projects/payment-systems'); ?>
      </div>
      <div>
        <?php get_template_part('template-parts/projects/project-facilities'); ?>
      </div>
      <div class="veelBlogHeaderTitle">
        <h2><?php _e('Additional Information', 'veelinvestments'); ?></h2>
      </div>
      <div class="content-body">
        <?php the_content(); ?>
      </div>
      <?php get_template_part('template-parts/projects/author-card'); ?>
    </div>
    <div class="sidebarAria col-4">
      <div class="sidebar">
        <?php get_template_part('template-parts/projects/price-container'); ?>
        <?php get_template_part('template-parts/projects/schedule-meeting'); ?>
      </div>
    </div>
  </div>
</div>

<?php
// Include additional template parts for the footer sections
get_template_part('template-parts/help-form');
get_template_part('template-parts/projects/related-projects');
get_template_part('template-parts/home-page/blog');
get_footer();
?>

<!-- Integrated CSS -->
<style>
  /* Reset box-sizing for all elements */
  *, *::before, *::after {
    box-sizing: border-box;
  }

  /* Flex Row Setup */
  .flex-row {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    overflow: visible; /* Prevent clipping of sticky sidebar */
    height: auto; /* Ensure no fixed height restricts sticky behavior */
  }

  /* Column Widths */
  .col-8 {
    width: 80%;
    padding: 20px;
    overflow: visible;
    height: auto;
  }

  .col-4 {
    width: 33.33%;
    padding: 20px;
    overflow: visible;
    height: auto;
  }

  /* Sidebar Styling with Sticky Positioning */
  .sidebarAria .sidebar {
    position: -webkit-sticky; /* For Safari */
    position: sticky;
    top: 20px; /* Distance from the top when sticky */
    z-index: 100; /* Ensures sidebar stays above other elements */
    max-height: calc(100vh - 40px); /* Prevents sidebar from exceeding viewport height */
    overflow-y: auto; /* Adds scrollbar if content exceeds max-height */
    padding: 0;

    border-radius: 8px;
    width: 100%;
    max-width: 350px;
    box-sizing: border-box; /* Set to border-box */
  }

  /* Ensure Parent Containers Do Not Restrict Sticky Behavior */
  .sidebarAria {
    overflow: visible; /* Prevent clipping */
    height: auto; /* Ensure no fixed height */
    padding: 0;
  }

  /* Responsive Adjustments */

  /* Screens <= 768px */
  @media screen and (max-width: 768px) {
    .flex-row {
      flex-direction: column;
    }

    .col-8, .col-4 {
      width: 100%;
      padding: 10px;
    }

    .sidebarAria .sidebar {
      position: relative; /* Disable sticky on smaller screens */
      top: auto;
      max-height: none;
      overflow-y: visible;
      width: 100%;
      max-width: 300px;
    }
  }

  /* Screens <= 430px */
  @media screen and (max-width: 430px) {
    .veelSocialAndArrow {
      bottom: 4% !important;
    }

    .HeroForm.HeroForm {
      width: 80%;
    }

    .HeroParagraph {
      color: #fff;
      font-size: 18px;
      font-style: normal;
      font-weight: 700;
      letter-spacing: 0.5px;
      line-height: 35px;
      text-align: center;
    }

    .veelContent {
      width: 90% !important;
      margin: auto;
    }

    .veelSocialAndArrow {
      bottom: 3% !important;
    }

    .HeroForm form {
      width: 90% !important;
    }

    .HeroForm.HeroForm {
      width: 95% !important;
    }

    .heroH1 {
      font-size: 28px;
      margin-top: 0;
      text-align: center;
    }
  }

  /* Screens <= 375px */
  @media screen and (max-width: 375px) {
    .veelContent {
      height: 640px;
      margin: auto;
      width: 90% !important;
    }

    .veelSocialAndArrow {
      bottom: 3% !important;
    }

    .HeroForm form {
      width: 90% !important;
    }

    .HeroForm.HeroForm {
      width: 95% !important;
    }

    .heroH1 {
      font-size: 28px;
      margin-top: 0;
      text-align: center;
    }
  }

  /* Project Body */
  .project-body {
    width: 90% !important;
    margin: auto;
    display: block;
    padding: 0;
    max-width: 90%;
    margin-bottom: 30px;
    /* box-shadow: rgb(0 0 0 / 24%) 0 0 10px 1px; */
    border-radius: 15px;
  }

  /* Content Body */
  .content-body {
    width: 100%;
  }

  .content-body p {
    color: #707070;
    text-align: right;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 22px;
  }

  .content-body ul {
    display: flex;
    list-style-type: disc;
    gap: 8px;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 9px;
    margin-inline-end: 9px;
    padding-inline-start: 50px;
    unicode-bidi: isolate;
    flex-direction: column;
  }

  .content-body li {
    line-height: 22px;
  }

  .content-body table {
    display: table;
    border-collapse: separate;
    box-sizing: border-box;
    text-indent: initial;
    unicode-bidi: isolate;
    border-spacing: 2px;
    border-color: #cfb771;
  }

  .content-body td {
    border: solid 1px black;
    padding: 10px;
    margin: 0;
  }

  /* Project Facilities */
  .project-facilities {
    display: flex;
    width: 100%;
    height: fit-content;
    justify-content: center;
    align-items: center;
    flex-shrink: 0;
    flex-wrap: wrap;
    gap: 21px;
    grid-template-columns: repeat(4, 1fr);
    justify-items: start;
    padding: 25px;
  }

  .facility-box {
    gap: 8px;
    display: inline-flex;
    height: 33px;
    padding: 8px 11px 8px 20px;
    justify-content: flex-end;
    align-items: center;
    flex-shrink: 0;
    border-radius: 16px;
    border: 1px solid var(--primary--color);
  }

  /* Payment Systems Blocks */
  .PaymentSystemsBlocks {
    gap: 14px;
    margin-inline-start: 5%;
    margin-top: 20px;
    margin-bottom: 20px;
  }

  .PaymentSystemsBlock {
    width: 112px;
    height: 118px;
    display: flex;
    gap: 8px;
    flex-shrink: 0;
    border-radius: 15px;
    border: 1px solid #000;
    background: #FDFCFB;
    flex-direction: column;
    align-content: center;
    align-items: center;
    justify-content: center;
  }

  .installment-percent {
    font-weight: 800;
  }

  /* Gallery Single */
  .veel-gallery-single, .veel-gallery-single img {
    width: 895px;
    height: 600px;
    background: linear-gradient(0deg, #D9D9D9 0%, #D9D9D9 100%);
    border-radius: 15px;
  }

  /* Project Main Location */
  .project-main-location {
    display: flex;
    height: 20px;
    align-items: center;
    margin: 20px 5px;
    gap: 20px;
  }

  .col-main-location-write, .col-main-location-time {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #20201E;
    text-align: right;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
  }

  /* Project Post Top Header */
  .project-post-top-header {
    width: 100vw;
    height: 200px;
    overflow: auto;
    margin-bottom: 28px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-content: flex-start;
  }

  /* Breadcrumbs */
  ul.breadcrumb-item.list {
    display: flex;
    gap: 10px;
    color: #fff;
    list-style: none;
  }

  li .breadcrumb-item {
    color: #FFFFFF;
    text-decoration-line: none;
  }

  /* Post Title */
  h1.post-title {
    color: #FFF;
    text-align: right;
    font-size: 24px;
    font-style: normal;
    font-weight: 700;
    line-height: 32px;
    width: fit-content;
    height: fit-content;
    flex-shrink: 0;
    background: #D1B671;
    margin-inline-start: 5vw;
    padding-inline: 20px;
  }

  /* List Item Class */
  li.cil {
    display: flex;
    flex-direction: row;
    align-content: center;
    align-items: center;
    gap: 10px;
  }

  /* Gallery Grid */
  .veel-gallery-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    margin: auto;
    margin-top: 20px;
    justify-content: center;
  }

  .veel-gallery-grid-more {
    grid-template-columns: 40% 30% 30%;
    max-width: 85%;
  }

  .veel-gallery-grid-thrd {
    grid-template-columns: 55% 35%;
    max-width: 100%;
  }

  .grid-item {
    position: relative;
  }

  .grid-item img {
    border-radius: 15px !important;
  }

  .grid-item-large {
    grid-row: span 2;
    height: 410px;
  }

  .grid-item-small-top,
  .grid-item-small-bottom {
    height: 200px;
  }

  .grid-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: var(--all-border-radius);
  }

  /* Schedule Meeting Day */
  li.schedule-meeting-day {
    display: flex;
    width: 90px;
    height: 70px;
    padding: 10px 12px;
    justify-content: center;
    align-items: flex-start;
    gap: 273px;
    flex-shrink: 0;
  }

  select#fav-time {
    text-align: right;
  }

  /* Schedule Meeting */
  .schedule-meeting {
    margin: 10px 0;
    width: 96%;
    color: #FFF;
    text-align: right;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 21px;
    border-radius: 12px;
    background: #231F20;
    padding: 10px 25px;
  }

  .schedule-meeting form {
    display: flex;
    flex-wrap: wrap;
    padding: 10px;
    justify-content: space-between;
  }

  .schedule-meeting .form-inside-title {
    font-weight: bold;
    font-size: 0.9rem;
    margin-bottom: 5px;
    padding-right: 5px;
  }

  .schedule-meeting .input-box {
    width: 98%;
    margin: 0 1%;
  }

  .schedule-meeting .input-box label {
    font-size: 0.9rem;
    margin-bottom: 5px;
    font-weight: bold;
  }

  .schedule-meeting .form-bg,
  .schedule-meeting .comment {
    width: 100%;
    padding-right: 15px;
    height: 40px;
    line-height: 38px;
    color: #233F5A;
    display: block;
    font-size: 0.85rem;
    margin-bottom: 15px;
    border: 1px solid #C0C0C0;
    font-weight: bold;
    background-color: #FFFFFF;
    border-radius: 10px;
  }

  .schedule-meeting .comment {
    height: 100px;
  }

  .schedule-meeting .search-select {
    appearance: none;
    -moz-appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml;utf8,<svg fill='gray' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
    background-position: 2%;
    background-repeat: no-repeat;
    color: rgba(35,63,90,0.7);
  }

  .schedule-meeting .form-bg::placeholder,
  .schedule-meeting .comment::placeholder {
    opacity: 0.5;
  }

  .schedule-meeting .submit {
    display: flex;
    width: 100%;
    height: 42px;
    padding: 12px;
    justify-content: center;
    align-items: center;
    gap: 10px;
    color: #FFFFFF;
    flex-shrink: 0;
    border-radius: 5px;
    background: #D1B671;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .schedule-meeting .submit:hover {
    background-color: #B3CB63;
  }

  /* Radio Button Styles */
  .schedule-meeting .radio-box {
    display: flex;
    overflow-x: auto;
    width: 100%;
    list-style-type: none;
    padding-right: 0;
    margin-bottom: 15px;
  }

  .schedule-meeting .radio-box [type="radio"] {
    display: none;
  }

  .schedule-meeting .radio-box label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: center;
    padding: 5px 10px;
    width: 100%;
    background-color: #F9F9F9;
    color: #70777E;
    font-size: 0.9rem;
    border-radius: 10px;
    cursor: pointer;
    border: 2px solid #DADADA;
    transition: 0.2s;
  }

  .schedule-meeting .radio-box label:hover,
  .schedule-meeting .radio-box input:checked ~ label {
    background-color: #EDF5F6;
    border-color: #00B0C4;
    color: #00B0C4;
  }

  /* Sidebar Default Styles */
  .sidebar {
    position: relative;
    width: 80%;
    max-width: 350px;
  }

  /* Sidebar Fixed Class (Unused in CSS-Only Approach) */
  /* Remove or comment out if not using JavaScript to toggle 'fixed' class */
  /*
  .sidebar.fixed {
    position: fixed;
    top: 65px;
    z-index: 1000;
  }
  */

  /* Responsive Adjustments for Sidebar */
  @media screen and (max-width: 1024px){
    .project-body {
      border-radius: 15px;
      display: block;
      margin: auto auto 30px;
      max-width: 100%;
      padding: 0;
      width: 98% !important;
    }
    .sidebar {
      position: relative;
      width: 80%;
      max-width: 300px;
    }
  }
  @media screen and (min-width: 767px) {
    .col-8 {
      width: 100% !important;
    }
  }

  @media screen and (max-width: 430px){
    .PaymentSystemsBlock {
      width: 95px;
      height: 100px;
      display: flex;
      gap: 8px;
      flex-shrink: 0;
      border-radius: 15px;
      border: 1px solid #000;
      background: #FDFCFB;
      flex-direction: column;
      align-content: center;
      align-items: center;
      justify-content: center;
    }
    .content-body {
      width: 95%;
      margin: auto;
    }
    .content-body ul {
      display: flex;
      list-style-type: disc;
      gap: 8px;
      margin-block-start: 5px;
      margin-block-end: 5px;
      margin-inline-start: 0;
      margin-inline-end: 9px;
      padding-inline-start: 15px;
      unicode-bidi: isolate;
      flex-direction: column;
    }
    h1.post-title {
      color: #FFF;
      text-align: right;
      font-size: 16px;
      font-style: normal;
      font-weight: 700;
      line-height: 32px;
      width: fit-content;
      height: fit-content;
      flex-shrink: 0;
      background: #D1B671;
      margin-inline-start: 5vw;
      padding-inline: 20px;
    }
  }

</style>