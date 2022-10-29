<?php

namespace App\Transformers\Albums;

final class SearchTransformer
{


    /*
     *
     * payload de spotify
     *        "album_group" => "album"
          "album_type" => "album"
          "artists" => array:1 [▶]
          "available_markets" => array:183 [▶]
          "external_urls" => array:1 [▶]
          "href" => "https://api.spotify.com/v1/albums/1cwZmK0zXorTlALtgOajeC"
          "id" => "1cwZmK0zXorTlALtgOajeC"
          "images" => array:3 [▶]
          "name" => "Gira Me Verás Volver"
          "release_date" => "2008-07-14"
          "release_date_precision" => "day"
          "total_tracks" => 14
          "type" => "album"
          "uri" => "spotify:album:1cwZmK0zXorTlALtgOajeC"

    objeto saliente

        name:
        released
        tracks:
        cover {
            heigh
            widh
            url
        }
     *
     * */

    public function transformAlbums(array $albums): array
    {
        //dd($albums);
        return array_map(function (array $item){
            return $this->transformAlbum($item);
        },$albums);
    }

    private function transformAlbum(array $album): array
    {
        return $album ? [
            "name" => $album["name"] ?? "",
            "released" => $album["release_date"] ?? "",
            "tracks" => $album["total_tracks"] ?? "",
            "cover" => $this->transformCover($album["images"][0] ?? []),
        ] : [];
    }

    private function transformCover(array $image): array
    {
        return $image ? [
            "height" => $image["height"] ?? "",
            "width" => $image["width"] ?? "",
            "url" => $image["url"] ?? "",
        ]: [];
    }
}
