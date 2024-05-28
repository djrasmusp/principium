<?php
  /**
   * Block Name: Video
   *
   * Description:
   *
   * @var array $block
   * @var array $context
   * @var boolean $is_preview
   */

if(!class_exists('BLOCK_VIDEO')) {
    class BLOCK_VIDEO extends Blocks
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
            <section class="<?= $this->get_class_name() ?> mt-8" id="<?= $this->get_id() ?>">
                <div class="px-6 md:px-16 max-w-5xl">
                    <?php if($this->get_title()) : ?>
                    <h2 class="text-base mb-4 text-normal text-page-text normal-case font-normal"><?= $this->get_title() ?></h2>
                    <?php endif; ?>
                    <a href="<?= $this->get_video()['url'] ?>#t=0.0001" data-autoplay data-fslightbox class="aspect-square w-full umami--click--video-<?= sanitize_title($this->get_video()['title']) ?>">
                        <div
                                class="relative aspect-video w-full overflow-hidden bg-darkgrey <?= $this->is_preview ? "" : "group" ?>">
                            <video src="<?= $this->get_video()['url'] ?>#t=0.000001" class="absolute inset-0 object-cover w-full h-full z-0 transition-all duration-450 opacity-100 group-hover:scale-110 group-hover:opacity-30"></video>
                            <div class="relative inset-0 flex h-full w-full items-center justify-center">
                                <button type="button"
                                        class="block size-16 opacity-0 group-hover:opacity-100 group-[.pause]:opacity-100 touch-manipulation"
                                        aria-label="Play">
                                    <img src="<?= THEME_ICONS ?>/play.svg" class="injectable pointer-events-none size-16 fill-zinc-50 group-[.pause]:hidden" >
                                    <img src="<?= THEME_ICONS ?>/pause.svg" class="injectable pointer-events-none hidden size-16 fill-zinc-50 group-[.pause]:block" >
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
            </section>
            <?php
        }

        protected function get_title()
        {
            return get_field('title');
        }

        protected function get_video()
        {
            return get_field("video");
        }
    }
}

new BLOCK_VIDEO( $block, $context, $is_preview );
  