<?php

use BoxyBird\Inertia\Inertia;

$post_id = get_the_ID();
$portfolio = get_fields($post_id);

$lista_portfolio_relacionado = get_field('portfolio_relacionado', $post_id);

if (is_array($lista_portfolio_relacionado)) {
    $portfolio_relacionado = array_map(function ($post) {
        // print_r($post);
        return [
            'id'      => $post->ID,
            'name' => get_field("portfolio_name", $post->ID),
            'client' => get_field("portfolio_client", $post->ID),
            'thumbnail' => get_media_sizes_URL(get_post_thumbnail_id( $post->ID )),
            'link' => get_relative_permalink(get_permalink($post->ID))
        ];
    }, $lista_portfolio_relacionado);
}

$the_query = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => 4));
$more_portfolio = array_map(function ($post) {
    return [
        'id'      => $post->ID,
        'name' => get_field("portfolio_name", $post->ID),
        'client' => get_field("portfolio_client", $post->ID),
        'thumbnail' => get_media_sizes_URL(get_post_thumbnail_id( $post->ID )),
        'link' => get_relative_permalink(get_permalink($post->ID))
    ];
}, $the_query->posts);

return Inertia::render('SinglePortfolio', [
    'portfolio' => $portfolio,
    'portfolio_relacionado' => $portfolio_relacionado,
    'more_portfolio' => $more_portfolio,
    'post' => get_post(),
]);