<?php


namespace App\Exceptions\Spotify;

use \Exception;

final class BandNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Band not found", 404);
    }
}
