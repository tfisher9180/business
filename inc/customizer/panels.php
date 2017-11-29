<?php

// WordPress Options
// ---------------------------
$wp_customize->add_panel( 'wordpress_options', array(
	'priority'				=> 10,
	'capability'			=> 'edit_theme_options',
	'title'						=> __( 'WordPress Options', 'business' ),
	'description'			=> __( 'Default options for WordPress', 'business' ),
));

// Theme Options
// ---------------------------
$wp_customize->add_panel( 'theme_options', array(
	'priority'				=> 20,
	'capability'			=> 'edit_theme_options',
	'title'						=> __( 'Theme Options', 'business' ),
	'description'			=> __( 'Custom options for the theme', 'business' ),
));
