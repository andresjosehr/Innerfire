<?php
/**
 * The template for displaying the footer.
 * @package writers
 */

?>

<div class="bta-start">
	<button class="btn"><span id="text">Load More</span> 
		<i class="fa fa-arrow-circle-o-down"></i></button>
	</div>

	<div class="container"> 
		<div class="row">
			<div class="col-md-4"><?php dynamic_sidebar( 'bottom_widget_left' ); ?></div>
			<div class="col-md-4"><?php dynamic_sidebar( 'bottom_widget_middle' ); ?></div>
			<div class="col-md-4"><?php dynamic_sidebar( 'bottom_widget_right' ); ?></div>
		</div>
	</div>
</div>
<div class="bta-start">
	<button class="btn"><span id="text">Show less</span> 
		<i class="fa fa-arrow-circle-o-up"></i></button>
	</div>

	<div class="footer-widget-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-4"><?php dynamic_sidebar( 'footer_widget_left' ); ?></div>
				<div class="col-md-4"><?php dynamic_sidebar( 'footer_widget_middle' ); ?></div>
				<div class="col-md-4"><?php dynamic_sidebar( 'footer_widget_right' ); ?></div>
			</div>
		</div>
	</div>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="row site-info"><?php echo '&copy; '.date_i18n(__('Y','writers')); ?> <?php bloginfo( 'name' ); ?></div>
	</footer>
</div>
<?php wp_footer(); ?>



</body>
</html>
