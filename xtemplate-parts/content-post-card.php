<div class="ProjectCard">
  <a  href="<?php echo get_permalink(get_the_ID()); ?>" class="imgProjectCard" style="background-image: url('<?php if (has_post_thumbnail()) : echo get_the_post_thumbnail_url(get_the_ID(), 'full'); endif; ?>');">

  </a>
  <div class="ProjectCardContent">
    <a class="ProjectCardTitle" href="<?php echo get_permalink(get_the_ID()); ?>"><?php secondary_title(); ?></a>
    <?php
    $terms = wp_get_post_terms(get_the_ID(), 'developer');
    if (!empty($terms) && !is_wp_error($terms)) {
      $developer_link = get_term_link($terms[0]->term_id, 'developer');
      echo '<a class="ProjectCardDeveloper" href="' . esc_url($developer_link) . '">' . esc_html($terms[0]->name) . '</a>';
    }
    ?>
  </div>
</div>

<style>

  .ProjectCardTitle , .realPrice, .ProjectCardDeveloper {
    text-decoration: none !important;
    color: #231F20 !important;
  }
  .ProjectCardContent {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 250px;
    height: 125px;
  }

  .ProjectCardCta { }

  .veelPrice {
    width: 109px;
    height: 28px;
    border-radius: 5px;
    background: #FFF;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .imgProjectCard {
    width: 285px;
    height: 191px;
    border-radius: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-decoration: none;
    background-size: cover;
    background-position: center
  }

  .ProjectCard {
    max-height: 280px;
    display: flex;
    flex-direction: column;
  }

  .ProjectCardCta {
    display: flex;
    height: 50px;
    justify-content: flex-end;
    margin-inline-end: 15px;
  }

  .veelPrice {
    width: fit-content;
    height: 28px;
    border-radius: 5px;
    background: #FFF;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 15px;
    margin-inline-end: 10px;
  }

  p.realPrice {
    padding-inline: 15px;
  }

  .ProjectCardDeveloper {
    color: #000;
    text-align: center;
    font-size: 14px;
    font-weight: 300;
    line-height: 133%;
    text-transform: capitalize;
  }

  .ProjectCardContent {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 250px;
    gap: 12px;
    height: 125px;
    padding-top: 15px;
  }
</style>
