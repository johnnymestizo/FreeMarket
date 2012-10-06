	<div itemscope itemtype="http://schema.org/Product" class="product-single">
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<?php if ( current_user_can('manage_options') ){ ?>
					<div class="EditProductEntryButton" style="float: right;">
						<a class="btn" href="<?php echo admin_url(); ?>post.php?post=<?php the_ID(); ?>&action=edit"><?php _e('Edit Product', 'freemarket') ?></a>
					</div>
				<?php } ?>
				<h1 itemprop="name" class="mp_product_name" class="entry-title"><?php the_title(); ?></h1>
				
				<div class="addthis_toolbox addthis_default_style ">
					<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
					<a class="addthis_button_tweet"></a>
					<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
					<a class="addthis_counter addthis_pill_style"></a>
				</div>
				<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
				<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e8994de6a13ee6a"></script>
			</header>
			
			<?php freemarket_product_with_slider($post->ID); ?>
			
		</article>
	</div><!-- /#main -->
