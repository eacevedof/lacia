<?php

namespace Tests;
use App\Providers\Spotify\SpotifyAlbumsProvider;
use App\Providers\Spotify\SpotifyConnector;
use App\Exceptions\Spotify\NoBandNameProvidedException;
use App\Exceptions\Spotify\BandNotFoundException;

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

    public function test_no_band_name_exception_with_code_400()
    {
        $this->expectException(NoBandNameProvidedException::class);
        $provider = new SpotifyAlbumsProvider(new SpotifyConnector());
        $provider->getAlbums("");
    }

    public function test_band_not_found_exception_with_code_204()
    {
        $this->expectException(BandNotFoundException::class);
        $provider = new SpotifyAlbumsProvider(new SpotifyConnector());
        $md5 = md5("this is a weird band name ".date("Y-m-d"));
        $provider->getAlbums($md5);
    }
}
