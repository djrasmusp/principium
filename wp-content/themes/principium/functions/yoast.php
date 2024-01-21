<?php

add_filter("wpseo_metadesc", function ($meta, $presentation) {

    if (class_exists('TRP_Translate_Press')) {
        $trp = TRP_Translate_Press::get_trp_instance();
        $translate = $trp->get_component('translation_render');
    }

    if ($meta) {
        return $meta;
    }

    global $post;

    $blocks = parse_blocks($post->post_content);

    if ($presentation->model->object_sub_type == "artist") {
        foreach ($blocks as $block) {
            if ($block["blockName"] === "acf/artist-content") {
                if (class_exists('TRP_Translate_Press')) {
                    $string = apply_filters('the_content', $block["attrs"]["data"]['content']);
                    $translation = $translate->translate_page($string);
                    return $translation;
                }

                return $block["attrs"]["data"]['content'];
            }
        }
    }

    if ($presentation->model->object_sub_type == 'post') {
        foreach ($blocks as $block) {
            if ($block["blockName"] === "acf/text-content") {
                if (class_exists('TRP_Translate_Press')) {
                    $string = apply_filters('the_content', $block["attrs"]["data"]['content']);
                    $translation = $translate->translate_page($string);
                    return $translation;
                }

                return $block["attrs"]["data"]['content'];
            }
        }
    }

    if ($presentation->model->object_sub_type == 'page') {
        if(get_option('page_for_posts') == get_queried_object()->ID){
            return $meta;
        }
        foreach ($blocks as $block) {
            if ($block["blockName"] === "acf/text-content") {
                if (class_exists('TRP_Translate_Press')) {
                    $string = apply_filters('the_content', $block["attrs"]["data"]['content']);
                    $translation = $translate->translate_page($string);
                    return $translation;
                }

                return $block["attrs"]["data"]['content'];
            }
        }
    }

    return $meta;
},
    10, 2);

add_filter('wpseo_add_opengraph_images', function($images){
    if (!has_post_thumbnail() && $default_image_id = get_field('open_graph_default_image', 'option')) {

        $images->add_image_by_id($default_image_id);
    }


    return $images;
}, 2, 1);


