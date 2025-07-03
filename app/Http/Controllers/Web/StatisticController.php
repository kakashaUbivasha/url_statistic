<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function redirect($url)
    {
        $short_url = Link::where('short_code', $url)->firstOrFail();
        $short_url->clicks()->create([
            'ip' => request()->ip(),
        ]);
        return redirect()->away($short_url->original_url);
    }
}
