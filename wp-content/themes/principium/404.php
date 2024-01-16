<?php get_header(); ?>
	<main class="bg-primary-900 min-h-user-screen" id="main-content" role="main">
        <div class="w-full lg:max-w-xl mx-auto px-6 lg:px-0 print:px-0 mt-16">
			<?= ($title = get_field('404_title', 'option')) ? '<h1 class="text-white text-h1 text-center">'. $title .'</h1>' : '' ?>
            <?= wp_get_attachment_image(get_field('404_image', 'option'), 'large', false, ['class' => 'my-16 h-auto w-full']) ?>
        </div>
	</main>
<?php get_template_part( 'partials/global/site', 'footer' ) ?>
<?php get_footer(); ?>