<?php

namespace Tests;
use App\Providers\Spotify\SpotifyAlbumsProvider;
use App\Providers\Spotify\SpotifyConnector;
use App\Transformers\Albums\SearchTransformer;

final class SearchTransformerTest extends TestCase
{
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
        $this->albums = $provider->getAlbumsOrFail("soda stereo");
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

    }


    public function test_transformed_result_is_an_array()
    {
        $this->assertIsArray($this->anyResult);
    }

    public function test_transformed_result_with_root_nodes()
    {

    }

    public function test_transformed_result_has_all_required_nodes()
    {

    }

}
