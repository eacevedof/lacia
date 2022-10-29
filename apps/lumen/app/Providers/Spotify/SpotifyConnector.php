<?php

namespace App\Providers\Spotify;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Exceptions\Spotify\NoBearerTokenReceivedException;

final class SpotifyConnector
{
    private const CACHE_KEY = "spotify-bearer-token";
    private const SUBTRACTS_TO_EXPIRE_TIME = 300;

    private string $clientId;
    private string $clientSecret;

    public function __construct()
    {
        $this->clientId = env("SPOTIFY_CLIENT_ID");
        $this->clientSecret = env("SPOTIFY_CLIENT_SECRET");
    }

    public function getBearerToken(): string
    {
        if ($bearerToken = $this->getTokenFromCache()) return $bearerToken;

        $response = Http::withHeaders([
            "Authorization" => "Basic ".base64_encode($this->clientId.":".$this->clientSecret)
        ])->asForm()
            ->post("https://accounts.spotify.com/api/token", [
                "grant_type" => "client_credentials",
            ]);

        $token = $response->json();
        if (!$bearerToken = ($token["access_token"] ?? ""))
            throw new NoBearerTokenReceivedException();

        //expires_in suele ser 3600s quito 5min para que se renueve antes
        $this->saveTokenInCache($bearerToken, ($token["expires_in"] - self::SUBTRACTS_TO_EXPIRE_TIME));
        return $bearerToken;
    }

    private function getTokenFromCache(): ?string
    {
        return ($token = Cache::get(self::CACHE_KEY)) ? $token : null;
    }

    private function saveTokenInCache(string $bearerToken, int $time): void
    {
        Cache::put(self::CACHE_KEY, $bearerToken, $time);
    }
}
