<?php get_header(); ?>
<main id="main-content" class="relative lg:ml-1/5 min-h-1/1 bg-zinc-50 w-full lg:w-4/5 overflow-hidden" role="main">
    <header class="bg-primary-900 article-header">
        <div class="container">
            <div class="w-full lg:max-w-3xl mx-auto px-0 py-16 print:py-0">
                <h1 class="text-h1 text-white mt-4 print:text-black break-all" lang="<?= get_locale() ?>"><?= $post->post_title ?></h1>
            </div>
        </div>
    </header>
    <?php the_content(); ?>
    <?php get_template_part('partials/global/site', 'footer') ?>
</main>
<?php get_template_part( 'partials/components/component', 'socials' ) ?>
<?php get_footer(); ?>
