<?php get_header(); ?>
<?php get_template_part('partials/components/component', 'splash-page') ?>
<main id="main-content" class="relative w-full overflow-hidden bg-page-bg min-h-1/1 lg:ml-1/5 lg:w-4/5" role="main">
    <?php get_template_part('partials/loops/loop', 'artists') ?>
</main>
<?php get_template_part('partials/global/site', 'footer') ?>
<?php get_template_part('partials/components/component', 'socials') ?>
<?php get_footer(); ?>
