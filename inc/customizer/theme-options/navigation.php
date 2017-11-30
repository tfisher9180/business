<?php

$wp_customize->add_section( 'navigation', array(
	'capability'			=> 'edit_theme_options',
	'title'						=> __( 'Navigation', 'business' ),
	'panel'						=> 'theme_options',
));

// Separate desktop and mobile menus
// -----------------------------
$wp_customize->add_setting( 'overview_pages', array(
	'default'						=> '',
	'type'							=> 'theme_mod',
	'capability'				=> 'edit_theme_options',
	'transport'					=> '',
	'sanitize_callback'	=> 'business_sanitize_checkbox',
));

$wp_customize->add_control( 'overview_pages', array(
	'type'							=> 'checkbox',
	'section'						=> 'navigation',
	'label'							=> __( 'Overview Pages', 'business' ),
	'description'				=> __( 'Enables the dynamic creation of "Overview" pages on mobile devices less than 992px for better menu accessibility.', 'business' ),
));
