<?php get_header(); ?>
    <main id="main-content" class="relative lg:ml-1/5 min-h-screen bg-page-bg w-full lg:w-4/5 overflow-hidden"
          role="main" itemscope itemtype="https://schema.org/MusicGroup">
        <?php the_content(); ?>
    </main>
<?php get_template_part('partials/global/site', 'footer') ?>
<?php get_template_part('partials/components/component', 'socials') ?>
<?php get_footer(); ?>