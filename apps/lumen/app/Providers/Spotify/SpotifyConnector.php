<?php

namespace App\Providers\Spotify;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

final class SpotifyConnector
{
    private const CACHE_KEY = "spotify-bearer-token";

    private string $clientId;
    private string $clientSecret;

    public function __construct()
    {
        $this->clientId = env("SPOTIFY_CLIENT_ID");
        $this->clientSecret = env("SPOTIFY_CLIENT_SECRET");
    }

    public function getBearerToken(): array
    {
        $response = Http::withHeaders([
            "Authorization" => "Basic ".base64_encode($this->clientId.":".$this->clientSecret)
        ])->asForm()
            ->post("https://accounts.spotify.com/api/token", [
                "grant_type" => "client_credentials",
            ]);

        //print_r($response->json());
        return [];
    }
}
