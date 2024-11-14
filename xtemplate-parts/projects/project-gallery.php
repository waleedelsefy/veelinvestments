<div class="project-gallery" id="my-gallery">
    <div style="display: none;">
        <picture aria-hidden="true">
            <img data-src="<?php echo esc_url(get_post_meta(get_the_ID(), 'gallery_image_1', true)); ?>" alt="Gallery Image 1">
        </picture>
        <picture aria-hidden="true">
            <img data-src="<?php echo esc_url(get_post_meta(get_the_ID(), 'gallery_image_2', true)); ?>" alt="Gallery Image 2">
        </picture>
        <picture aria-hidden="true">
            <img data-src="<?php echo esc_url(get_post_meta(get_the_ID(), 'gallery_image_3', true)); ?>" alt="Gallery Image 3">
        </picture>
    </div>
    <div class="gallery-half">
        <div class="project-gallery-img-big">
            <img class="fancybox imgLoader Loaded" width="1800" height="1200"
                 src="<?php echo esc_url(get_post_meta(get_the_ID(), 'gallery_image_1', true)); ?>" alt="Gallery Image 1">
        </div>
    </div>
    <div class="gallery-quarter">
        <div class="project-gallery-img">
            <img class="fancybox imgLoader Loaded" width="1800" height="1200"
                 src="<?php echo esc_url(get_post_meta(get_the_ID(), 'gallery_image_2', true)); ?>" alt="Gallery Image 2">
        </div>
        <div class="project-gallery-img">
            <img class="fancybox imgLoader Loaded" width="1800" height="1200"
                 src="<?php echo esc_url(get_post_meta(get_the_ID(), 'gallery_image_3', true)); ?>" alt="Gallery Image 3">
        </div>
    </div>
</div>
