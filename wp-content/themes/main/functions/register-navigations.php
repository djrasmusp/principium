<?php

add_action("after_setup_theme", function () {
    register_nav_menu("primary", __("Main Menu", "main-theme"));
    register_nav_menu('footer', __("Footer Menu", "main-theme"));
    register_nav_menu('family', __('i! Familien', 'main-theme'));
});
