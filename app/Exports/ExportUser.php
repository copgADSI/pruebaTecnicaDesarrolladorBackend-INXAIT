<?php

namespace App\Exports;

use App\Models\city\City;
use App\Models\State\State;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportUser implements FromCollection
{

    protected $request;
    protected $state_id;

    public function __construct($request)
    {
        $this->request = $request;
        if ($request->state_id === "ALL") {
            $this->state_id = State::all()->pluck('id')->toArray();
        } else {
            $this->state_id = [$request->state_id];
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::whereBetween(
            DB::raw('DATE(created_at)'),
            [$this->request->start_date, $this->request->end_date]
        )
        ->whereIn('state_id', $this->state_id)
        ->get();
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["ID", "Nombre", "Apellido", "Correo Electrónico", "Fecha Creación"];
    }
}
