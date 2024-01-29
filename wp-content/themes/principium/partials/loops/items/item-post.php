<?php
$thumbnail_id = get_post_thumbnail_id($post->ID);
$focus_point = get_field('focus_point', $thumbnail_id) ?? '50% 50%';
?>

<a href="<?= get_permalink($post->ID) ?>"
   class="blog-post relative aspect-square overflow-hidden transition-all group duration-300 focus-visible:z-50 focus-visible:outline-8 focus-visible:outline-offset-4 focus-visible:ring-4 focus-visible:ring-darkgrey focus-visible:outline-darkgrey umami--click--blog-<?= $post->post_name ?>">
    <div class="absolute right-2 bottom-2 left-2 z-20 lg:right-6 lg:bottom-6 lg:left-6">
        <h2 class="text-base uppercase tracking-widest text-white group-hover:text-white transition-all ease-in font-header duration-450 group-hover:text-stroke-transparent line-clamp-3 lg:text-1xl"><?= $post->post_title ?></h2>
        <time datetime="<?= date_i18n('c', strtotime($post->post_date)) ?>"
              class="text-xs uppercase text-zinc-100 font-header"><?= date_i18n('d. M Y', strtotime($post->post_date)) ?></time>
    </div>
    <div class="h-full">
        <div class="absolute inset-0 z-10 bg-gradient-to-t to-transparent from-zinc-950/70 from-10% to-50%"></div>
        <?php if (has_post_thumbnail($post->ID)) : ?>
            <?= get_the_post_thumbnail($post->ID, 'large', array('class' => 'overflow-hidden absolute inset-0 object-cover w-full h-full scale-105 transition brightness-100 duration-300 ease-in group-hover:brightness-90 group-hover:scale-110 group-focus-visible:brightness-90 group-focus-visible:scale-110', 'style' => 'object-position :' . $focus_point )) ?>
        <?php else: ?>
            <div class="block h-full w-full"></div>
        <?php endif; ?>
    </div>
</a>