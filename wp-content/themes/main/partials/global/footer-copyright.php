<?php
use Log1x\Navi\Navi;
$family_navigation = (new Navi())->build('family');
?>
<div class="lg:basis-1/5 flex flex-col">
    <div class="flex flex-col gap-8">
        <?php if ($family_navigation->isNotEmpty()) : ?>
            <div>
                <h3 class="font-header text-sm text-zinc-50 text-center lg:text-right mb-2">THE i! FAMILY</h3>
                <nav aria-label="Menu">
                    <ul class="flex flex-col items-center lg:items-end gap-2">
                        <?php foreach ($family_navigation->toArray() as $item) : ?>
                            <li class="text-xs font-header uppercase tracking-widest">
                                <a href="<?= $item->url ?>" target="_blank"
                                   class="text-zinc-300 transition-all hocus:bg-zinc-50 hocus:text-darkgrey ring-2 ring-transparent hocus:ring-zinc-50 focus-visible:outline-0">
                                <?= $item->label ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
        <div class="flex flex-col items-center lg:items-end gap-2">
            <a href="https://rasmusp.com"
               class="group text-xs text-zinc-700 hocus:text-zinc-400 focus-visible:outline-0 group transition-all duration-0">created
                by: <span
                        class="font-bold uppercase group-hover:animate-rasmusp group-focus-visible:animate-rasmusp">Rasmus P</span>.</a>
            <span class="text-zinc-500 text-xs">&copy; <?= date( 'Y' ) ?> <span class="text-zinc-400 font-bold"><?= get_bloginfo('name') ?></span>. <?= __('Alle rettigheder forbeholdes', 'main-theme') ?></span>
        </div>
    </div>
</div>
