<?php

// Theme Demo Logo
// -----------------------------
$wp_customize->add_setting( 'theme_demo_logo', array(
	'default'						=> '',
	'type'							=> 'theme_mod',
	'capability'				=> 'edit_theme_options',
	'sanitize_callback'	=> 'business_sanitize_checkbox',
));

$wp_customize->add_control( 'theme_demo_logo', array(
	'type'							=> 'checkbox',
	'section'						=> 'title_tagline',
	'label'							=> __( 'Use Theme Demo Logo', 'business' ),
));