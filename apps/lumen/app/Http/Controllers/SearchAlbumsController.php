<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

final class SearchAlbumsController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json("ok");
    }
}
