<div class="span4">
  <?php
  if ( class_exists( 'MarketPress' ) ) { ?>
    <ul class="nav nav-pills pull-right">
      <li class="cart">
        <?php if ( class_exists( 'MarketPress' ) ) {
        $settings = get_option('mp_settings');
        if (!$settings['disable_cart']) {
          global $mp, $mp_wpmu;
          if ( $mp->global_cart && is_object($mp_wpmu) && !$mp_wpmu->is_main_site() && function_exists('mp_main_site_id') ) {
            switch_to_blog(mp_main_site_id());
            $settings = get_option('mp_settings');
            $link = home_url( $settings['slugs']['store'] . '/' . $settings['slugs']['cart'] . '/' );
            restore_current_blog();
          } else {
            $settings = get_option('mp_settings');
            $link = home_url( $settings['slugs']['store'] . '/' . $settings['slugs']['cart'] . '/' );
          }
          ?>
          <a href="<?php echo $link ?>">
            <?php
            $header_bg_color = get_theme_mod('bc_header_backgroundcolor');
            if (freemarket_get_brightness($header_bg_color) >= 130){ ?>
              <i class="icon-shopping-cart"></i>
            <?php } else { ?>
              <i class="icon-shopping-cart icon-white"></i>
            <?php }
            _e('My Cart', 'freemarket'); ?>
          </a>
        <?php } } ?>
      </li>
    </ul>
  <?php } ?>
</div>