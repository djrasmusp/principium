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
                <div class="px-6 lg:px-16 max-w-5xl">
                    <?php if($this->get_title()) : ?>
                    <h2 class="text-base mb-4 lg:text-lg font-header uppercase tracking-widest"><?= $this->get_title() ?></h2>
                    <?php endif; ?>
                    <a href="<?= $this->get_video()['url'] ?>#t=0.0001" data-autoplay data-fslightbox class="aspect-square w-full umami--click--video-<?= sanitize_title($this
                    ->get_video['title']) ?>">
                        <div
                                class="relative aspect-video w-full overflow-hidden bg-darkgrey <?= $this->is_preview ? "" : "group" ?>">
                            <video src="<?= $this->get_video()['url'] ?>#t=0.000001" class="absolute inset-0 object-cover w-full h-full z-0 transition-all duration-450 opacity-100 group-hover:scale-110 group-hover:opacity-30"></video>
                            <div class="relative inset-0 flex h-full w-full items-center justify-center">
                                <button type="button"
                                        class="block h-16 w-16 opacity-0 group-hover:opacity-100 group-[.pause]:opacity-100 touch-manipulation"
                                        aria-label="Play">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                         class="pointer-events-none h-16 w-16 fill-zinc-50 group-[.pause]:hidden">
                                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path
                                                d="M512 256c0 141.4-114.6 256-256 256S0 397.4 0 256S114.6 0 256 0S512 114.6 512 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                         class="pointer-events-none hidden h-16 w-16 fill-zinc-50 group-[.pause]:block">
                                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path
                                                d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM224 192V320v32H160V320 192 160h64v32zm128 0V320v32H288V320 192 160h64v32z"/>
                                    </svg>
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
  