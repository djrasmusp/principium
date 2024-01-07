<?php get_header(); ?>
<main id="main-content" class="relative w-full overflow-hidden bg-zinc-50 min-h-1/1 lg:ml-1/5 lg:w-4/5" role="main">
    <section class="mt-20 lg:mt-0">
        <?php get_template_part('partials/loops/loop', 'artists') ?>
    </section>
</main>
<?php get_template_part('partials/global/site', 'footer') ?>
<?php get_template_part( 'partials/components/component', 'socials' ) ?>
<?php get_footer(); ?>
