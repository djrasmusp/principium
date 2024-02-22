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
                        <div class="w-full max-w-3xl lg:max-w-5xl lg:border-r px-6 py-6 leading-loose prose lg:divide-page-border md:px-16 md:py-16 <?= $this->get_prose_style() ?>"
                             itemprop="mainEntityOfPage">
                            <?= get_field('content') ?>
                        </div>
                        <div class="flex h-full w-full flex-col lg:divide-y divide-page-border">
                            <?php if (wp_get_theme()->get('Name') == 'The Night') :  ?>
                                <div class="flex-1 pt-6 pr-6 pb-6 pl-6 lg:pr-auto md:pt-16 md:pb-16 md:pl-16">
                                    <h2 class="max-w-sm text-2xl uppercase text-page-text font-header tracking-full"><?= sprintf(__('Book %s', 'main-theme'), $this->post->post_title) ?></h2>
                                    <ul class="mt-8 flex flex-col gap-4 lg:mt-8">
                                        <li>
                                            <button type="button"
                                                    class="block lg:inline-flex w-full lg:w-auto gap-2 transition-all duration-300 items-center rounded-sm text-center py-4 px-8 bg-header-bg hocus:bg-black text-header-text font-header uppercase tracking-widest outline outline-2 outline-transparent outline-offset-4 hocus:outline-page-text booking_btn umami--click--<?= $this->post->post_name ?>-go-to-booking-form">
                                                Book <?= $this->post->post_title ?></button>
                                        </li>
                                        <?php if ($presskit = get_field('presskit')) : ?>
                                            <li>
                                                <a href="<?= $presskit ?>" target="_blank"
                                                   class="flex lg:inline-flex w-full lg:w-auto gap-2 items-center justify-center text-center py-4 px-8 bg-transparent border border-zinc-300 hover:border-zinc-400 text-zinc-700 font-header uppercase tracking-widest group transition-all duration-300 focus-visible:outline-4 focus-visible:outline-zinc-400 umami--click--<?= $this->post->post_name ?>-presskit"
                                                   data-no-translation-href>
                                                    <span class="text-xs"><?= __('Download press kit', 'main-theme') ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <div class="flex-1 pt-16 pb-16 lg:pl-16 lg:block">
                                <ul class="text-center lg:text-left">
                                    <?php if ($social_medias = get_field('medias')): ?>
                                        <li class="mb-4">
                                            <div class="inline text-2xl uppercase leading-relaxed outline bg-header-bg text-header-text font-header outline-[12px] outline-header-bg tracking-full">
                                                <span><?= __('Social Media', 'main-theme') ?></span>
                                            </div>
                                        </li>
                                        <?php foreach ($social_medias as $media) :
                                            if (!empty($media['media'])) : ?>
                                                <li>
                                                    <a itemprop="url" href="<?= $media['media']['url'] ?>"
                                                       target="_blank"
                                                       title="<?= get_the_title() ?>'s <?= $media['media']['title'] ?>"
                                                       class="inline-block px-2 -mx-2 leading-none group bg-transparent text-header-bg hocus:bg-header-bg outline outline-transparent outline-offset-0 focus-visible:outline-offset-0 hocus:outline-header-bg umami--click--<?= $this->post->post_name ?>-some-<?= $media['media']['title'] ?>"
                                                       data-no-translation-href>
                                                        <span class="text-2xl text-header-bg uppercase leading-relaxed group-focus-visible:text-header-text font-header tracking-full group-hover:text-header-text"><?= $media['media']['title'] ?></span>
                                                    </a>
                                                    <meta itemprop="sameAs" content="<?= $media['media']['url'] ?>">
                                                </li>
                                            <?php endif;
                                        endforeach; ?>
                                    <?php endif; ?>

                                    <?php if ($music_providers = get_field('music_providers')): ?>
                                        <li class="mt-16 mb-4">
                                            <div class="inline text-2xl uppercase leading-relaxed outline bg-header-bg text-header-text font-header outline-[12px] outline-header-bg tracking-full">
                                                <span><?= __('Music', 'main-theme') ?></span>
                                            </div>
                                        </li>
                                        <?php foreach ($music_providers as $provider) :
                                            if (!empty($provider['media'])) : ?>
                                                <li>
                                                    <a itemprop="url" href="<?= $provider['media']['url'] ?>"
                                                       target="_blank"
                                                       title="<?= get_the_title() ?>'s <?= $provider['media']['title'] ?>"
                                                       class="inline-block px-2 -mx-2 leading-none group bg-transparent text-header-bg hocus:bg-header-bg outline outline-transparent outline-offset-0 focus-visible:outline-offset-0 hocus:outline-header-bg umami--click--<?= $this->post->post_name ?>-some-<?= $provider['media']['title'] ?>"
                                                       data-no-translation-href>
                                                        <span class="text-2xl text-header-bg uppercase leading-relaxed group-focus-visible:text-header-text font-header tracking-full group-hover:text-header-text"><?= $provider['media']['title'] ?></span>
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
  