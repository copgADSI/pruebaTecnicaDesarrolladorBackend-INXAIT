<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LandingPageDashboard extends Controller
{
    public function generateCitiesByStateId(int $state_id): Collection
    {
        return DB::table('cities')->where('state_id', '=', $state_id)->get();
    }
}
