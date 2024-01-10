<?php get_template_part('partials/global/site', 'skip-link') ?>
<header class="fixed  block w-full z-50 md:z-0 bg-darkgrey md:w-1/5 md:h-screen md:bg-zinc-50">
    <div class="p-6 flex justify-between items-center lg:h-1/3 lg:justify-center">
        <?php get_template_part('partials/global/site', 'logo') ?>
        <?php get_template_part('partials/fragments/fragment', 'mobile-button') ?>
    </div>
    <?php get_template_part('partials/global/site', 'navigation-main') ?>
</header>