<?php freemarket_sidebar_before(); ?>
<aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
	<?php freemarket_sidebar_inside_before(); ?>
	<div class="sidebar">
		<?php dynamic_sidebar('sidebar-primary'); ?>
	</div>
	<?php freemarket_sidebar_inside_after(); ?>
</aside><!-- /#sidebar -->
<?php freemarket_sidebar_after(); ?>