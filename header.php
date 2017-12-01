<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'business' ); ?></a>

	<header id="site-header">

		<?php if ( get_theme_mod( 'enable_topbar' ) == 1 ) : ?>
		<div id="topbar">
			<div class="container">
				<div class="row">
					<div class="flex-container column toggle-container">
						<button type="button" class="btn toggle-btn" data-toggle="jquery-slide" data-target="#topbar-content" aria-controls="topbar-content" aria-expanded="false">
							<span class="screen-reader-text"><?php esc_html_e( 'Toggle topbar with business info', 'business' ); ?></span>
							<span class="fa fa-angle-down"></span>
						</button>
						<div id="topbar-content" class="toggle-content" aria-expanded="false">
							<div class="flex-container column center col row-md between-md">
								<?php business_get_business_info_markup(); ?>
								<?php business_get_social_menu_markup(); ?>
							</div>
						</div>
					</div><!-- .flex-container -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- #topbar -->
		<?php endif; ?>

		<div id="brandbar">
			<div class="container">
				<div class="flex-container">
					<div class="site-logo<?php echo ( ! has_custom_logo() ) && ( get_theme_mod( 'theme_demo_logo' ) != 1 ) ? ' text-logo' : ''; ?>">
					<?php if ( has_custom_logo() ) :
						the_custom_logo();
					elseif ( get_theme_mod( 'theme_demo_logo' ) == 1 ): ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo get_template_directory_uri() . '/images/logo.svg' ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ) ) . ' logo'; ?>" />
						</a>
					<?php else: ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php $description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php endif;
					endif; ?>
					</div>
				</div><!-- .flex-container -->
			</div><!-- .container -->
		</div><!-- #brandbar -->

		<div id="mobile-navbar">
			<div class="container">
				<div class="row relative">
					<div class="flex-container">
						<div class="navbar-item navbar-btn">
							<button type="button" class="toggle-btn navbar-stretch" data-toggle="toggle" data-target="#mobile-navbar-search" data-overlay="true" data-aware="true" aria-controls="mobile-navbar-search" aria-expanded="false">
								<span class="screen-reader-text"><?php esc_html_e( 'Toggle site search bar', 'business' ); ?></span>
								<span class="fa fa-search"></span>
							</button>
							<div id="mobile-navbar-search">
								<?php get_search_form(); ?>
							</div>
						</div>
						<div class="navbar-item navbar-btn">
							<button type="button" class="toggle-btn menu-toggle navbar-stretch" data-toggle="off-canvas" data-target="#site-navigation" data-overlay="true" data-aware="true" aria-controls="primary-menu" aria-expanded="false">
								<span class="screen-reader-text"><?php esc_html_e( 'Toggle primary menu', 'business' ); ?></span>
								<span class="menu-icon"></span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<nav id="site-navigation">
				<button type="button" class="toggle-btn close" aria-controls="primary-menu">
					<span class="screen-reader-text"><?php esc_html_e( 'Toggle primary menu', 'business' ); ?></span>
					<span class="close-icon"></span>
				</button>
				<div class="container">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'site-navigation',
							'menu_id'        => 'primary-menu',
							'menu_class'	 	 => 'menu',
							'container'		 	 => 'false',
						) );
					?>
				</div>
			</div>
		</nav><!-- #site-navigation -->

	</header><!-- #site-header -->

	<div id="content" class="site-content">
