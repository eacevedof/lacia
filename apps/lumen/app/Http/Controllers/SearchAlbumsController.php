<?php

namespace App\Http\Controllers;

use App\Providers\Spotify\SpotifyAlbumsProvider;
use Illuminate\Http\JsonResponse;

final class SearchAlbumsController extends Controller
{
    public function __invoke(SpotifyAlbumsProvider $spotifyAlbumsProvider): JsonResponse
    {
        $q = request()->get("q", "");
        $albums = $spotifyAlbumsProvider->getAlbums($q);
        return response()->json($albums);
    }
}
