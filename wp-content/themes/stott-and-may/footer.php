<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Stott_&_May
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="footer-illustration">
			<div class="container">
				<div class="row">
					<div class="skyline_background">
					</div>
				</div>
			</div>
		</div>
		<div class="footer-widgets">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-4">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1") ) : ?>
						<?php endif;?>
					</div>
					<div class="col-12 col-sm-4">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 2") ) : ?>
						<?php endif;?>
					</div>
					<div class="col-12 col-sm-4">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 3") ) : ?>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
