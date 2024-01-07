<?php
/*------------------------------------*\
    ADD SCRIPTS TO THEME
\*------------------------------------*/
$handle = strtolower( wp_get_theme()->get( "Name" ) ) . "_";

add_action( "wp_enqueue_scripts", function () use ( $handle ) {
	if ( $GLOBALS["pagenow"] != "wp-login.php" && ! is_admin() ) {
		wp_dequeue_script( 'jquery' );
		wp_deregister_script( 'jquery' );

		wp_register_script(
			$handle . "main",
			get_template_directory_uri() . "/assets/js/main.js",
			null,
            filemtime(get_template_directory() . '/assets/js/main.js'),
			true
		); // Custom scripts

		wp_enqueue_script( $handle . "main" ); // Enqueue it!

		wp_localize_script( $handle . "main", "site_objects", [
			"ajax_url"           => admin_url( "admin-ajax.php" ),
            "environment"        => wp_get_environment_type()
		] );
	}
} );

add_action( 'admin_enqueue_scripts', function () use ( $handle ) {
	wp_enqueue_script( "block_admin", get_template_directory_uri() . "/assets/js/admin.js", null, filemtime(get_template_directory() . '/assets/js/admin.js'), true );

	wp_localize_script( "block_admin", "site_objects", [
		"ajax_url"    => admin_url( "admin-ajax.php" ),
		"environment" => wp_get_environment_type()
	] );
} );