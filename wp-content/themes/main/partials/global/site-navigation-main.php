<?php

use Log1x\Navi\Navi;

$navigation = ( new Navi() )->build( 'primary' ); ?>
<nav class="hidden lg:flex h-1/2 items-start justify-center">
    <?php if ( $navigation->isNotEmpty() ) : ?>
        <ul>
            <?php foreach ( $navigation->toArray() as $item ) : ?>
                <?php if ( $item->classes == 'artist_menu' ) : ?>
                    <li>
                        <a href="<?= $item->url ?>" target="<?= $item->target ?>" x-bind="artist_menu_trigger"
                           class="text-4xl font-black uppercase leading-loose tracking-widest text-transparent transition-all duration-200 text-stroke-2 text-stroke-darkgrey font-header hover:text-darkgrey hover:text-stroke-transparent focus-visible:outline-offset-8 focus-visible:outline-darkgrey focus-visible:text-stroke-transparent focus-visible:text-darkgrey umami--click--<?= $item->slug ?>"><?= $item->label ?></a>
                    </li>
                <?php else : ?>
                    <li><a href="<?= $item->url ?>" target="<?= $item->target ?>"
                           class="text-4xl font-black uppercase leading-loose tracking-widest <?= ($item->active) ? 'text-darkgrey text-stroke-transparent' : 'text-transparent text-stroke-darkgrey' ?> transition-all duration-200 text-stroke-2 font-header hover:text-darkgrey hover:text-stroke-transparent hover:text-darkgrey hover:text-stroke-transparent focus-visible:outline-offset-8 focus-visible:outline-darkgrey focus-visible:text-stroke-transparent focus-visible:text-darkgrey umami--click--<?= $item->slug ?>"><?= $item->label ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php get_template_part('partials/components/component', 'language-switcher') ?>
        </ul>
    <?php endif; ?>
</nav>