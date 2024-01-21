<?php

/*
 * View Count for resources (blog posts)
 */

/**
 * Removes pointer events from images
 */
add_filter("wp_get_attachment_image_attributes", function ($attr) {
    $attr["class"] = $attr["class"] . " pointer-events-none";

    return $attr;
});

add_filter("body_class", function ($classes) {
    $classes[] = "overscroll-none";
    $classes[] = "min-h-screen-ios";
    $classes[] = "min-h-screen";
    $classes[] = "scroll-smooth";
    $classes[] = "bg-page-bg";
    return $classes;
});

function load_template_part($template_name, $part_name = null, $args = [])
{
    ob_start();
    get_template_part($template_name, $part_name, $args);
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

add_filter('register_post_type_args', function ($args, $post_type) {
    if($post_type == 'artist'){
        $args['template'] = [
            ['acf/artist-hero'],
            ['acf/artist-content'],
            ['acf/artist-slider']
        ];
    }

    if($post_type == 'post') {
        $args['template'] = [
            ['acf/single-hero'],
            ['acf/text-content']
        ];
    }

    return $args;
}, 10, 2);