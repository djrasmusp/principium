<?php
  /**
   * Block Name: Artist Hero
   *
   * Description:
   *
   * @var array $block
   * @var array $context
   * @var boolean $is_preview
   */

if(!class_exists('BLOCK_ARTIST_HERO')) {
    class BLOCK_ARTIST_HERO extends Blocks
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
            <section class="<?= $this->get_class_name() ?> h-full" id="<?= $this->get_id() ?>">
                <div class="block relative w-full overflow-hidden <?= ($this->is_preview) ? 'h-full' : 'h-full min-h-screen-ios' ?>">
                    <div class="absolute flex lg:flex-row flex-col-reverse justify-between w-full items-center bottom-0 left-0 z-10">
                        <header class="min-h-1/6 w-full lg:max-w-fit bg-header-bg flex items-center" data-aos="slide-right"
                                data-aos-duration="700" data-aos-once="true" data-aos-easing="ease-in-out-sine">
                            <h1 class="w-full text-[2rem] lg:text-[4rem] text-center lg:text-left tracking-[0.4rem] lg:px-16 uppercase block text-header-text font-header"
                                itemprop="name"><?= $this->post->post_title ?></h1>
                        </header>
                        <div class="lg:mr-16 h-24 lg:h-auto">
                            <?php get_template_part('partials/fragments/fragment', 'arrow') ?>
                        </div>
                    </div>

                    <div class="<?= ($this->is_preview) ? 'bg-zinc-400' : 'sticky' ?> h-screen w-full">
                        <?= $this->get_hero_image() ?>
                    </div>
                </div>
            </section>
            <?php
        }

        protected function get_hero_image(){
            if( $image = get_field('image') ){
                return wp_get_attachment_image(
                    $image['id'],
                    'full',
                    false,
                    array(
                        'class' => 'relative inset-0 w-full h-full z-0 object-cover',
                        'alt' => $this->post->post_title,
                        'itemprop' => 'image',
                        'style' => 'object-position: '. $image['left'] .'% '. $image['top'] .'%')
                );
            }

            return get_the_post_thumbnail( $this->post_id, 'full', array( 'class' => 'relative inset-0 object-cover w-full h-full z-0', 'alt' => $this->post->post_title, 'itemprop' => 'image' ) );
        }
    }
}

new BLOCK_ARTIST_HERO( $block, $context, $is_preview );
  