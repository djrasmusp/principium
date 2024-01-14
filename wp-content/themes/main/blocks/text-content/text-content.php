<?php
  /**
   * Block Name: Text Content
   *
   * Description:
   *
   * @var array $block
   * @var array $context
   * @var boolean $is_preview
   */


if(!class_exists('BLOCK_TEXT_CONTENT')){
    class BLOCK_TEXT_CONTENT extends Blocks
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
            <section class="<?= $this->get_class_name() ?>" id="<?= $this->get_id() ?>">
                <div class="px-6 md:px-16">
                    <div class="prose <?= $this->get_prose_style() ?> max-w-3xl">
                        <?= get_field('content') ?>
                    </div>
                </div>
            </section>
            <?php
        }
    }
}

new BLOCK_TEXT_CONTENT( $block, $context, $is_preview );
  