<?php

add_filter('acf/update_value/key=field_63ced148cd3cd', 'update_artist_thumbnail', 10, 3);
add_filter('acf/update_value/key=field_659822b5a839d', 'update_artist_thumbnail', 10, 3);

function update_artist_thumbnail($value, $post_id, $field){
    global $post;

    if(is_a($post, 'WP_POST')){
        $post_id = $post->post_parent == 0 ? $post->ID : $post->post_parent;
        set_post_thumbnail($post_id, $value['id']);
        update_post_meta($value['id'], 'focus_point', $value['left'].'% ' .$value['top'].'%');
    }

    return $value;
}

/* Disable thumbnail on POST */
add_action('init','remove_thumbnail_support');
function remove_thumbnail_support(){
    remove_post_type_support('post','thumbnail');
}