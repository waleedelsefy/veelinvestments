<div class="cityCompoundsSection">
  <div class="cityCompoundsSection">
    <div class="cityCompoundsHeader">
      <div class="cityCompoundsRectangle"></div>
      <div class="veelLatestProjectsHeaderTitle">
        <h2><?php echo __('Compounds in ', 'veelinvestments') . single_term_title('', false); ?></h2>
      </div>
    </div>

    <div class="compoundsSubHeading">
      <p><?php _e('Explore a selection of premium properties at the best prices', 'veelinvestments'); ?></p>
    </div>
  </div>

  <div class="compoundsBoxes">
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $term = get_queried_object();
    $args = array(
      'post_type' => 'projects',
      'posts_per_page' => 12,
      'paged' => $paged,
      'tax_query' => array(
        array(
          'taxonomy' => $term->taxonomy,
          'field' => 'term_id',
          'terms' => $term->term_id,
        ),
      ),
    );
    $city_projects = new WP_Query($args);

    if ($city_projects->have_posts()) :
      while ($city_projects->have_posts()) : $city_projects->the_post();
        ?>
        <div class="compoundsBoxesSingle">
          <?php
          get_template_part('template-parts/content', 'related-card'); ?>
        </div>
      <?php
      endwhile;
      wp_reset_postdata();
    else :
      echo '<p>' . __('No compounds available in this city at the moment.', 'veelinvestments') . '</p>';
    endif;
    ?>
  </div>

  <ul class="pagination">
    <?php
    echo paginate_links(array(
      'total' => $city_projects->max_num_pages,
      'current' => $paged,
      'prev_text' => __('← Previous', 'veelinvestments'),
      'next_text' => __('Next →', 'veelinvestments'),
    ));
    ?>
  </ul>
</div>

<style>
  .compoundsBoxes {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    justify-content: center;
    align-items: center;
  }
  .compoundsBoxesSingle {
    max-width: 255px;
    min-width: 255px;
    width: 255px;
  }
  @media screen and (max-width: 425px) {
    .compoundsBoxesSingle {
      max-width: 75%;
      width: 75%;
    }
  }
</style>
