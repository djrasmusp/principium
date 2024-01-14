<?php
$item = $args['artist'];
$delay_in_ms = $args['delay_in_ms'];
$count = $args['count'];
$terms = get_the_terms($item->ID, 'artist_type');
$term_list = wp_list_pluck($terms, 'name');
?>
<a href="<?= get_permalink($item->ID) ?>"
   class="relative h-1/3 <?= ($count > 6) ? '' : 'lg:h-[50dvh]' ?> overflow-hidden focus-visible:z-50 focus-visible:outline-8 focus-visible:outline-offset-4 focus-visible:ring-4 focus-visible:ring-darkgrey focus-visible:outline-darkgrey transition-all group duration-300 focus-visible:duration-0 umami--click--<?= $item->post_name ?>"
   data-aos="fade-down"
   data-aos-duration="400"
   data-aos-delay="<?= $delay_in_ms ?>"
   data-aos-easing="ease-in-out"
   data-aos-offset="10"
   data-aos-anchor="center-center">
    <div class="absolute bottom-2 right-2 left-2 z-10">
    <?php if($terms) : ?>
        <ul class="flex flex-wrap gap-2 mb-2" aria-hidden="true">
            <?php foreach ($term_list as $term_name) : ?>
                <li class="px-2 py-0.5 text-sm font-medium text-white bg-zinc-900/20 rounded-sm ease-out lg:opacity-0 group-hover:opacity-100 group-focus-visible:opacity-100 transition delay-0 group-hover:delay-200 duration-300"><?= $term_name ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <h2 class="text-xl uppercase tracking-widest text-current group-focus-visible:text-white drop-shadow-md transition-all duration-300 group-focus-visible:duration-300 ease-in font-header text-white group-focus-visible:text-stroke-transparent group-hover:text-stroke-transparent group-hover:text-white lg:text-stroke-2 lg:right-6 lg:bottom-6 lg:left-6 lg:text-4xl lg:text-transparent lg:text-stroke-white">
        <?= $item->post_title ?>
    </h2>
    </div>
    <div class="h-full group-focus-visible:brightness-75 brightness-100 transition duration-300 ease-in-out group-hover:brightness-75">
        <?= get_the_post_thumbnail($item->ID, 'large', array('class' => 'overflow-hidden absolute inset-0 object-cover w-full h-full scale-100 transition-transform duration-300 group-hover:scale-110 group-focus-visible:scale-110')) ?>
    </div>
</a>