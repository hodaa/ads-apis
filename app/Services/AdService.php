<?php

namespace App\Services;

use App\Models\Ad;
use Carbon\Carbon;

class AdService
{
    public function getAdsForTomorrow()
    {
        return Ad::with('advertiser')->where('start_date', Carbon::tomorrow()->toDateString())->get();
    }
}
