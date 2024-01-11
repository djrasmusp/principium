<?php get_template_part('partials/global/site', 'skip-link') ?>
<header class="md:fixed block w-full z-30 bg-menu-bg-mobile md:w-1/5 md:h-screen md:bg-menu-bg">
    <div class="p-6 flex justify-between items-center lg:h-1/3 lg:justify-center">
        <?php get_template_part('partials/global/site', 'logo') ?>
        <?php get_template_part('partials/fragments/fragment', 'mobile-button') ?>
    </div>
    <?php get_template_part('partials/global/site', 'navigation-main') ?>
</header>