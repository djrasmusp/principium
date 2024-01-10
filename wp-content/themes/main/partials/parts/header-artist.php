<?php
	$title = $args['title'] ?: '';
    $type = (isset($args['type']) && $args['type'] == 'small') ? 'lg:text-[2rem]' : 'lg:text-[3rem]';
    $buttons = (isset($args['buttons']) && $args['buttons'] === true) ?: false;
?>
<header class="relative h-full w-full bg-darkgrey overflow-hidden flex justify-between items-center">
	<div class="relative flex items-center h-full w-full">
		<h3 class="text-xl px-6 lg:px-0 <?= $type ?> tracking-wider lg:ml-16 lg:mr-32 my-8 lg:my-16 uppercase block text-zinc-50 font-header"><?= $title ?></h3>
	</div>
    <?php if($buttons) : ?>
    <div class="relative flex items-center justify-center gap-4 w-[20%] my-8 lg:my-0 mx-4 lg:px-0 splide__arrows">
        <button class="opacity-30 hover:opacity-100 prev touch-manipulation splide__arrow splide__arrow--prev">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="#f0" class="fill-zinc-50 h-8 w-8 lg:h-16 lg:w-16"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 278.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
        </button>
        <button class="opacity-30 hover:opacity-100 next touch-manipulation splide__arrow splide__arrow--next">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="#f0" class="fill-zinc-50 h-8 w-8 lg:h-16 lg:w-16"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
        </button>
    </div>
    <?php endif; ?>
</header>