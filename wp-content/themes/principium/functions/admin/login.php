<?php

add_filter('login_headerurl', function ($url){
    return home_url();
});

add_filter('login_headertext', function ($text){
    return get_bloginfo('name');
});