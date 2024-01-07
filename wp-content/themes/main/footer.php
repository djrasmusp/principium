<?php wp_footer(); ?>

<?php $scripts_in_body = get_field('scripts_in_body', 'option');
if ($scripts_in_body) : echo $scripts_in_body; endif; ?>

</body>
</html>