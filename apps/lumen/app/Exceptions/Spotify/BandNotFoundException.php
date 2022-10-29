<?php


namespace App\Exceptions\Spotify;

final class BandNotFoundException extends SpotifyException
{
    public function __construct()
    {
        parent::__construct("Band not found", 404);
    }
}
