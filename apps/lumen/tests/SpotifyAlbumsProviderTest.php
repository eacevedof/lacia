<?php

namespace Tests;
use App\Providers\Spotify\SpotifyAlbumsProvider;
use App\Providers\Spotify\SpotifyConnector;

final class SpotifyAlbumsProviderTest extends TestCase
{
    public function test_instance_of_albums_provider()
    {
        $provider = new SpotifyAlbumsProvider(new SpotifyConnector());
        $this->assertInstanceOf(SpotifyAlbumsProvider::class, $provider);
    }

    public function test_albums_obtained_from_soda_stereo()
    {
        $provider = new SpotifyAlbumsProvider(new SpotifyConnector());
        $result = $provider->getAlbums("soda stereo");
        $this->assertNotEmpty($result);
    }
}
