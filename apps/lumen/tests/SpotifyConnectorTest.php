<?php

namespace Tests;
use App\Providers\Spotify\SpotifyConnector;

final class SpotifyConnectorTest extends TestCase
{
    public function test_connector()
    {
        $conector = new SpotifyConnector();
        $this->assertInstanceOf(SpotifyConnector::class, $conector);
    }
}
