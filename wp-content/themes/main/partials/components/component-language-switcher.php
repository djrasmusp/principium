<?php
if (class_exists('TRP_Translate_Press')) :
    $trp = TRP_Translate_Press::get_trp_instance();
    $url_converter = $trp->get_component('url_converter');
    $settings = $trp->get_component('settings');

    $languages = trp_custom_language_switcher();
    $current_lang_key = $url_converter->get_lang_from_url_string($url_converter->cur_page_url(), false) ?: $settings->get_setting('default-language');

    $current_language = $languages[$current_lang_key];

    ?>
    <div class="mt-8" x-data="{menuToggle: false}">
        <div class="relative" x-trap.noscroll="menuToggle" @keydown.down="$focus.wrap().next()"
             @keydown.up="$focus.wrap().previous()">
            <button type="button"
                    class="px-4 w-48 h-12 py-2 border-2 border-zinc-300 hover:border-zinc-400 flex gap-2 items-center justify-between text-darkgrey"
                    :class="menuToggle ? '!border-darkgrey' : 'outline outline-2 outline-transparent outline-offset-4 focus-visible:outline-darkgrey focus-visible:border-zinc-400'"
                    @click="menuToggle = !menuToggle">
                <span class="flex gap-2 items-center">
                <img src="<?= THEME_ICONS ?>/flag-<?= $current_language['short_language_name'] ?>.svg" class="h-4" loading="lazy" alt="<?= $current_language['language_name'] ?> flag">
                <span class="uppercase tracking-widest font-medium font-header"><?= $current_language['language_name'] ?></span>
                    </span>
                <svg width="8" height="5" viewBox="0 0 8 5" fill="none" stroke="currentColor" class="ml-4"
                     xmlns="http://www.w3.org/2000/svg">
                    <line x1="3.64645" y1="4.64645" x2="7.64645" y2="0.646447"/>
                    <line x1="0.353553" y1="0.646447" x2="4.35355" y2="4.64645"/>
                </svg>
            </button>
            <div class="absolute w-48 top-4 border-2 border-t-0 rounded-b border-darkgrey mt-8 bg-zinc-100"
                 x-show="menuToggle"
                 @click.outside="menuToggle = false"
                 x-transition:enter="transition ease-out duration-200 origin-top"
                 x-transition:enter-start="scale-y-0"
                 x-transition:enter-end="scale-y-100"
                 x-transition:leave="transition ease-in duration-200 origin-top"
                 x-transition:leave-start="scale-y-100"
                 x-transition:leave-end="scale-y-0">
                <ul>
                    <?php foreach ($languages as $key => $lang) : ?>
                        <li class="first:rounded-tr last:rounded-b w-full group"
                            data-no-translation x-data="{current: <?= var_export(($key == $current_lang_key)) ?>}">
                            <a href="<?= $lang['current_page_url'] ?>"
                               class="px-4 py-2 flex gap-2 items-center min-w-[124px] group-hover:bg-zinc-300 focus-visible:bg-zinc-200 rounded-none">
                                <img src="<?= THEME_ICONS ?>/flag-<?= $lang['short_language_name'] ?>.svg" class="h-4" loading="lazy" alt="<?= $lang['language_name'] ?> flag">
                                <span class="uppercase leading-none tracking-widest font-medium font-header block"><?= $lang['language_name'] ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

<?php
endif; ?>