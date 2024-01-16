<?php
if( class_exists('ACF') ) :
    if (get_field('analytics_script', 'option') == 'gtm') {
        if ($gtm_id = get_field('analytics_script_gtm', 'option')) { ?>
            <!-- Google Tag Manager (noscript) -->
            <noscript>
                <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-<?php echo $gtm_id ?>" height="0" width="0"
                        style="display:none;visibility:hidden"></iframe>
            </noscript>
            <!-- End Google Tag Manager (noscript) -->
        <?php }
    }
endif;