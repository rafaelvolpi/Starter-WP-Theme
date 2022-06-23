<?php

use BoxyBird\Inertia\Inertia;

add_action('init', function () {
    Inertia::setRootView('layout.php');
});

// Share globally with Inertia views
add_action('init', function () {

    $version = md5_file(get_stylesheet_directory() . '/mix-manifest.json');
    Inertia::version($version);

    Inertia::share([
        'site' => [
            'name'        => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
            'theme_url'   => get_template_directory_uri(),
        ]
    ]);

    Inertia::share([
        'primary_menu' => wp_get_menu_array(2),
        'secondary_menu' => wp_get_menu_array(3),
        'third_menu' => wp_get_menu_array(28),
    ]);

});

// General WP theme options
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

//defer certain scripts and styles
function defer_parsing_of_js($url)
{
    if (is_admin()) return $url;
    if (strpos($url, 'app.js')) return $url;
    if (strpos($url, 'donate-sdk.js')) return $url;
    if (strpos($url, '.js')) return "$url' defer ";
    if (strpos($url, '.css')) return "$url' defer ";

    return $url;
}
add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );


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
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
    /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
   return $urls;
}

