<div class="project-gallery" id="my-gallery">
  <div class="gallery-half">
    <div class="project-gallery-img-big">
      <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'gallery_image_1', true)); ?>" data-fancybox="gallery" data-caption="Gallery Image 1">
        <img width="1800" height="1200"
             src="<?php echo esc_url(get_post_meta(get_the_ID(), 'gallery_image_1', true)); ?>" alt="Gallery Image 1">
      </a>
    </div>
  </div>
  <div class="gallery-quarter">
    <div class="project-gallery-img">
      <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'gallery_image_2', true)); ?>" data-fancybox="gallery" data-caption="Gallery Image 2">
        <img width="1800" height="1200"
             src="<?php echo esc_url(get_post_meta(get_the_ID(), 'gallery_image_2', true)); ?>" alt="Gallery Image 2">
      </a>
    </div>
    <div class="project-gallery-img">
      <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'gallery_image_3', true)); ?>" data-fancybox="gallery" data-caption="Gallery Image 3">
        <img width="1800" height="1200"
             src="<?php echo esc_url(get_post_meta(get_the_ID(), 'gallery_image_3', true)); ?>" alt="Gallery Image 3">
      </a>
    </div>
  </div>
</div>
