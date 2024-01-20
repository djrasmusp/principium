<?php
if (class_exists('TRP_Translate_Press')) :
    $trp = TRP_Translate_Press::get_trp_instance();
    $url_converter = $trp->get_component('url_converter');
    $settings = $trp->get_component('settings');

    $current_lang = $url_converter->get_lang_from_url_string($url_converter->cur_page_url(), false) ?: $settings->get_setting('default-language');

    $languages = trp_custom_language_switcher();
    $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $is_main_entry_url = ($current_lang == $settings->get_setting('default-language'));

    if (!is_admin()) : ?>
        <div class="inset-0 bg-splash-page-bg absolute z-9999 flex flex-col items-center justify-center "
             x-data="{ show_splash_page: $persist(true).using(cookieStorage) }"
             x-show.important="show_splash_page"
             x-trap.inert.noscroll="show_splash_page"
             x-cloak
             x-transition:leave="transition ease-in duration-700 delay-200 origin-top"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="-translate-y-full"
        >
            <button class="-mt-24 h-[480px] w-[480px] focus:outline focus:outline-transparent" title="<?= get_bloginfo( 'name' ) ?>" @click="show_splash_page = false">
                <div class="splash-page"></div>
            </button>
            <ul class="flex justify-between gap-8 item-center splash-page-language-selector" data-no-translation>

                <?php foreach ($languages as $lang) : ?>
                    <li x-data="{ url : '<?= $lang['current_page_url'] ?>', redirect : <?= var_export($lang['current_page_url'] !== $actual_link ) ?>  }">
                        <button class="font-header flex gap-4 items-center text-2xl uppercase text-splash-page-text leading-loose tracking-widest transition-all duration-700 outline outline-2 outline-transparent outline-offset-4 focus-visible:outline-splash-page-text"
                                @click="show_splash_page = false; (redirect) ? window.location = url : '' "
                        >
                            <img src="<?= THEME_ICONS ?>/flag-<?= $lang['short_language_name'] ?>.svg" class="h-6 injectable" loading="lazy" alt="<?= $lang['language_name'] ?> flag">
                            <span><?= $lang['language_name'] ?></span>
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php
    endif;
endif ?>