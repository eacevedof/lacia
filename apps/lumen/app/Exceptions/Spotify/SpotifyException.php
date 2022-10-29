<?php
namespace App\Exceptions\Spotify;

use \Exception;

abstract class SpotifyException extends Exception
{
    public function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }
}
