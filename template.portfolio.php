<?php

/* Template Name: Portfolio */

use BoxyBird\Inertia\Inertia;

$post_id = get_the_ID();
$banner = get_fields(13);

$terms = array_map(function ($term) {
    return [
        'id' => $term->term_id,
        'name' => $term->name,
        'slug' => $term->slug
    ];
}, get_terms( 'tipo' ));

$the_query = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => 9));
$more_portfolio = array_map(function ($post) {
    return [
        'id'      => $post->ID,
        'name' => get_field("portfolio_name", $post->ID),
        'client' => get_field("portfolio_client", $post->ID),
        'thumbnail' => get_media_sizes_URL(get_post_thumbnail_id( $post->ID )),
        'link' => get_relative_permalink(get_permalink($post->ID))
    ];
}, $the_query->posts);

return Inertia::render('Portfolio', [
    'banner' => $banner,
    'terms' => $terms,
    'more_portfolio' => $more_portfolio,
]);
