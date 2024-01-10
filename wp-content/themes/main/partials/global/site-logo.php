<div itemscope itemtype="https://schema.org/Organization">
    <a href="<?= site_url() ?>" title="<?= get_bloginfo( 'name' ) ?>" itemprop="url" class="focus-within:outline-4 focus-visible:outline-darkgrey md:focus-visible:rounded-full">
        <?= wp_get_attachment_image(get_field('logo_mobile', 'option'), 'large', false, ['itemprop' => 'logo', 'alt' => get_bloginfo('name'), 'class' => 'injectable md:hidden h-8 w-32 fill-zinc-50 ']) ?>
        <?= wp_get_attachment_image( get_field('logo', 'option'), 'full', false, ['itemprop' => 'logo', 'alt' => get_bloginfo('name'), 'class' => 'injectable hidden md:block w-full h-auto mx-auto my-auto']) ?>
    </a>
</div>