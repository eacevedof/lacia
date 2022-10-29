<?php


namespace App\Exceptions\Spotify;

use \Exception;
use Illuminate\Http\Response;

final class BandNotFoundException extends Exception
{
    public function render(): Response
    {
        return response(["error" => "Band not found", "code" => 204], 204);
    }
}
