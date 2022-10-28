<?php

namespace App\Providers\Spotify;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Exceptions\Spotify\NoBearerTokenReceivedException;

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

    public function getBearerToken(): string
    {
        $response = Http::withHeaders([
            "Authorization" => "Basic ".base64_encode($this->clientId.":".$this->clientSecret)
        ])->asForm()
            ->post("https://accounts.spotify.com/api/token", [
                "grant_type" => "client_credentials",
            ]);

        $token = $response->json();
        if (!($token["access_token"] ?? ""))
            throw new NoBearerTokenReceivedException();

        return $token["access_token"];
    }
}
