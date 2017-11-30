<?php

$wp_customize->add_section( 'social_networking', array(
	'capability'				=> 'edit_theme_options',
	'title'							=> __( 'Social Networking', 'srcc' ),
	'description'				=> 'Enter a URL into the following fields to activate that social network for this theme.',
	'panel'							=> 'theme_options',
) );


// Facebook
// -----------------------------
$wp_customize->add_setting( 'url_facebook', array(
	'default'			=> '',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url',
) );

$wp_customize->add_control( 'url_facebook', array(
	'type'				=> 'url',
	'section'			=> 'social_networking',
	'label'				=> __( 'Facebook URL', 'srcc' ),
	'description'		=> '',
) );


// Twitter
// -----------------------------
$wp_customize->add_setting( 'url_twitter', array(
	'default'			=> '',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url',
) );

$wp_customize->add_control( 'url_twitter', array(
	'type'				=> 'url',
	'section'			=> 'social_networking',
	'label'				=> __( 'Twitter URL', 'srcc' ),
	'description'		=> '',
) );


// Instagram
// -----------------------------
$wp_customize->add_setting( 'url_instagram', array(
	'default'			=> '',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url',
) );

$wp_customize->add_control( 'url_instagram', array(
	'type'				=> 'url',
	'section'			=> 'social_networking',
	'label'				=> __( 'Instagram URL', 'srcc' ),
	'description'		=> '',
) );


// Google
// -----------------------------
$wp_customize->add_setting( 'url_google', array(
	'default'			=> '',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url',
) );

$wp_customize->add_control( 'url_google', array(
	'type'				=> 'url',
	'section'			=> 'social_networking',
	'label'				=> __( 'Google URL', 'srcc' ),
	'description'		=> '',
) );


// LinkedIn
// -----------------------------
$wp_customize->add_setting( 'url_linkedin', array(
	'default'			=> '',
	'type'				=> 'theme_mod',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url',
) );

$wp_customize->add_control( 'url_linkedin', array(
	'type'				=> 'url',
	'section'			=> 'social_networking',
	'label'				=> __( 'LinkedIn URL', 'srcc' ),
	'description'		=> '',
) );
