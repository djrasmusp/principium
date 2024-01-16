<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?= wp_title() ?></title>
    <meta http-equiv="x-ua-compatible" content="ie=edge,chrome=1">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, shrink-to-fit=no">

    <?php // Generate all favicon sizes here
    get_template_part('partials/global/site', 'favicon'); ?>

    <?php get_template_part('partials/global/google/google', 'prefetch') ?>

    <?php get_template_part('partials/global/google/google', 'gtm'); ?>

    <?php wp_head(); ?>

    <?php if ($scripts_in_head = get_field('scripts_in_head', 'option')) : ?>
        <?= $scripts_in_head; ?>
    <?php endif; ?>
</head>

<body <?php body_class(); ?>  x-data="menusState">
<?php get_template_part('partials/global/google/google', 'pixel'); ?>
<?php get_template_part('partials/global/site', 'header') ?>