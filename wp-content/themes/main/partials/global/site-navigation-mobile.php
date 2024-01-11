<?php


use Log1x\Navi\Navi;

$navigation = ( new Navi() )->build( "primary" );
$socials    = get_field( 'social_media', 'option' );
$artists    = get_posts( [
    "post_type"      => "artist",
    "posts_per_page" => - 1,
    "meta_query"     => [
        "hide_artist" => [
            "key"     => "hide_artist",
            "value"   => 1,
            "compare" => "!="
        ],
        "sorting"     => [
            "key"     => "sorting",
            "compare" => "EXISTS"
        ]
    ],
    "orderby"        => [ "post_title" => 'ASC' ]
] );
?>

<section
    class="fixed lg:hidden inset-0 z-20 bg-page-bg backdrop-blur-sm"
    x-bind="mobile_menu"
    x-transition:enter="transition ease-out duration-450"
    x-transition:enter-start="-translate-y-full"
    x-transition:enter-end="translate-y-0"
    x-transition:leave="transition ease-in duration-450"
    x-transition:leave-start="translate-y-0"
    x-transition:leave-end="-translate-y-full"
>
    <div class="container h-full p-16 pt-32 pb-8 overflow-y-auto">
        <div class="flex flex-col justify-between h-full">
            <?php if ( $navigation->isNotEmpty() ) : ?>
                <nav>
                    <ul class="text-center">
                        <?php foreach ( $navigation->toArray() as $item ) : ?>
                            <?php if ( $item->classes == 'artist_menu' ) : ?>
                                <li>
                                    <a href="<?= $item->url ?>" x-bind="mobile_artist_trigger"
                                       class="text-4xl font-black uppercase leading-loose tracking-widest text-transparent text-stroke-page-text transition-all duration-200 text-stroke-2 font-header hover:text-page-text hover:text-stroke-transparent outline-none focus-visible:outline-none focus-within:outline-none umami--click--<?= $item->slug ?>"><?= $item->label ?></a>
                                    <ul x-bind="mobile_artist_menu">
                                        <?php foreach ( $artists as $artist ) : ?>
                                            <li><a href="<?= get_permalink( $artist ) ?>"
                                                   class="text-2xl font-black uppercase leading-loose tracking-widest text-page-text font-header umami--click--<?= $artist->post_name ?>"><?= $artist->post_title ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php else : ?>
                                <li><a href="<?= $item->url ?>" target="<?= $item->target ?>"
                                       class="text-4xl font-black uppercase leading-loose tracking-widest text-transparent text-stroke-page-text transition-all duration-200 text-stroke-2 font-header hover:text-page-text hover:text-stroke-transparent outline-none focus-visible:outline-none focus-within:outline-none umami--click--<?= $item->slug ?>"><?= $item->label ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <li class="flex justify-center">
                        <?php get_template_part('partials/components/component', 'language-switcher') ?>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
            <ul class="flex justify-center gap-12 items-center w-full">
                <?php foreach ( $socials as $social ) : ?>
                    <li><a href="<?= $social['url'] ?>" title="<?= bloginfo() ?>'s <?= $social['media'] ?>"
                           target="_blank"><img
                                src="<?= THEME_ICONS ?>/<?= $social['media'] ?>.svg"
                                class="h-8 w-8 transition-all duration-450 injectable fill-page-text"></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>