<?php
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
	function theme_enqueue_styles() {
	    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

	}
	function custom_excerpt_length( $length ) {
	return 29;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
?>