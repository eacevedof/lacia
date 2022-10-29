<?php
namespace App\Exceptions\Spotify;

use \Exception;

final class EndpointConnectException extends Exception
{
    public function __construct()
    {
        parent::__construct("Endpoint refused connection", 500);
    }
}
