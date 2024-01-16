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
                        <h3 class="text-xl px-6 md:text-[2rem] md:px-0 tracking-wider text-page-text md:ml-16 md:mr-32 uppercase block font-header"><?= $this->get_title() ?></h3>
                    </div>
                </header>
                <div class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-8 md:gap-y-12">
                    <?php if (have_rows('personal')):
                        while (have_rows('personal')) : the_row();
                            $name = get_sub_field('name');
                            $position = get_sub_field('position');
                            $image = get_sub_field('image');
                            $email = get_sub_field('email');
                            $phone = get_sub_field('phone');
                            $country_code = get_sub_field('country_code');
                            $wechat = get_sub_field('wechat');
                            $socials = get_sub_field('socials');

                            if ($phone) {
                                $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
                                $phone = $phoneUtil->parse($phone, $country_code);
                            } ?>
                            <div>
                                <?= wp_get_attachment_image($image, 'large', false, array('alt' => $name,
                                    'class' => 'object-cover w-full aspect-square'
                                )) ?>
                                <div class="relative px-6 md:px-16 lg:px-8 flex flex-col lg:flex-row justify-between items-start gap-x-4">
                                    <div>
                                        <h4 class="text-xl text-page-text font-header uppercase mt-2"><?= $name ?></h4>
                                        <span class="text-sm text-page-text-downplayed"><?= $position ?></span>
                                        <ul class="flex flex-col  mt-2">
                                            <?php if ($phone) : ?>
                                                <li class="flex gap-1 items-center">
                                                    <img src="<?= THEME_ICONS ?>/phone.svg"
                                                         class="injectable size-3 fill-page-border-highlight"/>
                                                    <a class="inline-flex gap-x-2 items-center px-2 text-page-text hocus:bg-header-bg group"
                                                       href="<?= $phoneUtil->format($phone, \libphonenumber\PhoneNumberFormat::RFC3966) ?>"
                                                       data-no-translation-href>
                                                        <span class="uppercase leading-relaxed font-header tracking-wider group-hover:text-header-text group-focus-visible:text-header-text"><?= $phoneUtil->format($phone, \libphonenumber\PhoneNumberFormat::INTERNATIONAL) ?></span></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if ($wechat) : ?>
                                                <li class="flex gap-1 items-center">
                                                    <img src="<?= THEME_ICONS ?>/wechat.svg"
                                                         class="injectable w-4 h-4 fill-page-border-highlight"/>
                                                    <a class="inline-flex gap-x-2 items-center text-page-text px-2 hocus:bg-header-bg group"
                                                       href="weixin://dl/chat?<?= $wechat ?>" target="_blank"
                                                       data-no-translation-href>
                                                        <span class="uppercase leading-relaxed font-header tracking-wider group-hover:text-header-text group-focus-visible:text-header-text"><?= $person['whatsapp'] ?></span></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if ($email) : ?>
                                                <li class="flex gap-1 items-center">
                                                    <img src="<?= THEME_ICONS ?>/e-mail.svg"
                                                         class="injectable w-3 h-3 fill-zinc-400"/>
                                                    <a class="inline-flex gap-x-2 items-center text-page-text px-2 hocus:bg-header-bg group"
                                                       href="mailto:<?= $email ?>" data-no-translation-href>
                                                        <span class="uppercase leading-relaxed font-header tracking-wider group-hover:text-header-text group-focus-visible:text-header-text"><?= $email ?></span></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div>
                                        <?php if ($socials) : ?>
                                            <ul class="flex gap-x-4 items-start mt-4 mr-2 socials">
                                                <?php foreach ($socials as $social) : ?>
                                                    <li>
                                                        <a href="<?= $social['url'] ?>"
                                                           title="<?= $name ?>'s <?= $social['media'] ?>"
                                                           target="_blank"
                                                           data-no-translation-href>
                                                            <img
                                                                    src="<?= THEME_ICONS ?>/<?= $social['media'] ?>.svg"
                                                                    class="w-5 h-5 transition-all duration-450 injectable fill-page-text">
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                    endif; ?>
                </div>
            </section>
            <?php
        }

        protected function get_title()
        {
            return get_field('title');
        }
    }
}

new BLOCK_PERSONAL($block, $context, $is_preview);
  