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

if (!class_exists('BLOCK_PERSONAL')) {
    class BLOCK_PERSONAL extends Blocks
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
            <section class="<?= $this->get_class_name() ?> my-16" id="<?= $this->get_id() ?>">
                <header class="relative h-full overflow-hidden inline-flex items-center">
                    <div class="relative flex items-center h-full">
                        <h3 class="text-xl px-6 lg:text-[2rem] lg:px-0 tracking-wider text-darkgrey lg:ml-16 lg:mr-32 uppercase block font-header"><?= $this->get_title() ?></h3>
                    </div>
                </header>
                <div class="grid gap-8 grid-cols-1 lg:grid-cols-3 mt-8">
                    <?php foreach ($this->get_personal() as $person) :
                        if($person['phone']) {
                            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
                            $phone = $phoneUtil->parse($person['phone'], $person['country_code']);
                        }?>
                        <div>
                            <?= wp_get_attachment_image($person['image'], 'large', false, array('alt' => $person['name'],
                                'class' => 'object-cover w-full aspect-square'
                            )) ?>
                            <div class="relative px-6 lg:px-8 flex flex-col lg:flex-row justify-between items-start gap-x-4">
                                <div>
                                    <h4 class="text-xl font-header uppercase mt-2"><?= $person['name'] ?></h4>
                                    <span class="text-sm text-darkgrey/80"><?= $person['position'] ?></span>
                                    <ul class="flex flex-col  mt-2">
                                        <?php if ($person['phone']) : ?>
                                            <li class="flex gap-1 items-center">
                                                <img src="<?= THEME_ICONS ?>/phone.svg" class="injectable w-3 h-3 fill-zinc-400"/>
                                                <a class="inline-flex gap-x-2 items-center px-2 hover:bg-darkgrey group"
                                                   href="<?= $phoneUtil->format($phone, \libphonenumber\PhoneNumberFormat::RFC3966) ?>"
                                                   data-no-translation-href>
                                                    <span class="uppercase leading-relaxed font-header tracking-wider group-hover:text-zinc-50"><?= $phoneUtil->format($phone, \libphonenumber\PhoneNumberFormat::INTERNATIONAL) ?></span></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($person['whatsapp']) : ?>
                                            <li class="flex gap-1 items-center">
                                                <img src="<?= THEME_ICONS ?>/whatsapp.svg" class="injectable w-4 h-4 fill-zinc-400"/>
                                                <a class="inline-flex gap-x-2 items-center px-2 hover:bg-darkgrey group"
                                                   href="https://wa.me/<?= $person['whatsapp'] ?>" target="_blank" data-no-translation-href>
                                                    <span class="uppercase leading-relaxed font-header tracking-wider group-hover:text-zinc-50"><?= $person['whatsapp'] ?></span></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($person['email']) : ?>
                                            <li class="flex gap-1 items-center">
                                                <img src="<?= THEME_ICONS ?>/e-mail.svg" class="injectable w-3 h-3 fill-zinc-400"/>
                                                <a class="inline-flex gap-x-2 items-center px-2 hover:bg-darkgrey group"
                                                   href="mailto:<?= $person['email'] ?>" data-no-translation-href>
                                                    <span class="uppercase leading-relaxed font-header tracking-wider group-hover:text-zinc-50"><?= $person['email'] ?></span></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div>
                                    <?php if ($person['socials']) : ?>
                                        <ul class="flex gap-x-4 items-start mt-4 mr-2 socials">
                                            <?php foreach ($person['socials'] as $social) : ?>
                                                <li>
                                                    <a href="<?= $social['url'] ?>"
                                                       title="<?= bloginfo('name') ?>'s <?= $social['media'] ?>"
                                                       target="_blank"
                                                       data-no-translation-href>
                                                        <img
                                                                src="<?= THEME_ICONS ?>/<?= $social['media'] ?>.svg"
                                                                class="w-5 h-5 transition-all duration-450 injectable fill-darkgrey">
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php
        }

        protected function get_title()
        {
            return get_field('title');
        }

        protected function get_personal()
        {
            return get_field('personal');
        }
    }
}

new BLOCK_PERSONAL($block, $context, $is_preview);
  