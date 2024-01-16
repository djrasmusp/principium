<?php

function get_acf_sync_count(){

	$sync = array();

    if( ! class_exists('ACF') ) return;

	if ( function_exists('acf_get_local_json_files') && acf_get_local_json_files() ) {

		// Get all groups in a single cached query to check if sync is available.
		$all_field_groups = acf_get_field_groups();
		foreach ( $all_field_groups as $field_group ) {

			// Extract vars.
			$local    = acf_maybe_get( $field_group, 'local' );
			$modified = acf_maybe_get( $field_group, 'modified' );
			$private  = acf_maybe_get( $field_group, 'private' );

			// Ignore if is private.
			if ( $private ) {
				continue;

				// Ignore not local "json".
			} elseif ( $local !== 'json' ) {
				continue;

				// Append to sync if not yet in database.
			} elseif ( ! $field_group['ID'] ) {
				$sync[ $field_group['key'] ] = $field_group;

				// Append to sync if "json" modified time is newer than database.
			} elseif ( $modified && $modified > get_post_modified_time( 'U', true, $field_group['ID'] ) ) {
				$sync[ $field_group['key'] ] = $field_group;
			}
		}
	}

	return count($sync);
}

add_action('admin_menu', function(){
	global $menu;

	$count = get_acf_sync_count();

	if($count === 0){
		return;
	}

	$menu_item = wp_list_filter(
		$menu,
		array( 2 => 'edit.php?post_type=acf-field-group' ) // 2 is the position of an array item which contains URL, it will always be 2!
	);

	if ( ! empty( $menu_item )  ) {
		$menu_item_position = key( $menu_item ); // get the array key (position) of the element
		$menu[ $menu_item_position ][0] .= ' <span class="awaiting-mod">' . $count . '</span>';
	}
});