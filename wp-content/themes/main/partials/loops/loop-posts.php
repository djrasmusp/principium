<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-8 min-h-1/1">
    <?php foreach ($posts as $post) : ?>
        <?php get_template_part('partials/loops/items/item', 'post', $post) ?>
    <?php endforeach; ?>
</div>