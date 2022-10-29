<?php

namespace App\Http\Controllers;

use App\Traits\LogTrait;
use App\Providers\Spotify\SpotifyAlbumsProvider;
use Illuminate\Http\JsonResponse;
use App\Exceptions\Spotify\SpotifyException;
use \Exception;


final class SearchAlbumsController extends Controller
{
    use LogTrait;

    public function __invoke(SpotifyAlbumsProvider $spotifyAlbumsProvider): JsonResponse
    {
        try {
            throw new Exception("fake error");
            $q = request()->get("q", "");
            $albums = $spotifyAlbumsProvider->getAlbumsOrFail($q);
        }
        catch (SpotifyException $ex) {
            return response()->json([
                "error" => $ex->getMessage(),
                "code" => $ex->getCode()
            ], $ex->getCode());
        }
        catch (Exception $ex) {
            $this->logError($ex,SearchAlbumsController::class);
            return response()->json([
                "error" => "Some unexpected error occurred",
                "code" => 500
            ], 500);
        }

        return response()->json($albums);
    }
}
