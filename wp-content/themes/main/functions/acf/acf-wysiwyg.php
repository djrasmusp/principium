<?php

add_filter('acf/fields/wysiwyg/toolbars', function ($toolbars) {
    global $post;


    if ($post === null || $post->post_type !== 'page') {
        return $toolbars;
    }

    $list_removed_keys = array(13, 12, 11, 6, 7, 8, 5, 10);

    foreach ($list_removed_keys as $key) {
        unset($toolbars['Full'][1][$key]);
    }

        return $toolbars;
});

add_filter('tiny_mce_before_init', function ($array) {

    $array['formats'] = json_encode(array(
        'qoute' => array(
            'selector' => 'q',
            'inline' => 'q',
        ),
        'highlight_testimonial' => array(
            'selector' => 'span',
            'classes' => 'highlighed_testimonial',
            'inline' => 'span',
            'wrapper' => true,
        ),
    ));

    $block_formats = [
        'Paragraph=p',
        'Heading 2=h2',
        'Heading 3=h3',
        'Heading 4=h4',
        'Heading 5=h5',
        'Heading 6=h6',
    ];

    $array['block_formats'] = implode(';', $block_formats);

    return $array;
});

add_filter('acf/prepare_field', function($field){
    $field_groups = array(
        'group_640b119e00767',
        'group_63e2661b031e5'
    );
    if(in_array($field['parent'], $field_groups) && $field['__key'] === 'field_63e265a3dcaf1' ) {
        $field['media_upload'] = 0;
    }


    return $field;
});