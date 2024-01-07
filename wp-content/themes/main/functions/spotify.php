<?php

use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

function connect_to_spotify() {
    if (!get_field("spotify_client_id", "option") || !get_field("spotify_client_secret", "option")) {
        return false;
    }

    $spotify = new SpotifyWebAPI();

    try {
        $session = new Session(get_field("spotify_client_id", "option"), get_field("spotify_client_secret", "option"));

        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();

        $spotify->setAccessToken($accessToken);

        return $spotify;
    } catch (e) {
        return false;
    }
}

function get_artist_top_tracks($artist_id) {
    $api = connect_to_spotify();

    if (!$api) {
        return [];
    }

    try {
        $tracks = $api->getArtistTopTracks($artist_id, ["country" => "DK"])->tracks;
    } catch (e) {
        return [];
    }

    return $tracks;
}

function get_playlist_tracks($playlist_id) {
    $api = connect_to_spotify();

    if (!$api) {
        return [];
    }

    try {
        $playlist_tracks = $api->getPlaylistTracks($playlist_id)->items;
    } catch (e) {
        return [];
    }

    foreach ($playlist_tracks as $track) {
        $tracks[] = $track->track;
    }

    return $tracks;
}

function get_artist_tracks(array $track_ids) {
    $api = connect_to_spotify();

    if (!$api) {
        return false;
    }

    try {
        return $api->getTracks($track_ids)->tracks;
    } catch (e) {
        return false;
    }
}

function flatten($array, $prefix = "") {
    $result = [];
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = $result + flatten($value, $prefix . $key . ".");
        } else {
            $result[$prefix . $key] = $value;
        }
    }

    return $result;
}
