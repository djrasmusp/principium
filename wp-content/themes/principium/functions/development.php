<?php

function helo($phpmailer)
{
    $phpmailer->isSMTP();
    $phpmailer->Host = '127.0.0.1';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = 'Boilerplate';
    $phpmailer->Password = '';
}

add_action('phpmailer_init', 'helo');