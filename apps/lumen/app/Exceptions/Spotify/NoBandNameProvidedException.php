<?php


namespace App\Exceptions\Spotify;

final class NoBandNameProvidedException extends SpotifyException
{
    public function __construct()
    {
        parent::__construct("No band name provided", 400);
    }
}
