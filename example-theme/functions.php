<?php

function theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	register_nav_menu( 'main-menu', __( 'Main Menu', 'example-theme' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 200,
			'flex-height' => true,
		)
	);

	set_post_thumbnail_size( 200, 200, true );
	add_image_size( 'custom-header', 1200, 400, true );
}
add_action( 'after_setup_theme', 'theme_setup' );

function example_theme_enqueue_assets() {
	wp_enqueue_style( 'example-theme-style', get_stylesheet_uri(), array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'example_theme_enqueue_assets' );

