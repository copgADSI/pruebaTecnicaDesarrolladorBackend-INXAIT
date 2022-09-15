<?php

namespace App\Http\Controllers\Reports;

use App\Exports\ExportRaffles;
use App\Exports\ExportUser;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LandingPage\ReportsDashboard;
use App\Models\State\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return view('reports.index', [
            'current_date' => Carbon::now()->toDateString(),
            'states' =>  State::all()
        ]);
    }


    /**
     * @param Request
     * @return Response
     */
    public function generateUsersReport(Request $request)
    {
        $request->validate([
            'state_id' => 'required',
            'start_date' =>  'required',
            'end_date' => 'required',
        ]);
        return Excel::download(
            new ExportUser($request),
            'usuarios.xlsx'
        );
    }

    /**
     * @param Request
     * @return Response
     */
    public function generateRafflesReport(Request $request)
    {
        $request->validate([
            'start_date' =>  $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return Excel::download(
            new ExportRaffles($request),
            'sorteos.xlsx'
        );
    }
}
