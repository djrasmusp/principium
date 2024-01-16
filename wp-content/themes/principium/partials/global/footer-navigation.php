<?php
use Log1x\Navi\Navi;
$navigation = (new Navi())->build('footer');
?>
<div class="lg:basis-1/5 flex flex-col justify-center lg:justify-start px-4 order-first lg:order-none">
    <?php if ($navigation->isNotEmpty()) : ?>
        <nav aria-label="Menu">
            <ul class="flex flex-col items-center lg:items-start w-full gap-y-4 gap-x-8">
                <?php foreach ($navigation->toArray() as $item) : ?>
                    <li class="text-center lg:text-left text-sm tracking-widest font-header uppercase">
                        <a href="<?= $item->url ?>"
                           class="text-zinc-300 transition-all hover:bg-zinc-50 hover:text-darkgrey ring-4 ring-transparent hover:ring-zinc-50 focus-visible:bg-zinc-50 focus-visible:text-darkgrey focus-visible:outline-0 focus-visible:ring-zinc-50">
                        <span><?= $item->label ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>
