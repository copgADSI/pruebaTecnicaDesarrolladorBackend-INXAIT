<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;

class ReportsController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return view('reports.index',[
            'current_date' => Carbon::now()->toDateString()
        ]);
    }
}
