
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
</body>
</html>