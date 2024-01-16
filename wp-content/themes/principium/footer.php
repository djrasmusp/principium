<?php wp_footer(); ?>

<?php get_template_part('partials/global/site-navigation', 'artists'); ?>
<?php get_template_part('partials/global/site-navigation', 'mobile') ?>


<?php $scripts_in_body = get_field('scripts_in_body', 'option');
if ($scripts_in_body) : echo $scripts_in_body; endif; ?>

</body>
</html>