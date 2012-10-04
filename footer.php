
</div><!-- /#maincontentarea -->
</div><!-- /#wrap -->

<div id="footerwrapper">
  <?php freemarket_footer_before(); ?>
  <footer id="content-info" class="<?php echo WRAP_CLASSES; ?>" role="contentinfo">
    <?php freemarket_footer_inside(); ?>

    <?php dynamic_sidebar('sidebar-footer'); ?>

    <p class="copy" style="float: left;"><small>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></small></p>

  </footer>
  <?php freemarket_footer_after(); ?>

  <?php wp_footer(); ?>
  <?php freemarket_footer(); ?>
</div>

<?php if (current_user_can('edit_theme_options')){ ?>
  <div class="admin-customize">
    <?php
    $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $href = add_query_arg( 'url', urlencode( $current_url ), wp_customize_url() ); ?>
    <a href="<?php echo $href; ?>"></a>
  </div>
<?php } ?>

</body>
</html>