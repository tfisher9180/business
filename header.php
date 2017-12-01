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
						<button type="button" class="btn toggle-btn" aria-controls="topbar-content" aria-expanded="false">
							<span class="screen-reader-text"><?php esc_html_e( 'Toggle topbar with business info', 'business' ); ?></span>
							<span class="fa fa-angle-down"></span>
						</button>
						<div id="topbar-content" class="toggle-content" aria-expanded="false">
							<div class="flex-container column center col row-md between-md">
								<?php business_get_business_info_markup(); ?>
								<?php business_get_social_menu_markup(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<div id="brandbar">
			<div class="container">
				<div class="site-logo">
				<?php if ( has_custom_logo() ) :
					the_custom_logo();
				elseif ( get_theme_mod( 'theme_demo_logo' ) == 1 ): ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo get_template_directory_uri() . '/images/logo.svg' ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' ) ) . ' logo'; ?>" />
					</a>
				<?php else: ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php endif; ?>
				</div>
			</div>
		</div>

	</header>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'business' ); ?></button>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'site-navigation',
					'menu_id'        => 'primary-menu',
					'menu_class'	 => 'menu',
					'container'		 => 'false',
				) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
