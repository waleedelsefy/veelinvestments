<?php
$args = array(
  'post_type'      => 'testimonial',
  'posts_per_page' => -1,
);

$testimonial_query = new WP_Query($args);

if ($testimonial_query->have_posts()) :
  ?>

  <div class="veel-testimonial-container">
    <div class="veel-testimonial-solider-layer"></div>
    <div class="veel-testimonial-background-layer"></div>
    <div class="veel-author-layer-header">
      <div class="veel-header-text">
        <h1><?php _e('What Our Clients Say', 'veelinvestments'); ?></h1>
      </div>
      <div class="veel-testimonial-subtext">
        <?php _e('Simply dummy text used in the printing industry.', 'veelinvestments'); ?>
      </div>
    </div>

    <div class="all-testimonials">
      <?php
      $index = 0;
      while ($testimonial_query->have_posts()) :
        $testimonial_query->the_post();
        $author_name = get_post_meta(get_the_ID(), 'testimonial_author_name', true);
        $author_job = get_post_meta(get_the_ID(), 'testimonial_author_job', true);
        $active_class = ($index === 0) ? 'active' : '';
        ?>
        <div class="veel-testimonial-box <?php echo esc_attr($active_class); ?>">
          <?php the_content(); ?>
          <div class="veel-testimonial-author">
            <p class="veel-author-testimonial-name"><?php echo esc_html($author_name); ?></p>
            <p class="veel-author-position"><?php echo esc_html($author_job); ?></p>
          </div>
        </div>
        <?php
        $index++;
      endwhile;
      wp_reset_postdata();
      ?>
    </div>

    <div class="veel-testimonial-arrows">
      <svg xmlns="http://www.w3.org/2000/svg" width="96" height="41" viewBox="0 0 96 41" fill="none">
        <rect class="veel-testimonial-arrow veel-right-arrow" id="veel-right-arrow" x="55" width="41" height="41" rx="6.07407" fill="#E9DEBE"/>
        <path d="M78.7901 13.6665L77.6304 15.0047L82.2201 20.31L65.6296 20.31L65.6296 22.2082L82.2201 22.2082L77.6221 27.504L78.7901 28.8517L85.3704 21.2591L78.7901 13.6665Z" fill="white"/>
        <rect class="veel-testimonial-arrow veel-left-arrow" id="veel-left-arrow" width="41" height="41" rx="6.07407" fill="#E9DEBE"/>
        <path d="M17.2099 28.852L18.3696 27.5139L13.7799 22.2085L30.3704 22.2085L30.3704 20.3104L13.7799 20.3104L18.3779 15.0145L17.2099 13.6669L10.6296 21.2595L17.2099 28.852Z" fill="white"/>
      </svg>
    </div>

    <div class="veel-decor">
      <div class="veel-decor-line"></div>
      <div class="veel-decor-highlight"></div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const testimonials = document.querySelectorAll('.veel-testimonial-box');
      const rightArrow = document.getElementById('veel-right-arrow');
      const leftArrow = document.getElementById('veel-left-arrow');
      let currentIndex = 0;

      if (testimonials.length === 0) return;

      function updateTestimonialDisplay() {
        testimonials.forEach(function(testimonial, index) {
          testimonial.style.display = (index === currentIndex) ? 'block' : 'none';
        });
      }

      updateTestimonialDisplay();

      rightArrow.addEventListener('click', function () {
        currentIndex = (currentIndex + 1) % testimonials.length;
        updateTestimonialDisplay();
      });

      leftArrow.addEventListener('click', function () {
        currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
        updateTestimonialDisplay();
      });
    });
  </script>

<?php endif; ?>
