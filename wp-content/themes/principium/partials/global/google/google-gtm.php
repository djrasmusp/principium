<?php
if (class_exists('ACF')) :
    if (get_field('analytics_script', 'option') == 'gtm') {
        if ($gtm_id = get_field('analytics_script_gtm', 'option')) { ?>
            <!-- Google Tag Manager -->
            <script>(function (w, d, s, l, i) {
                    w[l] = w[l] || [];
                    w[l].push({
                        'gtm.start':
                            new Date().getTime(), event: 'gtm.js'
                    });
                    var f = d.getElementsByTagName(s)[0],
                        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                    j.async = true;
                    j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                    f.parentNode.insertBefore(j, f);
                })(window, document, 'script', 'dataLayer', 'GTM-<?php echo $gtm_id; ?>');</script>
            <!-- End Google Tag Manager -->
        <?php }
    }
endif;

