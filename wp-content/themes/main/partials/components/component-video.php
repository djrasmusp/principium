<?php
    global $post;
    $vimeo_id = ( isset( $args['vimeo_id'] ) ) ? $args['vimeo_id'] : false;
    $lesson   = ( isset( $args['lesson'] ) ) ? $args['lesson'] : false;
?>
<div>
    <div class="relative aspect-video bg-primary-50" x-data="videoPlayer()">
        <button type="button" x-show="!playerLoaded"
                class="absolute inset-0 z-10 flex w-full items-center justify-center bg-primary-300 group transition opacity-100 duration-300"
                @click="loadPlayer">
            <img src="<?= get_video_poster( $vimeo_id ) ?>"
                 class="pointer-events-none absolute inset-0 z-0 h-full w-full object-cover opacity-100 transition-opacity duration-300 ease-in-out group-hover:opacity-80 group-focus:opacity-80">
            <div class="pointer-events-none relative z-10 rounded-full p-3 bg-primary-900 group-focus:border-2 group-focus:border-white group-focus:ring-2 group-focus:ring-gray-900">
                <img src="<?= THEME_ICONS ?>/play-fill.svg"
                     class="h-8 w-8 injectable fill-primary-50 translate-x-0.5">
                <span class="sr-only"><?= __('Play', 'mindhelper-gl') ?></span>
            </div>
        </button>
        <div x-ref="vimeoPlayer"
             class="vimeo_video_container"
             x-show="playerLoaded"
             data-vimeo-defer
             data-vimeo-id="<?= $vimeo_id ?>"

             data-plausible-type="<?= $post->post_type ?>"
             data-plausible-title="<?= $post->post_title ?>"
             data-post-id="<?= $post->ID ?>"
            <?= ($post->post_type == 'course') ? 'data-plausible-course="'. get_course_number(get_course_id($post->ID)) .'"' : '' ?>
	        <?= ($post->post_type == 'course') ? 'data-plausible-module="'. get_course_number($post->post_parent) .'"' : '' ?>
	        <?= ($post->post_type == 'course') ? 'data-plausible-lesson="'. get_course_number($post->ID) .'"' : '' ?>
        ></div>
    </div>
</div>