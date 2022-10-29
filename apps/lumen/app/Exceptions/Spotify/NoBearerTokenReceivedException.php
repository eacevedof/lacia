<?php
namespace App\Exceptions\Spotify;

use \Exception;

final class NoBearerTokenReceivedException extends Exception
{
    public function __construct()
    {
        parent::__construct("No bearer token received", 500);
    }
}
