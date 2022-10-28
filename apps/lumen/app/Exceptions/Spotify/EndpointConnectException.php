<?php
namespace App\Exceptions\Spotify;

use \Exception;
use Illuminate\Http\Response;

final class EndpointConnectException extends Exception
{
    public function render(): Response
    {
        return response(["error" => "Endpoint refused connection"], 500);
    }
}
