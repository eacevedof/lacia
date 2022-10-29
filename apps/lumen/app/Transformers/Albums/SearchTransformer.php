<?php

namespace App\Transformers\Albums;

final class SearchTransformer
{
    public function transformAlbums(array $albums): array
    {
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
            //la imagen 0 es la de mayor tamaño
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
