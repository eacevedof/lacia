<?php

namespace Tests;
use App\Providers\Spotify\SpotifyAlbumsProvider;
use App\Providers\Spotify\SpotifyConnector;
use App\Exceptions\Spotify\NoBandNameProvidedException;
use App\Exceptions\Spotify\BandNotFoundException;

final class SpotifyAlbumsProviderTest extends TestCase
{
    private const BAND_NAME = "soda stereo";
    private const NONEXISTENT_BAND_NAME = "This is A Weird Band Name";

    public function test_instance_of_albums_provider()
    {
        $provider = new SpotifyAlbumsProvider(new SpotifyConnector());
        $this->assertInstanceOf(SpotifyAlbumsProvider::class, $provider);
    }

    public function test_albums_obtained_from_soda_stereo()
    {
        $provider = new SpotifyAlbumsProvider(new SpotifyConnector());
        $result = $provider->getAlbumsOrFail(self::BAND_NAME);
        $this->assertNotEmpty($result);
    }

    public function test_no_band_name_exception_with_code_400()
    {
        $this->expectException(NoBandNameProvidedException::class);
        $provider = new SpotifyAlbumsProvider(new SpotifyConnector());
        $provider->getAlbumsOrFail("");
    }

    public function test_band_not_found_exception_with_code_404()
    {
        $this->expectException(BandNotFoundException::class);
        $provider = new SpotifyAlbumsProvider(new SpotifyConnector());
        $md5 = md5(self::NONEXISTENT_BAND_NAME);
        $provider->getAlbumsOrFail($md5);
    }
}
