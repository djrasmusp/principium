<?php get_header(); ?>
    <main class="min-h-screen bg-zinc-100 lg:ml-1/5 w-full lg:w-4/5 flex flex-col justify-between">
        <div class="grow min-h-full">
            <div class="mt-20 lg:mt-0 grid grid-cols-2 lg:grid-cols-3 grid-flow-row artists">
                <?php foreach ($posts as $post) : ?>
                    <?php get_template_part('partials/loop/items/item', 'post', $post) ?>
                <?php endforeach; ?>
            </div>
        </div>
	</main>
<?php get_footer(); ?>