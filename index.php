<?php

use BoxyBird\Inertia\Inertia;

use function PHPSTORM_META\type;

if (is_front_page()) {

    $post_id = get_the_ID();
    $custom_fields = get_fields($post_id);

    $the_query = new WP_Query(array('post_type' => 'sliders'));
    $sliders = array_map(function ($post) {
        $desktop = get_field("slider_desktop", $post->ID);
        $mobile = get_field("slider_mobile", $post->ID);
        return [
            'id'      => $post->ID,
            'title' => get_the_title($post->ID),
            'desktop' => $desktop ? $desktop['sizes'] : null,
            'mobile' => $mobile ? $mobile['sizes'] : null,
            'desktop_url' => $desktop['url'],
            'mobile_url' => $desktop['url'],
            'link'    => get_field("slider_link", $post->ID),
        ];
    }, $the_query->posts);

    $the_query = new WP_Query(array('post_type' => 'depoimentos'));
    $testimony = array_map(function ($post) {
        return [
            'id'      => $post->ID,
            'testimony' => get_field("testimony_testimony", $post->ID),
            'client' => get_field("testimony_client", $post->ID),
            'company' => get_field("testimony_company", $post->ID),
        ];
    }, $the_query->posts);

    $the_query = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => 4));
    $portfolio = array_map(function ($post) {
        return [
            'id'      => $post->ID,
            'name' => get_field("portfolio_name", $post->ID),
            'client' => get_field("portfolio_client", $post->ID),
            'thumbnail' => get_media_sizes_URL(get_post_thumbnail_id( $post->ID )),
            'link' => get_relative_permalink(get_permalink($post->ID))
        ];
    }, $the_query->posts);

    return Inertia::render('Home', [
        'customFields' => $custom_fields,
        'sliders' => $sliders,
        'testimony' => $testimony,
        'portfolio' => $portfolio,
    ]);
} else 

if (is_home()) {

    $banner = get_fields(13);

    $categories = get_categories();

    return Inertia::render('Blog', [
        'banner' => $banner,
        'portfolio' => $portfolio,
        'more_portfolio' => $more_portfolio,
        'categories' => $categories,
        'post' => get_post(),
      ]);

} else 

if (is_single()) {

    $post_id = get_the_ID();

    $posts = array_map(function ($post) {
        return [
            'content' => apply_filters('the_content', get_the_content($post->ID)),
            'date'    => get_the_date('d \d\e F \d\e Y', $post->ID),
            'title'   => html_entity_decode($post->post_title),
            'thumbnail' => get_the_post_thumbnail($post_id),
            'url'     => get_permalink($post->ID),
        ];
    }, $wp_query->posts);

    $categories = get_categories();
    
    return Inertia::render('Single', [
        'post' => array_values($posts)[0],
        'categories' => $categories,
    ]);
} else

if (is_page()) {

    $banner = get_fields(13);
    $custom_fields = get_fields($post_id);

    $contact_form = do_shortcode('[gravityform id="1" title="false" ajax="true"]');

    return Inertia::render('Page', [
        'banner' => $banner,
        'customFields' => $custom_fields,
        'page' => get_post(),
        'contactForm' => $contact_form,
    ]);
} else 

if (is_404()) {
    return Inertia::render('404', [
        'content' => '404 - Not Found',
    ]);
} else

{
    return Inertia::render('Index', [
        'page' => get_post(),
    ]);
}