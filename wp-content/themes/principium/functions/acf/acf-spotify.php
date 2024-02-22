<?php

add_filter(
    "acf/update_value",
    function ($value, $postid, $field) {
        if (in_array($field["key"], ["field_63d1889252111", "field_641e21d847e3f"])) {
            global $post;

            if (is_a($post, "WP_Post")) {
                $post_id = $post->post_parent == 0 ? $post->ID : $post->post_parent;
                $value = str_replace(["https://open.spotify.com/artist/", "https://open.spotify.com/playlist/"], "", $value);
                if ($field["key"] == "field_63d1889252111") {
                    update_post_meta($post_id, "spotify_artist_id", $value);
                    delete_post_meta($post_id, "spotify_playlist_id");
                    update_post_meta($post_id, "spotify_tracks", get_artist_top_tracks($value));
                } else {
                    update_post_meta($post_id, "spotify_playlist_id", $value);
                    delete_post_meta($post_id, "spotify_artist_id");
                    update_post_meta($post_id, "spotify_tracks", get_playlist_tracks($value));
                }
            }
        }

        return $value;
    },
    10,
    3
);

add_filter(
    "acf/load_value",
    function ($value, $post_id, $field) {
        if (in_array($field["key"], ["field_63d1889252111", "field_641e21d847e3f"])) {
            return str_replace(["https://open.spotify.com/artist/", "https://open.spotify.com/playlist/"], "", $value);
        }

        return $value;
    },
    10,
    3
);