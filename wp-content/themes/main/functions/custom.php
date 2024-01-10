<?php

/*
 * View Count for resources (blog posts)
 */

use Illuminate\Support\Str;

/**
 * Removes pointer events from images
 */
add_filter( "wp_get_attachment_image_attributes", function ( $attr ) {
	$attr["class"] = $attr["class"] . " pointer-events-none";

	return $attr;
} );

add_filter("body_class", function ($classes) {
    $classes[] = "overscroll-none";
    $classes[] = "min-h-screen-ios";
    $classes[] = "min-h-screen";
    $classes[] = "scroll-smooth";
    return $classes;
});

function load_template_part( $template_name, $part_name = null, $args = [] ) {
	ob_start();
	get_template_part( $template_name, $part_name, $args );
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

function get_post_text($post_content) : string {
    $blocks = parse_blocks($post_content);
    foreach ($blocks as $block) {
        if ($block["blockName"] === "acf/text-content") {
            return strip_tags($block["attrs"]["data"]['content'], '<br>');
        }
    }
}

