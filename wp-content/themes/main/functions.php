<?php

/**
 *
 * @var THEME_IMAGES theme_images
 * @√ar THEME_ICONS theme_icons
 */
include_once "vendor/autoload.php";
include_once ABSPATH . "wp-admin/includes/plugin.php";

defined("THEME_IMAGES") ? THEME_IMAGES : define("THEME_IMAGES", get_template_directory_uri() . "/assets/images");
defined("THEME_ICONS") ? THEME_ICONS : define("THEME_ICONS", get_template_directory_uri() . "/assets/images/icons");

// Initialize our custom functions
require_once "functions/mu-functions.php";
require_once "functions/styles.php";
require_once "functions/scripts.php";

require_once "functions/register-navigations.php";
require_once "functions/register-blocks.php";

require_once "functions/block-helpers.php";

require_once "functions/admin/login.php";

require_once "functions/custom.php";

require_once "functions/acf/acf-local-json.php";
require_once "functions/acf/acf-wysiwyg.php";
require_once "functions/acf/acf-sync.php";
require_once "functions/acf/acf-empty-field.php";
require_once "functions/acf/acf-icon-picker.php";
require_once "functions/acf/acf-focus-point.php";
require_once "functions/acf/acf-spotify.php";

require_once "functions/yoast.php";
require_once "functions/spotify.php";

require_once "functions/cronjobs/update-spotify-liste.php";

if(wp_get_environment_type() === 'development'){
    require_once "functions/development.php";
}
