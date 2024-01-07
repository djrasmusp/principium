<?php
global $post;
$users_favorites = get_user_meta( get_current_user_id(), '_mh_favorites', true ) ?: [];
$is_favorite     = array_key_exists( $post->ID, $users_favorites );
?>
<div class="isolate" x-data="favorite(<?= $post->ID ?>)">
    <button type="button" :disabled="!user_is_logged_in"
            class="relative inline-flex items-center justify-center rounded-full px-3 py-2 text-sm font-bold gap-x-1.5 hover:bg-primary-800 focus:z-10 focus-visible:ring-2 focus-visible:ring-primary-700 focus-visible:outline-0 focus-visible:ring-offset-2 focus-visible:ring-offset-primary-900 transition-colors duration-300 ease-in-out"
            :class="is_favorite ? 'bg-primary-900 text-primary-400' : 'bg-primary-700 text-primary-100'"
            x-bind="trigger_favorite">
        <img src="<?= THEME_ICONS ?>/star.svg"
             class="injectable h-4 w-4"
        :class="is_favorite ? '!fill-primary-400 !stroke-primary-400' : '!fill-transparent !stroke-primary-100'">
        <span class="leading-[0] mr-1.5" x-bind="text"><?= __( 'Fjern Nuannarinerusat', 'mindhelper-gl' ) ?></span>
    </button>
</div>