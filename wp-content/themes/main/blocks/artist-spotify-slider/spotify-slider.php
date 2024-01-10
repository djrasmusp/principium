<?php

/**
 * Block Name: Spotify Slider
 *
 * Description:
 *
 * @var array $block
 * @var array $context
 * @var boolean $is_preview
 */

if (!class_exists('BLOCK_ARTIST_SLIDER')) {
    class BLOCK_SPOTIFY_SLIDER extends Blocks
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

        public function block_template(): void
        {
            if (count($this->get_tracks()) > 0) : ?>
                <section class="<?= $this->get_class_name() ?>" id="<?= $this->get_id() ?>"
                         itemtype="https://schema.org/ItemList https://schema.org/CreativeWork">
                    <meta itemprop="byArtist" itemscope itemtype="https://schema.org/MusicGroup"
                          content="<?= $this->post->post_title ?>">
                    <link itemprop="itemListOrder" href="https://schema.org/ItemListUnordered">
                    <meta itemprop="numberOfItems" content="<?= count($this->get_tracks()) ?>">
                    <div <?= ($this->is_grid() ? '' : 'class="splide"') ?>" aria-label="<?= $this->get_block_title() ?>">
                        <?php get_template_part('partials/parts/header', 'artist', array('title' => $this->get_block_title(), 'buttons' => !$this->is_grid())) ?>
                        <div <?= ($this->is_grid() ? '' : 'class="splide__track"') ?>>
                            <ul class="<?= ($this->is_grid() ? 'relative grid px-6 py-16 lg:px-16 grid-cols-2 lg:grid-cols-4 gap-6 overflow-hidden' : 'splide__list') ?>">
                                <?php foreach ($this->get_tracks() as $track) : ?>
                                    <li class="splide__slide" itemprop="itemListElement" itemscope
                                        itemtype="https://schema.org/ListItem">
                                        <article itemprop="item" itemscope itemtype="https://schema.org/MusicRecording">
                                            <div class="relative aspect-square w-full group overflow-hidden">
                                                <img src="<?= $track->album->images[0]->url ?>"
                                                     class="absolute inset-0 object-cover w-full h-full z-0 transition-all scale-100 duration-450 group-focus-within:brightness-50 <?= ($track->preview_url) ? 'group-hover:scale-110 group-[.pause]:scale-110 group-hover:brightness-50 group-[.pause]:brightness-50' : '' ?>"
                                                     loading="lazy" alt="<?= $track->name ?> Album cover"
                                                     itemprop="image">
                                                <div class="relative inset-0 flex h-full w-full">
                                                    <?php if ($track->preview_url) : ?>
                                                        <button type="button"
                                                                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 block size-16 transition duration-450 opacity-40 group-hover:opacity-100 group-[.pause]:opacity-100 focus-visible:opacity-100 focus-visible:outline-0 touch-manipulation umami--click--music-<?= sanitize_title($track->name) ?>"
                                                                data-audio="<?= $track->preview_url ?>"
                                                                title="<?= sprintf(__('Lyt til %s af %s', 'main-theme'), $track->name, implode(', ', array_column($track->artists, 'name'))) ?>"
                                                                aria-label="Play">
                                                            <img src="<?= THEME_ICONS ?>/play.svg" class="injectable pointer-events-none size-16 fill-zinc-50 group-[.pause]:hidden">
                                                            <img src="<?= THEME_ICONS ?>/pause.svg" class="injectable pointer-events-none hidden h-16 w-16 fill-zinc-50 group-[.pause]:block">
                                                        </button>
                                                    <?php endif; ?>
                                                    <a class="absolute bottom-4 right-4 drop-shadow-md rounded-full focus-visible:outline focus-visible:outline-2 focus-visible:outline-white" title="<?= sprintf(__('Lyt til %s af %s', 'main-theme'), $track->name, implode(', ', array_column($track->artists, 'name'))) ?>" href="<?= $track->external_urls->spotify ?>" target="_blank"><img src="<?= THEME_ICONS ?>/spotify.svg" class="injectable size-4 fill-spotify"></a>
                                                </div>
                                            </div>
                                            <h3 class="relative my-4 text-center text-xs md:text-sm uppercase font-header line-clamp-2 text-page-text"
                                                itemprop="name"><?= $track->name ?></h3>
                                            <span itemprop="byArtist" itemscope itemtype="https://schema.org/MusicGroup"
                                                  class="sr-only">
                                                    <span itemprop="name"><?= $this->post->post_title ?></span>
                                            </span>
                                        </article>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </section>
            <?php endif;
        }

        protected function get_tracks(): array
        {
            return get_post_meta($this->post_id, 'spotify_tracks', true) ?: [];
        }

        protected function is_grid() : bool {
            return (get_field('list_type') == 'grid');
        }

        protected function get_block_title(): string
        {
            return get_field('title') ?: __('Musik', 'main-theme');
        }
    }
}

new BLOCK_SPOTIFY_SLIDER($block, $context, $is_preview);
