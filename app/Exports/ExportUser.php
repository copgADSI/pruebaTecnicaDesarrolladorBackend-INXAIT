<?php

namespace App\Exports;

use App\Models\State\State;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class ExportUser implements FromCollection, WithHeadings ,WithEvents
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
        )->selectRaw('name, last_name, email, phone')
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
        return ["ID", "Nombre", "Apellido", "Correo Electrónico", "Teléfono"];
    }


     /**

     * Write code on Method

     *

     * @return response()

     */

    public function registerEvents(): array

    {

        return [

            AfterSheet::class    => function(AfterSheet $event) {

   

                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(2);

                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(50);

     

            },

        ];

    }
}
