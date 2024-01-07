<?php
$item = $args['artist'];
$delay_in_ms = $args['delay_in_ms'];
$count = $args['count'];
?>
<a href="<?= get_permalink($item->ID) ?>"
   class="relative h-1/3 <?= ($count > 6) ? '' : 'lg:h-[50dvh]' ?> overflow-hidden focus-visible:z-50 focus-visible:outline-8 focus-visible:outline-offset-4 focus-visible:ring-4 focus-visible:ring-darkgrey focus-visible:outline-darkgrey transition-all group duration-300 focus-visible:duration-0 umami--click--<?= $item->post_name ?>"
   data-aos="fade-down"
   data-aos-duration="400"
   data-aos-delay="<?= $delay_in_ms ?>"
   data-aos-easing="ease-in-out"
   data-aos-offset="10"
   data-aos-anchor="center-center">
    <h2 class="absolute right-2 bottom-2 left-2 z-10 text-xl uppercase tracking-widest text-current group-focus-visible:text-zinc-50 drop-shadow-md transition-all duration-300 group-focus-visible:duration-300 ease-in font-header text-stroke-zinc-50 group-focus-visible:text-stroke-transparent group-hover:text-stroke-transparent group-hover:text-zinc-50 lg:text-stroke-2 lg:right-6 lg:bottom-6 lg:left-6 lg:text-4xl lg:text-transparent">
        <?= $item->post_title ?>
    </h2>
    <div class="h-full group-focus-visible:brightness-75 brightness-100 transition duration-300 ease-in-out group-hover:brightness-75">
        <?= get_the_post_thumbnail($item->ID, 'full', array('class' => 'overflow-hidden absolute inset-0 object-cover w-full h-full scale-100 transition-transform duration-300 group-hover:scale-110 group-focus-visible:scale-110')) ?>
    </div>
</a>