<?php

namespace Tests;
use App\Providers\Spotify\SpotifyConnector;

final class SpotifyConnectorTest extends TestCase
{
    public function test_connector()
    {
        $connector = new SpotifyConnector();
        $this->assertInstanceOf(SpotifyConnector::class, $connector);
    }

    public function test_bearer_token_received()
    {
        $connector = new SpotifyConnector();
        $bearerToken = $connector->getBearerToken();
        $this->assertNotEmpty($bearerToken);
    }
}
