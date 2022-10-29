<?php
namespace App\Exceptions\Spotify;

use \Exception;

final class RefusedConnectionException extends Exception
{
    public function __construct()
    {
        parent::__construct("Spotify service refused connection", 202);
    }
}
