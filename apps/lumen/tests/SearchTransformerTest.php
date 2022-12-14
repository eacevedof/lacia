<?php

namespace Tests;
use App\Providers\Spotify\SpotifyAlbumsProvider;
use App\Providers\Spotify\SpotifyConnector;
use App\Transformers\Albums\SearchTransformer;

final class SearchTransformerTest extends TestCase
{
    private const BAND_NAME = "Soda Stereo";

    private array $requiredNodes = [
        "albums" => [
            "root" => ["name", "release_date", "total_tracks", "images"],
            "images0" => ["height", "width", "url"]
        ],
        "result" => [
            "root" => ["name", "released", "tracks", "cover"],
            "cover" => ["height", "width", "url"]
        ],
    ];

    private $albums;
    private $anyTransformResult;

    public function setUp(): void
    {
        parent::setUp();
        $provider = new SpotifyAlbumsProvider(new SpotifyConnector());
        $this->albums = $provider->getAlbumsOrFail(self::BAND_NAME);
        $this->anyTransformResult = (new SearchTransformer())->transformAlbums($this->albums);
    }

    public function test_albums_is_an_array()
    {
        $this->assertIsArray($this->albums);
    }

    public function test_required_nodes_in_albums()
    {
        $reqRoot = $this->requiredNodes["albums"]["root"];
        $reqImg0 = $this->requiredNodes["albums"]["images0"];

        foreach ($this->albums as $i => $album) {
            $root = array_keys($album);
            $root = array_intersect($reqRoot, $root);
            if (count($root)!==count($reqRoot))
                $this->fail("not required nodes in album root $i");
            $image0 = array_keys($album["images"][0]);
            $image0 = array_intersect($reqImg0, $image0);
            if (count($image0)!==count($reqImg0))
                $this->fail("not required nodes in album image0 $i");
        }

        $this->assertTrue(count($this->albums)===($i+1));
    }

    public function test_transformed_result_is_an_array()
    {
        $this->assertIsArray($this->anyTransformResult);
    }

    public function test_required_nodes_in_transformed_array()
    {
        $reqRoot = $this->requiredNodes["result"]["root"];
        $reqCover = $this->requiredNodes["result"]["cover"];

        foreach ($this->anyTransformResult as $i => $album) {
            $root = array_keys($album);
            $root = array_intersect($reqRoot, $root);
            if (count($root)!==count($reqRoot))
                $this->fail("not required nodes in transformed root $i");

            $cover = array_keys($album["cover"]);
            $cover = array_intersect($reqCover, $cover);
            if (count($cover)!==count($reqCover))
                $this->fail("not required nodes in transformed cover $i");
        }
        $this->assertTrue(count($this->anyTransformResult)===($i+1));
    }
}
