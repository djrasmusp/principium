<?php

require_once 'Blocks.php';
function get_style(string $className): string
{
    $classes = explode(' ', $className);

    foreach ($classes as $class) {
        if (strpos($class, 'is-style-') === 0) {
            return str_replace('is-style-', '', $class);
        }

        return 'default';
    }
}