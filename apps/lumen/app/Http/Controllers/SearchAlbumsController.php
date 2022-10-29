<?php

namespace App\Http\Controllers;

use App\Providers\Spotify\SpotifyAlbumsProvider;
use Illuminate\Http\JsonResponse;
use \Exception;

final class SearchAlbumsController extends Controller
{
    public function __invoke(SpotifyAlbumsProvider $spotifyAlbumsProvider): JsonResponse
    {
        try {
            $q = request()->get("q", "");
            $albums = $spotifyAlbumsProvider->getAlbumsOrFail($q);
        }
        catch (Exception $ex) {
            return response()->json([
                "error" => $ex->getMessage(),
                "code" => $ex->getCode()
            ], $ex->getCode() ?: 500);
        }

        return response()->json($albums);
    }
}
