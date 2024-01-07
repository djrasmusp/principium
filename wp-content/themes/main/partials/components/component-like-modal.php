<?php global $post ?>
<div x-bind="modal"
     role="dialog"
     aria-modal="true"
     x-id='["modal-title"]'
     :aria-labelledby="$id('modal-title')"
     class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
    <div x-bind="overlay" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>
    <div
            x-bind="panel" x-transition
            class="relative flex min-h-screen items-center justify-center"
    >
        <div
                x-on:click.stop
                x-trap.noscroll.inert="$store.like_modal"
                class="relative w-full max-w-lg overflow-y-auto rounded-lg bg-primary-400 p-4 py-8 shadow-lg">

            <h2 class="text-h4 font-bold text-center" :id="$id('modal-title')"><?= __('Tak for din feedback', 'mindhelper-gl') ?></h2>
            <p class="mt-4 text-gray-900 text-center" x-bind="action_header"><?= __('Fortæl os gerne, hvorfor du pegede
                tommeltotten op.', 'mindhelper-gl') ?></p>
            <div x-data="feedbackForm">
                <form class="mt-8 flex flex-col items-center justify-center space-y-4 rw"
                      @submit.prevent="submitForm">
                    <textarea name="message"
                              class="w-full rounded-xl min-h-[100px] border border-gray-300 focus:outline-0 focus:outline-transparent focus:ring-2 focus:ring-primary-700 focus:ring-offset-2 focus:ring-offset-primary-400"
                              required></textarea>
                    <input type="hidden" name="post_id" value="<?= $post->ID ?>">
                    <button type="submit" class="btn dark" :disabled="formLoading">
                        <div>
                            <span><?= __( 'Send kommentar', 'mindhelper-gl' ) ?></span>
                            <img src="<?= THEME_ICONS ?>/arrow.svg" class="injectable">
                        </div>
                    </button>
                    <div x-show="formSent"><?= __('Tak for din feedback.', 'mindhelper-gl' ) ?></div>
                </form>
            </div>

            <button type="button"
                    class="absolute top-4 right-4 rounded-full focus:outline-0 focus:outline-transparent focus:ring-2 focus:ring-primary-700 focus:ring-offset-4 focus:ring-offset-primary-400"
                    x-on:click="$store.like_modal = false">
                <img src="<?= THEME_ICONS ?>/close.svg" class="injectable w-6 h-6 pointer-events-none">
            </button>
        </div>
    </div>
</div>