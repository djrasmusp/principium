<?php
/**
 * Block Name: Artist Content
 *
 * Description:
 *
 * @var array $block
 * @var array $context
 * @var boolean $is_preview
 * @var WP_Post $post
 */

if (!class_exists('BLOCK_ARTIST_CONTENT')) {
    class BLOCK_ARTIST_CONTENT extends Blocks
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
            ?>
            <section class="<?= $this->get_class_name() ?>" id="<?= $this->get_id() ?>">
                <article class="relative z-10 block">
                    <div class="flex flex-col lg:flex-row">
                        <div class="w-full max-w-5xl px-6 py-6 leading-loose prose border-r border-darkgrey/5 lg:px-16 lg:py-16"
                             itemprop="mainEntityOfPage">
                            <?= get_field('content') ?>
                        </div>
                        <div class="flex h-full w-full flex-col divide-y divide-darkgrey/5">
                            <?php if (wp_get_theme()->get('Name') == 'The Night') :  ?>
                                <div class="flex-1 pt-6 pr-6 pb-6 pl-6 lg:pr-auto lg:pt-16 lg:pb-16 lg:pl-16">
                                    <h2 class="text-2xl uppercase font-header tracking-full max-w-sm"><?= sprintf(__('Booking af %s', 'main-theme'), $this->post->post_title) ?></h2>
                                    <ul class="mt-8 flex flex-col gap-4 lg:mt-8">
                                        <li>
                                            <button type="button"
                                                    class="block lg:inline-flex w-full lg:w-auto gap-2 transition-all duration-300 items-center rounded-sm text-center py-4 px-8 bg-darkgrey hover:bg-black text-zinc-50 font-header uppercase tracking-widest outline outline-2 outline-transparent outline-offset-4 hover:outline-darkgrey focus-visible:outline-darkgrey booking_btn umami--click--<?= $this->post->post_name ?>-go-to-booking-form">
                                                Book <?= $this->post->post_title ?></button>
                                        </li>
                                        <?php if ($presskit = get_field('presskit')) : ?>
                                            <li>
                                                <a href="<?= $presskit ?>" target="_blank"
                                                   class="flex lg:inline-flex w-full lg:w-auto gap-2 items-center justify-center text-center py-4 px-8 bg-transparent border border-zinc-300 hover:border-zinc-400 text-zinc-700 font-header uppercase tracking-widest group transition-all duration-300 focus-visible:outline-4 focus-visible:outline-zinc-400 umami--click--<?= $this->post->post_name ?>-presskit"
                                                   data-no-translation-href>
                                                    <span class="text-xs"><?= __('Download pressekit', 'main-theme') ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <div class="flex-1 pt-16 pb-16 pl-16 lg:block">
                                <ul>
                                    <?php if ($social_medias = get_field('medias')): ?>
                                        <li class=" mb-4">
                                            <div class="bg-darkgrey text-zinc-50 text-2xl uppercase leading-relaxed font-header inline outline outline-[12px] outline-darkgrey tracking-full">
                                                <span><?= __('Social Medier', 'main-theme') ?></span>
                                            </div>
                                        </li>
                                        <?php foreach ($social_medias as $media) :
                                            if (!empty($media['media'])) : ?>
                                                <li>
                                                    <a itemprop="url" href="<?= $media['media']['url'] ?>"
                                                       target="_blank"
                                                       title="<?= get_the_title() ?>'s <?= $media['media']['title'] ?>"
                                                       class="inline-block transition-all leading-none group bg-transparent hover:bg-darkgrey outline outline-transparent outline-offset-0 focus-visible:outline-offset-0 hover:outline-darkgrey focus-visible:outline-darkgrey focus-visible:bg-darkgrey umami--click--<?= $this->post->post_name ?>-some-<?= $media['media']['title'] ?>"
                                                       data-no-translation-href>
                                                        <span class="text-2xl uppercase leading-relaxed font-header tracking-full group-hover:text-zinc-50 group-focus-visible:text-zinc-50"><?= $media['media']['title'] ?></span>
                                                    </a>
                                                    <meta itemprop="sameAs" content="<?= $media['media']['url'] ?>">
                                                </li>
                                            <?php endif;
                                        endforeach; ?>
                                    <?php endif; ?>

                                    <?php if ($music_providers = get_field('music_providers')): ?>
                                        <li class="mt-16 mb-4">
                                            <div class="bg-darkgrey text-zinc-50 text-2xl uppercase leading-relaxed font-header inline outline outline-[12px] outline-darkgrey tracking-full">
                                                <span><?= __('Musik', 'main-theme') ?></span>
                                            </div>
                                        </li>
                                        <?php foreach ($music_providers as $provider) :
                                            if (!empty($provider['media'])) : ?>
                                                <li>
                                                    <a itemprop="url" href="<?= $provider['media']['url'] ?>"
                                                       target="_blank"
                                                       title="<?= get_the_title() ?>'s <?= $provider['media']['title'] ?>"
                                                       class="inline-block transition-all leading-none group bg-transparent hover:bg-darkgrey outline outline-transparent outline-offset-0 focus-visible:outline-offset-0 hover:outline-darkgrey focus-visible:outline-darkgrey focus-visible:bg-darkgrey umami--click--<?= $this->post->post_name ?>-some-<?= $media['media']['title'] ?>"
                                                       data-no-translation-href>
                                                        <span class="text-2xl uppercase leading-relaxed font-header tracking-full group-hover:text-zinc-50 group-focus-visible:text-zinc-50"><?= $provider['media']['title'] ?></span>
                                                    </a>
                                                    <meta itemprop="sameAs" content="<?= $provider['media']['url'] ?>">
                                                </li>
                                            <?php endif;
                                        endforeach; ?>
                                    <?php endif; ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
            <?php
        }
    }
}

new BLOCK_ARTIST_CONTENT($block, $context, $is_preview);
  