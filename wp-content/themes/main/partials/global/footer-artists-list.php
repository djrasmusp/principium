<?php
$artists = get_posts(array(
    'post_type' => 'artist',
    'posts_per_page' => -1,
    'meta_query' => array(
        'hide_artist' => array(
            'key' => 'hide_artist',
            'value' => 1,
            'compare' => '!='
        ),
        'hide_artist_on_en' => (get_locale() === 'da_DK') ? [] : [
            'key' => 'hide_artist_on_en_site',
            'value' => '1',
            'compare' => "!="
        ],
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
            aria-label="<?= __('Artister', 'main-theme') ?>">
            <?php foreach ($artists as $artist) : ?>
                <li class="text-center lg:text-left text-sm tracking-widest font-header uppercase" itemscope itemtype="http://schema.org/MusicGroup">
                    <a
                            href="<?= get_permalink($artist) ?>"
                            title="<?= sprintf(__('Booking af %s', 'main-theme'), $artist->post_title) ?>"
                            itemprop="url"
                            class="text-zinc-400 transition-all hover:bg-zinc-50 hover:text-darkgrey ring-4 ring-transparent hover:ring-zinc-50 focus-visible:bg-zinc-50 focus-visible:text-darkgrey focus-visible:outline-0 focus-visible:ring-zinc-50">
                        <span itemprop="name"><?= sprintf(__('Booking af %s', 'main-theme'), $artist->post_title) ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>
