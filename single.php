<?php get_header(); ?>
<?php basic_content_before(); ?>
<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
	<?php basic_main_before(); ?>
	<div id="main" class="<?php echo MAIN_CLASSES; ?> <?php freemarket_sidebar_layout_class(); ?>" role="main">
		<?php basic_loop_before(); ?>
		<?php get_template_part('loop', 'single'); ?>
		<?php basic_loop_after(); ?>
	</div><!-- /#main -->
	<?php basic_main_after(); ?>

	<?php get_sidebar(); ?>

</div><!-- /#content -->
<?php basic_content_after(); ?>
<?php get_footer(); ?>