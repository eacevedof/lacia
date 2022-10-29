<?php

namespace App\Http\Controllers;

use App\Exceptions\Spotify\BandNotFoundException;
use App\Traits\LogTrait;
use App\Providers\Spotify\SpotifyAlbumsProvider;
use App\Transformers\Albums\SearchTransformer;
use Illuminate\Http\JsonResponse;
use App\Exceptions\Spotify\SpotifyException;
use \Exception;


final class SearchAlbumsController extends Controller
{
    use LogTrait;

    public function __invoke(
        SpotifyAlbumsProvider $spotifyAlbumsProvider,
        SearchTransformer $searchTransformer
    ): JsonResponse
    {
        try {
            $q = request()->get("q", "");
            $albums = $spotifyAlbumsProvider->getAlbumsOrFail($q);
            $albums = $searchTransformer->transformAlbums($albums);
        }
        catch (SpotifyException $ex) {
            return response()->json([
                "error" => $ex->getMessage(),
                "code" => $ex->getCode()
            ], $ex->getCode());
        }
        catch (Exception $ex) {
            //guardo error para futura cobertura
            $this->logError($ex,SearchAlbumsController::class);
            return response()->json([
                "error" => "Some unexpected error occurred",
                "code" => 500
            ], 500);
        }

        return response()->json($albums);
    }
}
