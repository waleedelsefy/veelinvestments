<?php
/**
 * Template Name: developer
 */
get_header();

get_template_part('template-parts/developer/developer-header');

?>
<style>
  .veelLatestDeveloperHeader {
    align-items: flex-start;
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    width: 70%;
  }

  .developer-help-form {
    width: 35%;
  }
  .DeveloperTaxonomyHeader {
    width: 100%;
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin: auto;
  }
  @media screen and (max-width: 768px){
    .developer-help-form {
      display: none;
    }
    .DeveloperTaxonomyHeader {
      width: 100%;
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin: auto;
    }
    .veelLatestDeveloperHeader {
      align-items: flex-start;
      display: flex;
      justify-content: space-between;
      flex-direction: column;
      width: 100%;
      padding: 10px;
    }

  }
  @media screen and (max-width: 430px){
    .developer-help-form {
      display: block;
    }

    .veelLatestDeveloperHeader {
      align-items: flex-start;
      display: flex;
      justify-content: space-between;
      flex-direction: column;
      width: 100%;
      padding: 10px;
    }
    .developer-help-form {
      width: 100%;
    }
    .DeveloperTaxonomyHeader {
      width: 100%;
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin: auto;
      flex-direction: column;
    }
  }
</style>
  <div class="project-body">

<?php
get_template_part('template-parts/developer/about-developer');
get_template_part('template-parts/developer/new-developer');

get_template_part('template-parts/developer/developer-compunds');

?>
    <div class="DeveloperTaxonomyHeader">
      <div class="veelLatestDeveloperHeader">
        <div class="veelLatestProjectsHeaderTitle">
          <h2>أحدث المشاريع</h2>
        </div>
        <div >
          <?php
          get_template_part('template-parts/developer/developer-body');

          ?>
        </div>

      </div>
    <div class="developer-help-form">
      <?php
      get_template_part('template-parts/developer/developer-help-form');

      ?>
    </div>
    </div>
</div>
  <?php
get_template_part('template-parts/home-page/blog');

get_footer();

