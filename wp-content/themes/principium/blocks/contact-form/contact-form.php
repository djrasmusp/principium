<?php
/**
 * Block Name: Contact form
 *
 * Description:
 *
 * @var array $block
 * @var array $context
 * @var boolean $is_preview
 */

if (!class_exists('BLOCK_CONTACT_FORM')) {
    class BLOCK_CONTACT_FORM extends Blocks
    {

        public function __construct($block, $context, $is_preview)
        {
            parent::__construct($block, $context, $is_preview);

            $this->render();
        }

        public function render()
        {

            if ($this->has_errors) {
                return $this->error_template();
            } else {
                return $this->block_template();
            }
        }

        public function block_template()
        {
            global $post ?>
            <section class="contact-form-block" id="<?= $this->get_id() ?>">
                <?php get_template_part('partials/parts/header', 'artist', array(
                    'title' => $this->form_header(),
                )) ?>
                <div class="relative z-10 block px-6 py-16 lg:px-16">
                    <form class="grid max-w-3xl grid-cols-1 gap-x-8 gap-y-8 lg:grid-cols-2">
                        <div class="input">
                            <label for="tn-name"><?= __('Name', 'main-theme') ?></label>
                            <div class="mt-2">
                                <input type="text" placeholder="<?= __('Your name', 'main-theme') ?>" name="tn-name"
                                       id="tn-name" class="form-control" required>
                            </div>
                        </div>
                        <?php if ($this->is_booking_page()) : ?>
                            <div class="input">
                                <label for="tn-organizer"><?= __('Organizer', 'main-theme') ?></label>
                                <div class="mt-2">
                                    <input type="text"
                                           placeholder="<?= __('Your organization', 'main-theme') ?>"
                                           name="tn-organizer" id="tn-organizer" class="form-control">
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="input">
                            <label for="tn-email"><?= __('Email', 'main-theme') ?></label>
                            <div class="mt-2">
                                <input type="email" placeholder="<?= __('Your Email', 'main-theme') ?>"
                                       name="tn-email" id="tn-email" class="form-control" required>
                            </div>
                        </div>

                        <div class="input">
                            <label for="tn-phone"><?= __('Phone number', 'main-theme') ?></label>
                            <div class="mt-2">
                                <input type="tel" name="tn-phone"
                                       placeholder="<?= __('Your phone number', 'main-theme') ?>" id="tn-phone"
                                       class="form-control" required>
                            </div>
                        </div>
                        <?php if ($this->is_artist_page()) : ?>
                            <div class="input">
                                <label for="tn-artist"><?= __('Artist', 'main-theme') ?></label>
                                <div class="mt-2">
                                    <input type="text" name="tn-artist" id="tn-artist" readonly
                                           value="<?= $post->post_title ?>">
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->is_booking_page()) : ?>
                            <div class="input">
                                <label for="tn-date"><?= __('Date', 'main-theme') ?></label>
                                <div class="mt-2">
                                    <input type="date" name="tn-date" id="tn-date" min="<?= date_i18n('Y-m-d') ?>"
                                           class="form-control" required>
                                </div>
                            </div>


                            <div class="col-span-full input">
                                <label for="tn-location"><?= __('Location', 'main-theme') ?></label>
                                <div class="mt-2">
                                    <textarea id="tn-location" name="tn-location"
                                              placeholder="<?= __('Where is the event be held?', 'main-theme') ?>"
                                              class="form-control"></textarea>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="col-span-full input">
                            <?php if ($this->is_booking_page()) : ?>
                                <label for="tn-comments"><?= __('Other questions or comments', 'main-theme') ?></label>
                            <?php else : ?>
                                <label for="tn-comments"><?= __('Your inquiry', 'main-theme') ?></label>
                            <?php endif; ?>
                            <div class="mt-2">
                                <textarea id="tn-comments" name="tn-comments" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-span-full input">
                            <div class="flex gap-x-4 items-center justify-items-start flex-wrap">
                                <input type="checkbox" id="tn-dataconsent" name="tn-dataconsent" class="form-control" required>
                                <label for="tn-dataconsent"><?= sprintf(__('I consent to %s storing and processing the personal information I have provided above.', 'main-theme'), get_bloginfo('name')) ?></label>
                            </div>
                        </div>
                        <div class="opacity-0 absolute w-[0px] inset-0 z[-1]">
                            <label for="firstname" aria-hidden="true" class="visually-hidden">firstname <input
                                        name="firstname" type="text" id="firstname" tabindex="-99999"></label>
                            <?= wp_nonce_field('send_contact_form') ?>
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                    class="block lg:inline-flex w-full lg:w-auto gap-2 border border-button-border items-center text-center py-4 px-8 bg-button-bg text-button-text font-header uppercase tracking-[0.1rem] hover:bg-button-bg-highlight focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-menu-text umami--click--<?= $post->psot_name ?>-booking-form">
                                <?= __('Send request', 'main-theme') ?></button>
                            <p class="response mt-4 text-sm font-medium"></p>
                        </div>
                    </form>
                </div>
            </section>
            <?php
        }

        protected function is_booking_page()
        {
            return (in_array(wp_get_theme()->get('Name'), ['The Night']) && $this->post_type == 'artist');
        }

        protected function is_artist_page()
        {
            return ($this->post_type == 'artist');
        }

        protected function form_header()
        {
            if ($this->is_booking_page()) {
                return __('Book', 'main-theme') . ' ' . $this->post->post_title;
            }

            return get_field('title') ?: __('Contact', 'main-theme');
        }
    }
}


new BLOCK_CONTACT_FORM($block, $context, $is_preview);

