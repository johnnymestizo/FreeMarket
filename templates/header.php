<header id="banner" role="banner">
  <div class="container">
    <a class="brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
    <nav id="nav-main" role="navigation">
      <?php
        if (has_nav_menu('freemarket-main-menu')) {
          wp_nav_menu(array('theme_location' => 'freemarket-main-menu', 'menu_class' => 'nav nav-pills'));
        }
      ?>
    </nav>
  </div>
</header>