<?php

// ENQUEUE PARENT THEME, CUSTOM CSS & CUSTOM JS //////////////////////////////////////////////
add_action( 'wp_enqueue_scripts', 'bh_theme_scripts' );
function bh_theme_scripts() {

	 wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	 wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() .'/css/custom.css', array(), null, 'all' );
	 
	 wp_register_script( 'custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0', true );
	 wp_enqueue_script( 'custom-js' );
}

// CSS FÜR LOGIN-PAGE //////////////////////////////////////////////////////////////////////
add_action( 'login_enqueue_scripts', 'bh_login_style' );
function bh_login_style() { 

	wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/login.css' ); 
} 

// PASSWORT VERGESSEN LINK ENTFERNEN /////////////////////////////////////////////////////
add_action('login_head', 'bh_login_css');
function bh_login_css() {
    
    echo '<style type="text/css">body.login #login p#nav {display:none;}</style>';
}

// REVISIONEN REDUZIEREN //////////////////////////////////////////////////////////////////
add_filter( 'wp_revisions_to_keep', 'divi_limit_revisions', 10, 2 );
function divi_limit_revisions( $num ) { 
	$num = 3;
	return $num;
}

// ERLAUBE UPLOADS /////////////////////////////////////////////////////////////////
#
# For this, see: wp-includes/capabilities.php > map_meta_cap()
#
function wpse_6533_map_unrestricted_upload_filter($caps, $cap) {
	if ($cap == 'unfiltered_upload') {
	  $caps = array();
	  $caps[] = $cap;
	}
  
	return $caps;
  }
  
  add_filter('map_meta_cap', 'wpse_6533_map_unrestricted_upload_filter', 0, 2);
