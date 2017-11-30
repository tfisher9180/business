<?php

$wp_customize->add_section( 'business_information', array(
	'capability'				=> 'edit_theme_options',
	'title'							=> __( 'Business Information', 'srcc' ),
	'description'				=> 'General information about your business that will display in various parts of the theme for consistency.',
	'panel'							=> 'theme_options',
) );


// Full Address
// -----------------------------
$wp_customize->add_setting( 'display_full_address', array(
	'default'						=> '',
	'type'							=> 'theme_mod',
	'capability'				=> 'edit_theme_options',
	'sanitize_callback'	=> 'business_sanitize_checkbox',
));

$wp_customize->add_control( 'display_full_address', array(
	'type'							=> 'checkbox',
	'section'						=> 'business_information',
	'label'							=> __( 'Display Full Address', 'business' ),
	'description'				=> __( 'Default: City, State', 'business' ),
));

// Show Icons
// -----------------------------
$wp_customize->add_setting( 'show_business_info_icons', array(
	'default'						=> '',
	'type'							=> 'theme_mod',
	'capability'				=> 'edit_theme_options',
	'sanitize_callback'	=> 'business_sanitize_checkbox',
));

$wp_customize->add_control( 'show_business_info_icons', array(
	'type'							=> 'checkbox',
	'section'						=> 'business_information',
	'label'							=> __( 'Show Icons in Topbar', 'business' ),
  'description'       => '',
));

// Show Address
// -----------------------------
$wp_customize->add_setting( 'show_business_info_address', array(
	'default'						=> '',
	'type'							=> 'theme_mod',
	'capability'				=> 'edit_theme_options',
	'sanitize_callback'	=> 'business_sanitize_checkbox',
));

$wp_customize->add_control( 'show_business_info_address', array(
	'type'							=> 'checkbox',
	'section'						=> 'business_information',
	'label'							=> __( 'Show Address in Topbar', 'business' ),
  'description'       => '',
));

// Show Email
// -----------------------------
$wp_customize->add_setting( 'show_business_info_email', array(
	'default'						=> '',
	'type'							=> 'theme_mod',
	'capability'				=> 'edit_theme_options',
	'sanitize_callback'	=> 'business_sanitize_checkbox',
));

$wp_customize->add_control( 'show_business_info_email', array(
	'type'							=> 'checkbox',
	'section'						=> 'business_information',
	'label'							=> __( 'Show Email in Topbar', 'business' ),
  'description'       => '',
));

// Show Phone Number
// -----------------------------
$wp_customize->add_setting( 'show_business_info_phone', array(
	'default'						=> '',
	'type'							=> 'theme_mod',
	'capability'				=> 'edit_theme_options',
	'sanitize_callback'	=> 'business_sanitize_checkbox',
));

$wp_customize->add_control( 'show_business_info_phone', array(
	'type'							=> 'checkbox',
	'section'						=> 'business_information',
	'label'							=> __( 'Show Phone Number in Topbar', 'business' ),
  'description'       => '',
));


// City / State
// -----------------------------
$wp_customize->add_setting( 'business_city_state', array(
	'default'			=> '',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'transport'			=> '',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'business_city_state', array(
	'type'				=> 'text',
	'section'			=> 'business_information',
	'label'				=> __( 'City, State', 'srcc' ),
	'description'		=> '',
) );

// Address (exlcuding city/state)
// -----------------------------
$wp_customize->add_setting( 'business_address', array(
	'default'			=> '',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'transport'			=> '',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'business_address', array(
	'type'				=> 'text',
	'section'			=> 'business_information',
	'label'				=> __( 'Address', 'srcc' ),
	'description'		=> 'The full business address excluding the city/state.',
) );

// Email
// -----------------------------
$wp_customize->add_setting( 'business_email', array(
	'default'			=> '',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'transport'			=> '',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'business_email', array(
	'type'				=> 'text',
	'section'			=> 'business_information',
	'label'				=> __( 'Email Address', 'srcc' ),
	'description'		=> '',
) );

// Phone Number
// -----------------------------
$wp_customize->add_setting( 'business_phone', array(
	'default'			=> '',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'transport'			=> '',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'business_phone', array(
	'type'				=> 'text',
	'section'			=> 'business_information',
	'label'				=> __( 'Phone Number', 'srcc' ),
	'description'		=> '',
) );
