<?php
$artists = get_posts(array(
    'post_type' => 'artist',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'geo-location',
            'field' => 'slug',
            'terms' => get_locale()
        ),
    ),
    'meta_query' => array(
        'hide_artist' => array(
            'key' => 'hide_artist',
            'value' => 1,
            'compare' => '!='
        ),
        'sorting' => array(
            'key' => 'sorting',
            'compare' => 'EXISTS'
        )
    ),
    'orderby' => array('title' => 'ASC'),
)); ?>
<div class="lg:basis-2/5">
    <?php if (count($artists) > 0) : ?>
    <nav>
        <ul class="grid grid-cols-1 lg:grid-cols-2 gap-y-4 gap-x-8"
            role="list"
            aria-label="<?= __('Artist Roster', 'main-theme') ?>">
            <?php foreach ($artists as $artist) : ?>
                <li class="text-center lg:text-left text-sm tracking-widest font-header uppercase" itemscope itemtype="http://schema.org/MusicGroup">
                    <a
                            href="<?= get_permalink($artist) ?>"
                            title="<?= sprintf(__('Book %s', 'main-theme'), $artist->post_title) ?>"
                            itemprop="url"
                            class="text-zinc-400 transition-all hocus:bg-zinc-50 hocus:text-darkgrey ring-4 ring-transparent hocus:ring-zinc-50 focus-visible:outline-0">
                        <span itemprop="name"><?= sprintf(__('Book %s', 'main-theme'), $artist->post_title) ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>
