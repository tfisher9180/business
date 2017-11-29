<?php
/**
 * Business Theme Customizer
 *
 * @package Business
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_customize_register( $wp_customize ) {
	$business_pages = array();
	$business_pages_object = get_posts( 'post_type=page&posts_per_page=-1' );
	$business_pages[ '' ] = __( 'Choose page', 'business' );
	foreach ( $business_pages_object as $business_page ) {
		$business_pages[ $business_page->ID ] = $business_page->post_title;
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Customizer Panels
	**/
	require get_template_directory() . '/inc/customizer/panels.php';

	/**
	 * WordPress Options
	**/
	require get_template_directory() . '/inc/customizer/wordpress-options.php';

	/**
	 * Theme Options - Navigation
	**/
	require get_template_directory() . '/inc/customizer/theme-options/navigation.php';

	/**
	 * Sanitize Callbacks
	**/
	require get_template_directory() . '/inc/customizer/sanitizations.php';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'business_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'business_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'business_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function business_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function business_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function business_customize_preview_js() {
	wp_enqueue_script( 'business-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'business_customize_preview_js' );