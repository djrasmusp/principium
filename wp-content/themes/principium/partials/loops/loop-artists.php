<div class="grid grid-cols-2 md:grid-cols-3 grid-flow-row">
    <?php

    $sorting = (isset($args['random']) && $args['random']) ? array('sorting' => 'ASC', 'rand' => 'rand') : array('title' => 'ASC');

    $delay_in_ms = 0;
    $counter = 1;

    $artists = get_posts(
        array(
            'post_type' => 'artist',
            'posts_per_page' => -1,
            'meta_query' => array(
                'hide_artist' => array(
                    'key' => 'hide_artist',
                    'value' => 1,
                    'compare' => '!='
                ),
                "hide_artist_on_en" => (get_locale() === 'da_DK') ? [] : [
                    'key' => 'hide_artist_on_en_site',
                    "value" => '1',
                    "compare" => "!="
                ],
                'sorting' => array(
                    'key' => 'sorting',
                    'compare' => 'EXISTS'
                )
            ),
            'orderby' => $sorting,
        )
    );

    foreach ($artists as $key => $artist) : ?>
        <?php get_template_part('partials/loops/items/item', 'artist', array(
            'artist' => $artist,
            'delay_in_ms' => $delay_in_ms,
            'count' => count($artists),
        )) ?>
        <?php
        $delay_in_ms = $delay_in_ms + 100;
        $counter++; ?>
    <?php endforeach; ?>
</div>