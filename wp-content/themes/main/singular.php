<?php get_header(); ?>
    <main id="main-content" class="relative lg:ml-1/5 min-h-screen bg-page-bg w-full lg:w-4/5 overflow-hidden"
          role="main">
        <h1 class="my-8 block px-6 text-4xl uppercase tracking-wider text-page-text font-header lg:text-[3rem] lg:px-0 lg:px-16"><?= $post->post_title ?></h1>
        <?= the_content() ?>
    </main>
<?php get_template_part('partials/global/site', 'footer') ?>
<?php get_template_part('partials/components/component', 'socials') ?>
<?php get_footer(); ?>