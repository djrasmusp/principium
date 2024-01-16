<?php

add_filter(
    "acf/blocks/no_fields_assigned_message", function ($message, $name) {
        return false;
    }, 10, 2 );

add_action('init', function () {
    add_role('to_hide_clone_fields', 'To Hide Clone Fields - DONT USE', array('read' => true));
});
