<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Stott_&_May
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="<?php echo site_url(); ?>/img/favicon.png" />
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php if( get_field('navigation_hero_colour') == 'light' ): ?>
	<script>
		jQuery(window.document).ready(function () {
			jQuery("body").addClass("light");
		});
	</script>
<?php else: ?>
	<script>
		jQuery(window.document).ready(function () {
			jQuery("body").addClass("dark");
		});
	</script>
<?php endif; ?>

<body <?php body_class(); ?>>
	<div class="mobile-menu d-block d-sm-none">
		<nav id="site-navigation" class="main-navigation">

			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
			?>
		</nav><!-- #site-navigation -->
	</div>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'stott-and-may' ); ?></a>

	<header id="masthead" class="site-header container-fluid">
		<div class="row">
			<div class="site-branding col-sm-3 col-10">
				<?php if( get_field('navigation_hero_colour') == 'light' ): ?>
					<img src="<?php echo site_url(); ?>/img/logo-white.png">
				<?php else: ?>
					<img src="<?php echo site_url(); ?>/img/logo.png">
				<?php endif; ?>
			</div><!-- .site-branding -->
			<div class="col-2 d-block d-sm-none">
				<!--<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<div id="hamburger">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</button>-->
			<button type="button" class="menu-toggle visible-xs" aria-label="Toggle Mobile Menu">
      	<span class="burger-lines"></span>
	    </button>
			</div>
			<div class="nav-container col-sm-9 col-12 d-none d-sm-block">
				<nav id="site-navigation" class="main-navigation">

					<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );
					?>
				</nav><!-- #site-navigation -->
		</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
