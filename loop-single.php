<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	<?php freemarket_post_before(); ?>
	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<?php freemarket_post_inside_before(); ?>
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<footer>
			<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'freemarket'), 'after' => '</p></nav>')); ?>
			<?php $tags = get_the_tags(); if ($tags) { ?><p><?php the_tags(); ?></p><?php } ?>
		</footer>
		<?php freemarket_post_inside_after(); ?>
	</article>
	<?php freemarket_post_after(); ?>
<?php endwhile; /* End loop */ ?>