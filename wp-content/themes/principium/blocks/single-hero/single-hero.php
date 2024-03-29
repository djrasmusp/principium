<?php
  /**
   * Block Name: Single Hero
   *
   * Description:
   *
   * @var array $block
   * @var array $context
   * @var boolean $is_preview
   */

if(!class_exists('BLOCK_SINGLE_HERO')) {
    class BLOCK_SINGLE_HERO extends Blocks
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
            <section class="<?= $this->get_class_name() ?> h-5/6 mb-8 lg:mb-16" id="<?= $this->get_id() ?>">
                <div class="block relative w-full overflow-hidden <?= ($this->is_preview) ? 'h-5/6' : 'h-5/6 min-h-screen-ios' ?>">
                    <div class="absolute flex lg:flex-row flex-col-reverse justify-between w-full items-center bottom-0 left-0 z-10">
                        <header class="min-h-1/6 py-8 w-full lg:max-w-fit bg-header-bg flex flex-col justify-center" data-aos="slide-right"
                                data-aos-duration="700" data-aos-once="true" data-aos-easing="ease-in-out-sine">
                            <time datetime="<?= date_i18n('c', strtotime($this->post->post_date)) ?>" class="text-xs px-8 lg:px-16 uppercase text-header-text font-header"><?= date_i18n('d. M Y', strtotime($this->post->post_date)) ?></time>
                            <h1 class="w-full max-w-3xl lg:max-w-5xl text-xl md:text-[2rem]/[1.25] md:py-[1rem] text-pretty text-left px-8 lg:text-left tracking-[0.4rem] lg:px-16 uppercase block text-header-text font-header"
                                itemprop="name"><?= $this->post->post_title ?></h1>
                        </header>
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

            return get_the_post_thumbnail( $this->post_id, 'full', array( 'class' => 'relative inset-0 object-cover w-full h-full z-0', 'alt' => $this->get_title(), 'itemprop' => 'image' ) );
        }
    }
}

new BLOCK_SINGLE_HERO( $block, $context, $is_preview );
  