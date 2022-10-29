<?php
namespace App\Exceptions\Spotify;

final class NoBearerTokenReceivedException extends SpotifyException
{
    public function __construct()
    {
        parent::__construct("No bearer token received", 500);
    }
}
