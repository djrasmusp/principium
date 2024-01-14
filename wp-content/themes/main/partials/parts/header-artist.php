<?php
	$title = $args['title'] ?: '';
    $type = (isset($args['type']) && $args['type'] == 'small') ? 'lg:text-[2rem]' : 'lg:text-[3rem]';
    $buttons = (isset($args['buttons']) && $args['buttons'] === true) ?: false;
?>
<header class="relative h-full w-full bg-header-bg overflow-hidden flex justify-between items-center">
	<div class="relative flex items-center h-full w-full">
		<h3 class="text-xl px-6 lg:px-0 <?= $type ?> tracking-wider md:ml-16 md:mr-32 my-8 lg:my-16 uppercase block text-header-text font-header"><?= $title ?></h3>
	</div>
    <?php if($buttons) : ?>
    <div class="relative flex items-center justify-center gap-4 w-[20%] my-8 md:my-0 mx-4 md:px-0 splide__arrows">
        <button class="opacity-30 hover:opacity-100 prev touch-manipulation splide__arrow splide__arrow--prev">
            <img src="<?= THEME_ICONS ?>/chevron-left.svg" class="injectable fill-header-text size-8 lg:size-16">
            <span class="sr-only"><?= __('Forrige', 'main-theme') ?></span>
        </button>
        <button class="opacity-30 hover:opacity-100 next touch-manipulation splide__arrow splide__arrow--next">
            <img src="<?= THEME_ICONS ?>/chevron-right.svg" class="injectable fill-header-text size-8 lg:size-16">
            <span class="sr-only"><?= __('Næste', 'main-theme') ?></span>
        </button>
    </div>
    <?php endif; ?>
</header>