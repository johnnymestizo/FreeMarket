<?php get_header(); ?>
<?php freemarket_content_before(); ?>
<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
	<?php freemarket_main_before(); ?>
	<div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
		<?php if ( class_exists( 'MarketPress' ) ) { ?>
			<div id="product-grid">
				<div class="clearfix"></div>
				<?php freemarket_list_products();?>
			</div>
		<?php } ?>
	</div><!-- /#main -->
	<?php freemarket_main_after(); ?>
	<?php freemarket_sidebar_before(); ?>
	<aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
		<?php freemarket_sidebar_inside_before(); ?>
		<?php get_sidebar(); ?>
		<?php freemarket_sidebar_inside_after(); ?>
	</aside><!-- /#sidebar -->
	<?php freemarket_sidebar_after(); ?>
</div><!-- /#content -->
<?php freemarket_content_after(); ?>
<?php get_footer(); ?>