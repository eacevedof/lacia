<?php


namespace App\Exceptions\Spotify;

use \Exception;
use Illuminate\Http\Response;

final class NoBandNameProvidedException extends Exception
{
    public function render(): Response
    {
        return response(["error" => "No band name provided"], 403);
    }
}
