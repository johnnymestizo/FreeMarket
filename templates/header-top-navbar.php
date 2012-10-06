<header id="banner" class="navbar navbar-fixed-top <?php freemarket_navbar_class(); ?>" role="banner">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="<?php echo home_url(); ?>/">
        <?php bloginfo('name'); ?>
      </a>
      <nav id="nav-main" class="nav-collapse" role="navigation">
        <?php
          if (has_nav_menu('freemarket-main-menu')) {
            wp_nav_menu(array('theme_location' => 'freemarket-main-menu', 'menu_class' => 'nav'));
          }
        ?>
      </nav>
      <?php get_template_part('templates/top-navbar-user-menu'); ?>
    </div>
  </div>
</header>