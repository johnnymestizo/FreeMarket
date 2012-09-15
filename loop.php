<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) { ?>
	<div class="alert alert-block fade in">
		<a class="close" data-dismiss="alert">&times;</a>
		<p><?php _e('Sorry, no results were found.', 'freemarket'); ?></p>
	</div>
	<?php get_search_form(); ?>
<?php } ?>
	
<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	<?php freemarket_post_before(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php freemarket_post_inside_before(); ?>
		<header>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header>
		
		<div class="entry-content">
			<?php if (is_archive() || is_search()) { ?>
				<?php the_excerpt(); ?>
			<?php } else { ?>
				<?php the_content(); ?>
			<?php } ?>
		</div>
		
		<footer>
			<?php $tags = get_the_tags(); if ($tags) { ?><p><?php the_tags(); ?></p><?php } ?>
		</footer>
		
		<?php freemarket_post_inside_after(); ?>
	</article>
	
	<?php freemarket_post_after(); ?>
<?php endwhile; /* End loop */ ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>

<?php if ($wp_query->max_num_pages > 1) { ?>
	<nav id="post-nav" class="pager">
		<div class="previous"><?php next_posts_link(__('&larr; Older posts', 'freemarket')); ?></div>
		<div class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'freemarket')); ?></div>
	</nav>
<?php } ?>