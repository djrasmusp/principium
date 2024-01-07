<?php
if (get_field('analytics_script', 'option') == 'ga4') {
    if ($ga_id = get_field('analytics_script_ga4', 'option')) { ?>
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-<?= $ga_id ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-<?= $ga_id ?>');
        </script>
        <!-- End Google Analytics -->
    <?php }
}