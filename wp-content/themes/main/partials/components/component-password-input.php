<?php
    $field_name = (array_key_exists('title',$args) ) ? $args['title'] : 'password';
    $strength_meter = (array_key_exists('strength_meter', $args) && $args['strength_meter'] === true);
    ?>
<div class="password_group"
     x-data="{ show_password: false }">
    <input name="<?= $field_name ?>" id="<?= $field_name ?>"
           autocomplete="off"
           :type="show_password ? 'text' : 'password'"
           :class="show_password ? '' : 'text-lg'"
           <?= $strength_meter ? '@keyup="password_strength_meter"' : '' ?>>
    <button type="button" @click="show_password = !show_password">
        <span class="sr-only">Vis adgangskode</span>
        <img src="<?= THEME_ICONS ?>/show.svg" class="injectable stroke-gray-600" x-show="!show_password">
        <img src="<?= THEME_ICONS ?>/hide.svg" class="injectable stroke-primary-800" x-show="show_password">
    </button>
</div>