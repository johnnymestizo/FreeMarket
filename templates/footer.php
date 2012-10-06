<div id="footer-wrapper" class="container-fluid">
  <footer id="content-info" class="container" role="contentinfo">
    <div class="footer-inner row-fluid">
      <?php dynamic_sidebar('sidebar-footer-left'); ?>
      <?php dynamic_sidebar('sidebar-footer-mid'); ?>
      <?php dynamic_sidebar('sidebar-footer-right'); ?>
    </div>
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
  </footer>
</div>

<?php if (GOOGLE_ANALYTICS_ID) : ?>
<script>
  var _gaq=[['_setAccount','<?php echo GOOGLE_ANALYTICS_ID; ?>'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php endif; ?>

<?php if (current_user_can('edit_theme_options')){ ?>
  <div class="admin-customize">
    <?php
    $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $href = add_query_arg( 'url', urlencode( $current_url ), wp_customize_url() ); ?>
    <a class="icon-cogs" href="<?php echo $href; ?>"></a>
  </div>
<?php } ?>

<?php wp_footer(); ?>