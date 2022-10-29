<?php
namespace App\Exceptions\Spotify;

final class RefusedConnectionException extends SpotifyException
{
    public function __construct()
    {
        parent::__construct("Spotify service refused connection", 202);
    }
}
