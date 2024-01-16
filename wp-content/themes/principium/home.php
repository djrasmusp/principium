<?php get_header(); ?>
    <main id="main-content" class="relative  lg:ml-1/5 lg:min-h-1/1 mb-16 bg-page-bg w-full lg:w-4/5 overflow-hidden"
          role="main">
        <?php get_template_part('partials/loops/loop', 'posts') ?>
    </main>
<?php get_template_part('partials/global/site', 'footer') ?>
<?php get_template_part( 'partials/components/component', 'socials' ) ?>
<?php get_footer(); ?>