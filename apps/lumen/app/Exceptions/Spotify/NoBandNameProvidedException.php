<?php


namespace App\Exceptions\Spotify;

use \Exception;

final class NoBandNameProvidedException extends Exception
{
    public function __construct()
    {
        parent::__construct("No band name provided", 400);
    }
}
