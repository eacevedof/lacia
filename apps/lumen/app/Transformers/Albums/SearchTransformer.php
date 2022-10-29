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



}
