<?php

namespace Tests;

final class EnvTest extends TestCase
{
    public function test_not_empty_spotify_access_env_vars()
    {
        $clientId = env("SPOTIFY_CLIENT_ID", "");
        $clientId = trim($clientId);
        $clientSecret = env("SPOTIFY_CLIENT_SECRET", "");
        $clientSecret = trim($clientSecret);
        $this->assertNotEmpty($clientId);
        $this->assertNotEmpty($clientSecret);
    }
}
