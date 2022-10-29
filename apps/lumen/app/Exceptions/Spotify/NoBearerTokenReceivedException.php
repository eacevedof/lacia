<?php
namespace App\Exceptions\Spotify;

use \Exception;
use Illuminate\Http\Response;

final class NoBearerTokenReceivedException extends Exception
{
    public function render(): Response
    {
        return response(["error" => "No bearer token received", "code"=>500], 500);
    }
}
