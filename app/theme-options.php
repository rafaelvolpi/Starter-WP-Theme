<?php

add_theme_support('menus');
add_theme_support('title-tag');
add_theme_support('post-thumbnails');

// Change search form to HMTL5

function wpdocs_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );