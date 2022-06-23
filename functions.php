<?php

use BoxyBird\Inertia\Inertia;

require_once __DIR__ . '/vendor/autoload.php';

// Custom Theme Options
require __DIR__ . '/app/helpers.php';
require __DIR__ . '/app/theme-options.php';

// Share globally with Inertia views
add_action('after_setup_theme', function () {
    Inertia::share([
        'site' => [
            'name'        => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
            'theme_url'   => get_template_directory_uri(),
            "image_url"   => get_stylesheet_directory_uri() . "/resources/images/",
        ],
        'primary_menu' => wp_get_menu_array(185),
        'secondary_menu' => wp_get_menu_array(3),
    ]);

    Inertia::share(wp_get_social());
});