<?php

namespace App\Services;

use App\Models\Link;

class StatisticService
{
    public function redirect($code)
    {
        $short_url = Link::where('short_code', $code)->firstOrFail();
        $short_url->clicks()->create([
            'ip' => request()->ip(),
        ]);
        return $short_url->original_url;
    }
}
