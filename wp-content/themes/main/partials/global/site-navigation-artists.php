<?php
$artists = get_posts( [
	"post_type"      => "artist",
	"posts_per_page" => - 1,
	"meta_query"     => [
		"hide_artist" => [
			"key"     => "hide_artist",
			"value"   => 1,
			"compare" => "!="
		],
        "hide_artist_on_en" => (get_locale() === 'da_DK') ? [] : [
            'key' => 'hide_artist_on_en_site',
            "value" => '1',
            "compare" => "!="
        ],
		"sorting"     => [
			"key"     => "sorting",
			"compare" => "EXISTS"
		]
	],
	"orderby"        => [ "post_title" => 'ASC' ]
] );

$artists = collect( $artists )->groupBy( function ( $item, $key ) {
	return substr( $item->post_title, 0, 1 );
} );
?>

<section class="fixed top-0 right-0 bottom-0 z-20 w-4/5 bg-menu-bg-artist"
         x-bind="artist_menu"
         x-transition:enter="transition ease-out duration-1000"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-1000"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full">
    <div class="container max-h-[100dvh] overflow-y-auto">
        <?php get_template_part('partials/loops/loop', 'artists') ?>
    </div>
</section>