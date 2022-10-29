<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogTrait
{
    private function logError($mixedValue, $title=""): void
    {
        $content = $title;
        $content .= "\n".print_r($mixedValue, 1);
        Log::error($content);
    }
}
