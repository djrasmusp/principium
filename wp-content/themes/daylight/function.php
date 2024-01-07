<?php

function fse_child_styles() {
    ray(get_stylesheet_uri());
    wp_enqueue_style( 'fse-child-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'fse_child_styles' );