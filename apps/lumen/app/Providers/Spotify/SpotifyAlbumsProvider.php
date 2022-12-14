<?php

namespace App\Providers\Spotify;

use App\Exceptions\Spotify\RefusedConnectionException;
use Illuminate\Support\Facades\Http;
use App\Exceptions\Spotify\NoBandNameProvidedException;
use App\Exceptions\Spotify\BandNotFoundException;


final class SpotifyAlbumsProvider
{
    private const ARTIST_ENDPOINT = "https://api.spotify.com/v1/search";
    private const ALBUMS_ENDPOINT = "https://api.spotify.com/v1/artists/%artistId%/albums?offset=0&limit=10&include_groups=album,single,compilation,appears_on";

    private SpotifyConnector $spotifyConnect;
    private array $albums = [];

    public function __construct(SpotifyConnector $spotifyConnect)
    {
        $this->spotifyConnect = $spotifyConnect;
    }

    public function getAlbumsOrFail(string $bandName): array
    {
        if (!$bandName = trim($bandName)) {
            throw new NoBandNameProvidedException();
        }

        //esto rompe la busqueda y no encuentra nada
        //$bandName = urlencode($bandName);
        if (!$artistId = $this->getArtistIdByName($bandName)) {
            throw new BandNotFoundException();
        }

        $bearerToken = $this->spotifyConnect->getBearerToken();

        $url = str_replace("%artistId%", $artistId, self::ALBUMS_ENDPOINT);
        $this->loadAlbums($url, $bearerToken);
        $this->albums = array_merge(...$this->albums);
        return $this->albums;
    }

    private function getArtistIdByName(string $bandName): string
    {
        $code = $this->spotifyConnect->getBearerToken();
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer $code"
        ])->get(self::ARTIST_ENDPOINT, [
            "q" => urlencode($bandName),
            "type" => "artist",
            //"market" => "ES",
            "limit" => 5,
            "offset" => 0,
        ]);
        $artists = $response->json();
        if ($artists["error"] ?? "") {
            throw new RefusedConnectionException();
        }

        //por norma general el artista 0 es el que encaja mejor con la busqueda
        return $artists["artists"]["items"][0]["id"] ?? "";
    }

    private function loadAlbums(string $url, string $bearerToken): void
    {
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "Bearer $bearerToken"
        ])->get($url)->json();

        if (!($items = ($response["items"] ?? []))) return;

        $this->albums[] = $items;
        if (!($urlNext = $response["next"] ?? "")) return;

        $this->loadAlbums($urlNext, $bearerToken);
    }
}
