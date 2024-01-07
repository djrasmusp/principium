<?php
if ( has_site_icon() ) :
    wp_site_icon();
else : ?>
    <link rel="apple-touch-icon" sizes="180x180"
          href="<?= esc_url(get_theme_file_uri()) ?>/assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
          href="<?= esc_url(get_theme_file_uri()) ?>/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?= esc_url(get_theme_file_uri()) ?>/assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= esc_url(get_theme_file_uri()) ?>/assets/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?= esc_url(get_theme_file_uri()) ?>/assets/images/favicon/safari-pinned-tab.svg"
          color="#222222">
    <meta name="msapplication-TileColor" content="#222222">
    <meta name="theme-color" content="#222222">
<?php endif; ?>
