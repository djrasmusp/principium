
    <div x-show="show_modal"
         role="dialog"
         aria-modal="true"
         x-id='["modal-title"]'
         :aria-labelledby="$id('modal-title')"

         class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
        <div x-show="show_modal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div
                x-show="show_modal" x-transition
                class="relative flex min-h-screen items-center justify-center px-4 pt-8 pt-9"
        >
            <div
                    x-on:click.stop
                    x-trap.noscroll.inert="show_modal"
                    class="relative w-full max-w-2xl overflow-y-auto rounded-lg bg-primary-300 p-4 shadow-lg"
            >
	            <?php if ( is_user_logged_in() ) : ?>
		            <?php get_template_part( 'user-templates/parts/part', 'notification-form' ) ?>
                <?php else : ?>
                    <div x-data="{ create_user : true }" class="w-full lg:max-w-xl lg:w-134 mx-auto">
			            <?php get_template_part('partials/global/user/login') ?>
			            <?php get_template_part('partials/global/user/create') ?>
                    </div>
                <?php endif; ?>
                <button type="button"
                        class="absolute top-4 right-4 rounded-full focus:outline-0 focus:outline-transparent focus:ring-2 focus:ring-primary-700 focus:ring-offset-4 focus:ring-offset-primary-400"
                        x-on:click="show_modal = false">
                    <img src="<?= THEME_ICONS ?>/close.svg" class="injectable w-6 h-6 pointer-events-none">
                </button>
            </div>
        </div>
    </div>