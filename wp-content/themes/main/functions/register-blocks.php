<?php

/* --------- Register Blocks --------- */
add_action('init', function () {
    $blocks = get_blocks_of_directory(get_template_directory() . '/blocks');

    foreach ($blocks as $block) {
        register_block_type($block);
    }
});

/* --------- Register blocks styling to admin backend --------- */
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('custom_blocks_style', get_template_directory_uri() . '/assets/css/blocks.css', array(), wp_get_theme()->get('Version'));
});

/* --------- Register new block category for custom blocks --------- */
add_filter('block_categories_all', function ($categories) {

    $new_category = array(
        'slug' => 'thenight',
        'title' => wp_get_theme()->get('Name') . ' Blocks',
        'icon' => null
    );


    // append new category in front
    array_unshift($categories, $new_category);

    return $categories;
});

function get_blocks_of_directory($dir, $relativePath = false)
{
    $fileList = array();
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isDir()) continue;
        if ($file->getExtension() != 'json') continue;

        $path = $file->getPathname();

        $fileList[] = $path;

    }

    sort($fileList);

    return $fileList;
}

add_filter('allowed_block_types_all', function ($blocks) {

    if (get_field('wp_core_blocks', 'option')) {
        return $blocks;
    }

    $blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();


    $blocks = array_filter($blocks, function ($key) {
        $needles = array('core');
        return strposa($key, $needles) !== 0;
    }, ARRAY_FILTER_USE_KEY);

    return array_keys($blocks);
}, 10);

add_action('init', function () {
    $post_object = get_post_type_object('post');
    $post_object->template =
        array(
        );

    $page_object = get_post_type_object('page');
    $page_object->template =
        array(
        );
});

function strposa(string $haystack, array $needles, int $offset = 0)
{
    foreach($needles as $needle) {
        if($haystack == 'core/block'){
            return false;
        }
        if(strpos($haystack, $needle, $offset) !== false) {
            return 0; // stop on first true result
        }
    }

    return false;
}
