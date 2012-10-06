<?php $navbar_class = get_theme_mod( 'freemarket_navbar_light_dark' ); ?>
<ul class="nav nav-collapse pull-right">
  <?php if (current_user_can('edit_others_posts')){ ?>
    <li class="menu-storeadmin">
      <a href="<?php echo admin_url(); ?>">
        <?php if ($navbar_class == 'dark') { ?>
          <i class="icon-cog icon-white"></i> 
        <?php } else { ?>
          <i class="icon-cog"></i> 
        <?php } ?>
        <?php _e('Store Administration', 'freemarket') ?>
      </a>
    </li>
  <?php } ?>
  <li>
      <?php if (is_user_logged_in()){
        $link  = wp_logout_url(get_permalink());
        $label = __('Logout', 'freemarket');
      } else {
        $link  = wp_login_url(get_permalink());
        $label = __('Login/Register', 'freemarket');
      }

      $content = '<a href="' . $link . '">';

      if ($navbar_class == 'dark') {
        $content .= '<i class="icon-user icon-white"></i> ';
      } else {
        $content .= '<i class="icon-user"></i> ';
      }
      $content .= $label;
      $content .= '</a>';
      
      echo $content;
      ?>
    </a>
  </li>
</ul>
