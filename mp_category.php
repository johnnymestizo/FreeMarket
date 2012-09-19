<?php get_header(); ?>
<?php freemarket_content_before(); ?>
<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
	<?php freemarket_main_before(); ?>
	<div id="main" class="<?php echo MAIN_CLASSES; ?> <?php freemarket_sidebar_layout_class(); ?>" role="main">
		<?php if ( class_exists( 'MarketPress' ) ) { ?>
			<div id="product-grid">
				<ul class="subcategories">
					<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					wp_list_categories('taxonomy=product_category&depth=0&show_count=0&&title_li=&child_of=' . $term->term_id . '&show_option_none=');
					?>
				</ul>
				<div class="clearfix"></div>
				<?php freemarket_list_products();?>
			</div>
		<?php } ?>
	</div><!-- /#main -->
	<?php freemarket_main_after(); ?>
	<?php get_sidebar(); ?>
</div><!-- /#content -->
<?php freemarket_content_after(); ?>
<?php get_footer(); ?>