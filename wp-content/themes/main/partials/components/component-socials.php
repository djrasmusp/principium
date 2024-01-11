<footer class="hidden lg:block fixed bottom-0 lg:h-1/6 bg-footer-bg w-1/5 z-50">
    <?php if($socials = get_field( 'social_media', 'option' )) : ?>
        <ul class="flex w-full justify-center gap-8 socials absolute bottom-4">
            <?php foreach ( $socials as $social ) : ?>
                <li><a href="<?= $social['url'] ?>" title="<?= bloginfo('name') ?>'s <?= $social['media'] ?>" target="_blank" data-no-translation-href>
                        <img
                            src="<?= THEME_ICONS ?>/<?= $social['media'] ?>.svg"
                            class="size-5 transition-all duration-450 injectable fill-zinc-50">
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</footer>