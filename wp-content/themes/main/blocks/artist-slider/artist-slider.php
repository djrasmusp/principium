<?php
/**
 * Block Name: Artist Slider
 *
 * Description:
 *
 * @var array $block
 * @var array $context
 * @var boolean $is_preview
 */

if (!class_exists('BLOCK_ARTIST_SLIDER')) {
    class BLOCK_ARTIST_SLIDER extends Blocks
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
        { ?>
        <section class="<?= $this->get_class_name() ?>  <?= ($this->is_preview) ? 'pointer-events-none' : '' ?>"
             id="<?= $this->get_id() ?>">
            <?php get_template_part('partials/parts/header', 'artist', array('title' => __('Artist Roster'), 'type' => 'small')) ?>
            <div class="splide" aria-label="<?= __('Andre artister', 'main-theme') ?>">
                <div class="splide__arrows">
                    <button class="sr-only splide__arrow splide__arrow--prev">
                        Prev
                    </button>
                </div>
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php foreach ($this->get_artists() as $artist) : ?>
                            <li class="relative overflow-hidden splide__slide" itemscope
                                itemtype="https://schema.org/MusicGroup">
                                <a href="<?= get_permalink($artist->ID) ?>"
                                   class="group focus-visible:bg-green-200" itemprop="url">
                                    <h2 class="absolute bottom-2 left-2 right-2 z-10 uppercase text-zinc-50 font-header transition-all tracking-widest duration-300 lg:text-3xl drop-shadow-md"
                                        itemprop="name"><?= $artist->post_title ?></h2>
                                    <div class="relative aspect-square w-full overflow-hidden bg-darkgrey">
                                        <?= get_the_post_thumbnail(
                                            $artist->ID,
                                            'full',
                                            [
                                                'class' => 'absolute inset-0 object-cover w-full h-full z-0 transition-all duration-300 group-hover:duration-500 scale-100 group-hover:scale-110 group-focus-visible:scale-110',
                                                'alt' => $artist->post_title,
                                                'itemprop' => 'image',
                                                'style' => 'object-position: ' . (get_post_meta(get_post_thumbnail_id($artist->ID), 'focus_point', true) ?: '50% 50%')
                                            ]
                                        ) ?>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="splide__arrows">
                    <button class="sr-only splide__arrow splide__arrow--next">
                        Next
                    </button>
                </div>
            </div>
            </section>
            <?php
        }

        public function get_artists()
        {
            $get_artists = get_posts(
                array(
                    'post_type' => 'artist',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        'hide_artist' => array(
                            'key' => 'hide_artist',
                            'value' => 1,
                            'compare' => '!='
                        ),
                        'hide_artist_on_en' => (get_locale() === 'da_DK') ? [] : [
                            'key' => 'hide_artist_on_en_site',
                            'value' => '1',
                            'compare' => "!="
                        ],
                        'sorting' => array(
                            'key' => 'sorting',
                            'compare' => 'EXISTS'
                        )
                    ),
                    'orderby' => array('sorting' => 'ASC', 'rand' => 'rand'),
                )
            );


            return $get_artists;
        }
    }
}

new BLOCK_ARTIST_SLIDER($block, $context, $is_preview);
  