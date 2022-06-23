<?php

add_action('wp_enqueue_scripts', function () {
    $version = md5_file(get_stylesheet_directory() . '/dist/mix-manifest.json');
    wp_enqueue_style('its_inertia', get_stylesheet_directory_uri() . '/dist/css/app.css', [], $version);
    wp_enqueue_script('bb_theme', get_stylesheet_directory_uri() . '/dist/app.js', [], $version, true);
    wp_enqueue_script('rd_whatsapp', 'https://d335luupugsy2.cloudfront.net/js/loader-scripts/5845c279-9db4-43b6-90f7-a406739d5740-loader.js#asyncload', [], $version, true);
    // wp_enqueue_script('rd_footer_form', 'https://d335luupugsy2.cloudfront.net/js/rdstation-forms/stable/rdstation-forms.min.js#asyncload', [], $version, true);
});

// Register Menu and Enable theme support
add_action('init', function () {
    add_theme_support('menus');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus([
        'primary-menu' => 'Primary Menu',
        'secondary-menu' => 'Secondary Menu',
        'third-menu' => 'Third Menu'
    ]);
});

// Change search form to HMTL5
function wpdocs_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );


/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	
	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function change_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'change_excerpt_length');

function add_async_forscript($url)
{
    if (strpos($url, '#asyncload')===false)
        return $url;
    else if (is_admin())
        return str_replace('#asyncload', '', $url);
    else
        return str_replace('#asyncload', '', $url)."' async='async"; 
}
add_filter('clean_url', 'add_async_forscript', 11, 1);