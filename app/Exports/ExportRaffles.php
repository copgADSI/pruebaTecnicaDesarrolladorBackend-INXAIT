<?php

namespace App\Exports;

use App\Models\raffle\Raffle_winner;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportRaffles implements FromCollection
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Raffle_winner::all();
        return Raffle_winner::whereBetween(
            DB::raw('DATE(created_at)'),
            [$this->request->start_date, $this->request->end_date]
        )->get();
    }
}
