<?php

namespace App\Exports;

use App\Models\city\City;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportUser implements FromCollection
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
        return User::whereBetween(
            DB::raw('DATE(created_at)'),
            [$this->request->start_date, $this->request->end_date]
        )->get();
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
