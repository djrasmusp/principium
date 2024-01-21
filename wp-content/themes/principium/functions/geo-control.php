<?php

add_action('init', function () {
    register_taxonomy('geo-location', ['post', 'artist'], array(
        'hierachical' => false,
        'labels' => taxonomy_labels('Geo locationer', 'Geo location'),
        'public' => false,
        'publicly_queryable' => false,
        'meta_box_cb' => false
    ));

});

add_action('init', function () {
    $default_terms = array(
        [
            'name' => 'Dansk',
            'slug' => 'da_DK'

        ],
        [
            'name' => 'English',
            'slug' => 'en_US'

        ],
    );

    foreach ($default_terms as $term) {
        wp_insert_term($term['name'], 'geo-location', array('slug' => $term['slug']));
    }
});

function taxonomy_labels($name, $singular_name): array
{
    return array(
        'name' => __($name, 'main-theme'),
        'singular_name' => __($singular_name, 'main-theme'),
        'search_items' => __('Søg ' . $name, 'main-theme'),
        'popular_items' => __('Populær ' . $name, 'main-theme'),
        'all_items' => __('Alle ' . $name, 'main-theme'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Rediger ' . $singular_name, 'main-theme'),
        'update_item' => __('Opdater' . $singular_name, 'main-theme'),
        'add_new_item' => __('Tilføj ny ' . $singular_name, 'main-theme'),
        'new_item_name' => __('Ny ' . $singular_name . '\'s navn', 'main-theme'),
        'separate_items_with_commas' => __('Adskil ' . $singular_name . ' med kommaer', 'main-theme'),
        'add_or_remove_items' => __('Tilføj eller slet ' . $name, 'main-theme'),
        'choose_from_most_used' => __('Vælg mest brugte ' . $name, 'main-theme'),
        'not_found' => __('Ingen ' . $name . ' Fundet.', 'main-theme'),
        'menu_name' => __($name, 'main-theme'),
    );
}

add_action('pre_get_posts', function ($query) {
    if ($query->is_main_query() && !is_admin() && $query->is_home()) {
        $tax_query = array(
            array(
                'taxonomy' => 'geo-location',
                'field' => 'slug',
                'terms' => get_locale()
            ),
        );

        $query->set('posts_per_page', -1);
        $query->set('tax_query', $tax_query);
   }
});