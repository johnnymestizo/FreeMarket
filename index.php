<?php get_header(); ?>
<?php freemarket_content_before(); ?>
<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
	<?php freemarket_main_before(); ?>
	<div id="main" class="<?php echo MAIN_CLASSES; ?> <?php freemarket_sidebar_layout_class(); ?>" role="main">
		<div class="page-header">
			<h1><?php _e('Latest Posts', 'freemarket');?></h1>
		</div>
		<?php get_template_part('loop', 'index'); ?>
	</div><!-- /#main -->
	<?php freemarket_main_after(); ?>
	<?php get_sidebar(); ?>
	</div><!-- /#content -->
	<?php freemarket_content_after(); ?>
<?php get_footer(); ?>