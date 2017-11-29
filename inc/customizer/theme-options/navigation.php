<?php

$wp_customize->add_section( 'navigation', array(
	'capability'			=> 'edit_theme_options',
	'title'						=> __( 'Navigation', 'business' ),
	'panel'						=> 'theme_options',
));

// Separate desktop and mobile menus
// -----------------------------
$wp_customize->add_setting( 'separate_desktop_mobile_menu', array(
	'default'						=> '',
	'type'							=> 'theme_mod',
	'capability'				=> 'edit_theme_options',
	'transport'					=> '',
	'sanitize_callback'	=> 'business_sanitize_checkbox',
));

$wp_customize->add_control( 'separate_desktop_mobile_menu', array(
	'type'							=> 'checkbox',
	'section'						=> 'navigation',
	'label'							=> __( 'Create separate WordPress menus for desktop and mobile views.', 'business' ),
	'description'				=> __( 'If checked, you will be able to create a different menu in the WordPress backend for devices less than 768px, and devices larger than 768px. If unchecked, both locations will use the same WordPress menu.', 'business' ),
));
