<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package Sela
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<a class="skip-link screen-reader-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'sela' ); ?>"><?php _e( 'Skip to content', 'sela' ); ?></a>

		<div class="site-branding">
			<?php sela_the_site_logo(); ?>


			<?php if ( '' != get_bloginfo( 'description' ) ) : ?>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<?php endif; ?>
		</div><!-- .site-branding -->
<div class="banner-container">
<div  style="height:25px; width:1180px; background-color:black"></div>
<div class="mobile-hide" style="background-color:black; border: 5px inset rgb(215, 188, 54);">
<?php if ( function_exists( 'useful_banner_manager_banners_rotation' ) ) { useful_banner_manager_banners_rotation( '1,2,3,4,5,6,7', 5, 1170, 300, 'rand' ); } ?>
</div></div>
<div style="height:20px; width:1180px; background-color:black"></div>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Menu', 'sela' ); ?></button>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">