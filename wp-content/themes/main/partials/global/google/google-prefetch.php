<?php
    switch (get_field('analytics_script', 'option')){
        case 'ga4':
            echo '<link rel="dns-prefetch" href="//www.googletagmanager.com/" />';
            break;
        case 'gtm':
            echo '<link rel="dns-prefetch" href="//www.googletagmanager.com/" />';
            break;
        default:
    }

