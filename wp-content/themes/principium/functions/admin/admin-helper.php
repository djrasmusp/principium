<?php
add_action('admin_bar_menu', function($admin_bar){
    $node = array(
        'id' => 'wp-environment',
        'title' => 'Environment: ' . ucfirst(wp_get_environment_type()),
        'meta' => array(
            'class' => wp_get_environment_type()
        )
    );
    if(wp_get_environment_type() != 'production'){
        $admin_bar->add_node($node);
    }
}, 99);