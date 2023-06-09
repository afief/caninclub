<?php

/* THEME SETUP
------------------------------------------------ */

if ( ! function_exists( 'caninclub_setup' ) ) :
	function caninclub_setup() {
		
		// Automatic feed
		add_theme_support( 'automatic-feed-links' );

		
		// Post thumbnails
		add_theme_support( 'custom-header' );
		add_theme_support( 'post-thumbnails' );
		
		// Title tag
		add_theme_support( 'title-tag' );
		
		// Post formats
		add_theme_support( 'post-formats', array( 'aside' ) );
		
		// Register nav menu
		register_nav_menu( 'primary-menu', __( 'Primary Menu', 'caninclub' ) );
		
		// Make the theme translation ready
		load_theme_textdomain( 'caninclub', get_template_directory() . '/languages' );
		
	}
	add_action( 'after_setup_theme', 'caninclub_setup' );
endif;


/* ENQUEUE STYLES
------------------------------------------------ */

if ( ! function_exists( 'caninclub_load_style' ) ) :
	function caninclub_load_style() {

		$theme_version = wp_get_theme( 'caninclub' )->get( 'Version' );

		wp_register_style( 'caninclub_fonts', '//fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic' );
		wp_enqueue_style( 'caninclub_style', get_stylesheet_uri(), array( 'caninclub_fonts' ) );

	}
	add_action( 'wp_enqueue_scripts', 'caninclub_load_style' );
endif;


/* ENQUEUE COMMENT-REPLY.JS
------------------------------------------------ */

if ( ! function_exists( 'caninclub_load_scripts' ) ) :
	function caninclub_load_scripts() {

		$theme_version = wp_get_theme( 'caninclub' )->get( 'Version' );

		wp_enqueue_script( 'caninclub_construct', get_template_directory_uri() . '/assets/js/construct.js', array( 'jquery' ), $theme_version, true );

		if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
	add_action( 'wp_enqueue_scripts', 'caninclub_load_scripts' );
endif;


/* ---------------------------------------------------------------------------------------------
   SPECIFY GUTENBERG SUPPORT
------------------------------------------------------------------------------------------------ */

if ( ! function_exists( 'caninclub_add_block_editor_features' ) ) :
	function caninclub_add_block_editor_features() {

		/* Gutenberg Palette --------------------------------------- */

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> __( 'Black', 'caninclub' ),
				'slug' 	=> 'black',
				'color' => '#000',
			),
			array(
				'name' 	=> __( 'White', 'caninclub' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

	}
	add_action( 'after_setup_theme', 'caninclub_add_block_editor_features' );
endif;
