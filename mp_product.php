<?php get_header(); ?>
<?php freemarket_content_before(); ?>

<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
	<?php freemarket_main_before(); ?>
	<div id="main" class="<?php echo MAIN_CLASSES; ?> <?php freemarket_sidebar_layout_class(); ?>" role="main">
		<article itemscope itemtype="http://schema.org/Product" <?php mp_product_class(false, 'mp_product', $post->ID) ?> id="post-<?php the_ID(); ?>">
			<header>
				<?php if ( current_user_can('edit_posts') ){ ?>
					<div class="EditProductEntryButton" style="float: right;">
						<a class="btn" href="/wp-admin/post.php?post=<?php the_ID(); ?>&action=edit"><?php _e('Edit Product', 'freemarket') ?></a>
					</div>
				<?php } ?>
				<h1 itemprop="name" class="mp_product_name"><?php echo $post->post_title; ?></h1>
			</header>
			<div itemprop="description" class="mp_product_content">
				<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="mp_product_meta row-fluid">
					<div class="product-image-wrapper pull-left">
						<?php mp_product_image( true, 'full', $post->ID ); ?>
					</div>
					<div class="product-details">
					  <?php echo apply_filters('the_content', $post->post_content); ?>
					  <div class="clearfix"></div>
						<div class="pull-left"><?php mp_product_price(true, $post->ID, ''); ?></div>
						<div class="pull-right"><?php mp_buy_button(true, 'single', $post->ID); ?></div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</article>
	</div><!-- /#main -->
	<?php freemarket_main_after(); ?>
	
	<?php get_sidebar(); ?>
	
</div><!-- /#content -->
<?php freemarket_content_after(); ?>
<?php get_footer(); ?>