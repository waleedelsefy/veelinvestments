<div class="veelNavBar">
  <div class="veelNavbarItems">
    <div class="veelLogo">
      <div class="logo">
        <a href="<?php echo esc_url(home_url()); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" aria-label="Go to homepage of <?php echo esc_attr(get_bloginfo('name')); ?>">
          <img src="<?php echo esc_url(get_template_directory_uri() .'/src/img/logo.png'); ?>" alt="Logo of <?php echo esc_attr(get_bloginfo('name')); ?>" class="logo" width="130" height="40"/>
        </a>
      </div>
    </div>
    <div class="humburgerMenu" id="humburgerMenu">
      <svg xmlns="http://www.w3.org/2000/svg" width="33" height="32" viewBox="0 0 33 32" fill="none">
        <path d="M28.8747 16.2309C28.8747 16.6211 28.7197 16.9952 28.4438 17.2711C28.1679 17.547 27.7937 17.702 27.4035 17.702H5.82662C5.43645 17.702 5.06225 17.547 4.78636 17.2711C4.51046 16.9952 4.35547 16.6211 4.35547 16.2309C4.35547 15.8407 4.51046 15.4665 4.78636 15.1906C5.06225 14.9147 5.43645 14.7597 5.82662 14.7597H27.4035C27.7937 14.7597 28.1679 14.9147 28.4438 15.1906C28.7197 15.4665 28.8747 15.8407 28.8747 16.2309ZM5.82662 9.85588H27.4035C27.7937 9.85588 28.1679 9.70089 28.4438 9.42499C28.7197 9.1491 28.8747 8.7749 28.8747 8.38473C28.8747 7.99455 28.7197 7.62036 28.4438 7.34447C28.1679 7.06857 27.7937 6.91357 27.4035 6.91357H5.82662C5.43645 6.91357 5.06225 7.06857 4.78636 7.34447C4.51046 7.62036 4.35547 7.99455 4.35547 8.38473C4.35547 8.7749 4.51046 9.1491 4.78636 9.42499C5.06225 9.70089 5.43645 9.85588 5.82662 9.85588ZM27.4035 22.6059H5.82662C5.43645 22.6059 5.06225 22.7609 4.78636 23.0368C4.51046 23.3127 4.35547 23.6869 4.35547 24.077C4.35547 24.4672 4.51046 24.8414 4.78636 25.1173C5.06225 25.3932 5.43645 25.5482 5.82662 25.5482H27.4035C27.7937 25.5482 28.1679 25.3932 28.4438 25.1173C28.7197 24.8414 28.8747 24.4672 28.8747 24.077C28.8747 23.6869 28.7197 23.3127 28.4438 23.0368C28.1679 22.7609 27.7937 22.6059 27.4035 22.6059Z" fill="white"/>
      </svg>
    </div>
    <div class="navBarList">
      <?php
        wp_nav_menu(array(
          'theme_location' => 'header-menu',
          'container' => 'nav',
          'container_class' => 'header-nav',
          'menu_class' => 'header-menu',
          'depth' => 1,
        ));
      ?>
    </div>
    <div class="veelCta">
      <div class="veelCtaInclude">
        <?php get_template_part('template-parts/global/phone-wa-cta'); ?>
      </div>
    </div>
  </div>
</div>

<div class="veelMobilenavbar" id="veelMobilenavbar">
  <div class="xMark" id="xMark">
    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
      <path d="M19.6186 17.6945C19.8739 17.9499 20.0174 18.2962 20.0174 18.6574C20.0174 19.0185 19.8739 19.3649 19.6186 19.6203C19.3632 19.8756 19.0168 20.0191 18.6557 20.0191C18.2945 20.0191 17.9482 19.8756 17.6928 19.6203L10.5006 12.4258L3.30607 19.618C3.05069 19.8734 2.70433 20.0168 2.34318 20.0168C1.98202 20.0168 1.63566 19.8734 1.38029 19.618C1.12491 19.3626 0.981445 19.0163 0.981445 18.6551C0.981445 18.2939 1.12491 17.9476 1.38029 17.6922L8.57478 10.5L1.38255 3.30549C1.12718 3.05012 0.983711 2.70376 0.983711 2.3426C0.983711 1.98145 1.12718 1.63509 1.38255 1.37971C1.63793 1.12434 1.98429 0.980869 2.34544 0.980869C2.7066 0.980869 3.05296 1.12434 3.30833 1.37971L10.5006 8.5742L17.6951 1.37858C17.9504 1.1232 18.2968 0.979736 18.6579 0.979736C19.0191 0.979736 19.3655 1.1232 19.6208 1.37858C19.8762 1.63395 20.0197 1.98031 20.0197 2.34147C20.0197 2.70262 19.8762 3.04899 19.6208 3.30436L12.4263 10.5L19.6186 17.6945Z" fill="white"/>
    </svg>
  </div>

  <div class="veelMobileLogo">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/src/img/veel-logo.webp'); ?>" />
  </div>
  <div class="Mobile-navBarList">
    <?php
      wp_nav_menu(array(
        'theme_location' => 'header-menu',
        'container' => 'nav',
        'container_class' => 'header-nav',
        'menu_class' => 'header-menu',
        'depth' => 1,
      ));
    ?>
  </div>

  <div class="veelMobileCta">
    <?php get_template_part('template-parts/global/phone-wa-cta'); ?>
  </div>
  <div class="veelMobileSocial">
    <div class="socialMobile">
      <?php get_template_part('template-parts/home-page/social.php'); ?>
    </div>
  </div>
</div>

<script>
  document.getElementById('humburgerMenu').addEventListener('click', function() {
    var navbar = document.getElementById('veelMobilenavbar');
    navbar.classList.add('flex');
  });

  document.getElementById('xMark').addEventListener('click', function() {
    var navbar = document.getElementById('veelMobilenavbar');
    navbar.classList.remove('flex');
  });
</script>
