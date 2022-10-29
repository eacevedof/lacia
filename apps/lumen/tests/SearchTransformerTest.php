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
    private $anyResult;

    public function setUp(): void
    {
        $provider = new SpotifyAlbumsProvider(new SpotifyConnector());
        $this->albums = $provider->getAlbumsOrFail(self::BAND_NAME);
        $this->anyResult = (new SearchTransformer())->transformAlbums($this->albums);
    }

    /*
     *   /*
     *
        return $album ? [
            "name" => $album["name"] ?? "",
            "released" => $album["release_date"] ?? "",
            "tracks" => $album["total_tracks"] ?? "",
            "cover" => $this->transformCover($album["images"][0] ?? []),
        ] : [];

            return $image ? [
            "height" => $image["height"] ?? "",
            "width" => $image["width"] ?? "",
            "url" => $image["url"] ?? "",
        ]: [];

    objeto saliente

        name:
        released
        tracks:
        cover {
            heigh
            widh
            url
        }
  {
    "name": "Gira Me Verás Volver",
    "released": "2008-07-14",
    "tracks": 14,
    "cover": {
      "height": 640,
      "width": 640,
      "url": "https://i.scdn.co/image/ab67616d0000b27352cd84d57eb20d5e477a94a9"
    }
  },
     * */
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
        $this->assertIsArray($this->anyResult);
    }

    public function est_transformed_result_with_root_nodes()
    {

    }

    public function est_transformed_result_has_all_required_nodes()
    {

    }

}
