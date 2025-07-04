<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\StatisticService;

class StatisticController extends Controller
{
    public function redirect($url, StatisticService $service)
    {
        $originalUrl = $service->redirect($url);
        return redirect()->away($originalUrl);
    }
}
