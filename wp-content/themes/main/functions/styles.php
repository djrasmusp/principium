<?php
/*------------------------------------*\
    ADD STYLES TO THEME
\*------------------------------------*/

$handle = strtolower(wp_get_theme()->get("Name")) . "_";

add_action("wp_enqueue_scripts", function () use ($handle) {
    wp_register_style(
        $handle . "main",
        get_template_directory_uri() . "/assets/css/style.css",
        [],
        filemtime(get_template_directory() . '/assets/css/style.css'),
        "all"
    );
    wp_enqueue_style($handle . "main"); // Enqueue it!
}, 8 );

add_action("admin_enqueue_scripts", function () use ($handle) {

    wp_register_style(
        $handle . "admin",
        get_template_directory_uri() . "/assets/css/admin.css",
        [],
        filemtime(get_template_directory() . '/assets/css/admin.css'),
        "screen"
    );
    wp_enqueue_style($handle . "admin");
});

add_action('login_enqueue_scripts', function() use ($handle) {
	wp_register_style(
		$handle . "login",
		get_template_directory_uri() . "/assets/css/login.css",
		[],
		filemtime(get_template_directory() . '/assets/css/login.css'),
		"screen"
	);
	wp_enqueue_style($handle . "login");
});

// Removes the emoji stuff
add_action("init", function () {
    remove_action("wp_head", "print_emoji_detection_script", 7);
    remove_action("admin_print_scripts", "print_emoji_detection_script");
    remove_action("wp_print_styles", "print_emoji_styles");
    remove_action("admin_print_styles", "print_emoji_styles");
});

add_action(
    "wp_head",
    function () {
        $font_folder = get_template_directory() . "/assets/fonts/";
        require_once ABSPATH . "wp-admin" . "/includes/file.php";

        foreach (list_files($font_folder) as $file) {
            if (basename($file) == "keepme.txt") {
                continue;
            }
            echo '<link href="' .
                get_template_directory_uri() .
                "/assets/fonts/" .
                basename($file) .
                '" as="font" type="font/' . substr(basename($file), -3) . '" crossorigin />';
        }
    },
    1
);

add_action('admin_init', function(){
    add_editor_style(get_template_directory_uri() . '/assets/css/_editor.css');
});
