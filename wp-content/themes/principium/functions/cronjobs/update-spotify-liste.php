<?php

if (!wp_next_scheduled("update_spotify_artist_playlists")) {
    wp_schedule_event(time(), "hourly", "update_spotify_artist_playlists");
}

add_action("update_spotify_artist_playlists", 'update_spotify_artist_playlists');

function update_spotify_artist_playlists() {

    $artists = new WP_Query([
        "post_type" => "artist",
        "posts_per_page" => -1,
        "meta_query" => [
            [
                "key" => "spotify_artist_id",
                "compare" => "exists"
            ]
        ],
        "fields" => "ids"
    ]);

    foreach ($artists->posts as $artist) {

        $spotify_id = get_post_meta($artist, "spotify_artist_id", true);

        $spotify_playlist = get_artist_top_tracks($spotify_id);

        update_post_meta($artist, "spotify_tracks", $spotify_playlist);
    }

    return true;
}

if (!wp_next_scheduled("update_spotify_playlists")) {
    wp_schedule_event(time(), "hourly", "update_spotify_playlists");
}

add_action("update_spotify_playlists", 'update_spotify_playlists');

function update_spotify_playlists() {
    $artists = new WP_Query([
        "post_type" => "artist",
        "posts_per_page" => -1,
        "meta_query" => [
            [
                "key" => "spotify_playlist_id",
                "compare" => "exists"
            ]
        ],
        "fields" => "ids"
    ]);

    foreach ($artists->posts as $artist) {
        $spotify_id = get_post_meta($artist, "spotify_playlist_id", true);

        $spotify_playlist = get_artist_top_tracks($spotify_id);

        update_post_meta($artist, "spotify_tracks", $spotify_playlist);
    }

    return true;
}
