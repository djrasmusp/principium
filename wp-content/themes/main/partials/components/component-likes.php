<?php global $post; ?>
<div x-data="likes">
    <div class="isolate inline-flex rounded-full">
        <button type="button"
                class="relative inline-flex items-center  rounded-l-full px-3 py-2.5  focus:z-10 focus-visible:ring-2 focus-visible:ring-primary-700 focus-visible:outline-0 focus-visible:ring-offset-2 focus-visible:ring-offset-primary-900"
                :class="is_thumbsup ? 'bg-alerts-success-100' : 'bg-primary-700 hover:bg-primary-800'"
                x-bind="trigger_likes"
                data-action="thumbs-up"
                data-title="<?= $post->post_title ?>"
                data-type="<?= $post->post_type ?>"
                title="<?= __( 'Synes godt om' ) ?>">
            <img src="<?= THEME_ICONS ?>/thumbs-up.svg" class="injectable h-3 w-3"
                 :class="is_thumbsup ? '!stroke-alerts-success-900' : 'stroke-primary-100'">
            <span class="sr-only"><?= __( 'Synes godt om', 'mindhelper-gl' ) ?></span>
        </button>
        <div class="bg-primary-700">
            <div class="my-1 border-r-1 h-[calc(100%-theme(spacing.2))] border-r border-primary-100">
            </div>
        </div>
        <button type="button"
                x-bind="trigger_likes"
                data-action="thumbs-down"
                data-title="<?= $post->post_title ?>"
                data-type="<?= $post->post_type ?>"
                title="<?= __( 'Synes ikke godt om' ) ?>"
                class="relative inline-flex items-center rounded-r-full px-3 py-2.5 text-gray-900 focus:z-10 focus-visible:ring-2 focus-visible:ring-primary-700 focus-visible:outline-0 focus-visible:ring-offset-2 focus-visible:ring-offset-primary-900"
                :class="is_thumbsdown ? 'bg-alerts-error-100' : 'bg-primary-700 hover:bg-primary-800' ">
            <img src="<?= THEME_ICONS ?>/thumbs-down.svg" class="injectable h-3 w-3"
                 :class="is_thumbsdown ? '!stroke-alerts-error-900' : 'stroke-primary-100'">
            <span class="sr-only"><?= __( 'Synes ikke godt om', 'mindhelper-gl' ) ?></span>
        </button>
    </div>
	<?php get_template_part( 'partials/components/component', 'like-modal' ) ?>
</div>
