<?php
/**
 * Block Name: Article Grid
 *
 * Description:
 *
 * @var array $block
 * @var array $context
 * @var boolean $is_preview
 */

if (!class_exists('BLOCK_ARTICLE_GRID')) {
    class BLOCK_ARTICLE_GRID extends Blocks
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
            <section class="<?= $this->get_class_name() ?> bg-article-grid pb-16" id="<?= $this->get_id() ?>">
                <div class="article-grid container grid grid-cols-1 gap-8 lg:gap-16 lg:py-8 lg:grid-cols-2">
                    <?php foreach ($this->get_posts() as $post) : ?>
                        <article class="relative article-grid-item">
                            <div class="relative w-full">
                                <?= get_the_post_thumbnail($post->ID, 'large', ['class' => 'px-6 lg:px-16 h-96 mx-auto w-auto relative z-10']) ?>
                            </div>
                            <div class="relative z-10 px-6 py-6 lg:py-10 rounded-b-4xl bg-primary-900 min-h-maxpb-10">
                                <h2 class="mb-10 px-4 text-white text-h3 lg:h-[7ch] xl:h-[5ch]"><?= $post->post_title ?></h2>
                                <div>
                                    <a href="<?= get_permalink($post->ID) ?>"
                                       class="-mr-4 btn tertiary">
                                        <div>
                                            <span><?= __('Læs artiklen') ?></span>
                                            <img src="<?= THEME_ICONS ?>/arrow.svg" class="injectable">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
                <div class="w-full flex justify-center">
                    <a href="<?= get_post_type_archive_link('post') ?>"
                       class="mx-auto mt-8 btn dark">
                        <div>
                            <span>Vis flere artikler</span>
                            <img src="<?= THEME_ICONS ?>/arrow.svg" class="injectable">
                        </div>
                    </a>
                </div>
            </section>
            <?php
        }

        public function get_posts()
        {
            $posts_per_page = get_field('posts_per_page') ?: 2;
            return (new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => $posts_per_page
            ]))->posts;
        }
    }
}

new BLOCK_ARTICLE_GRID($block, $context, $is_preview);

  