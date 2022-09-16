<?php

namespace App\Exports;

use App\Models\raffle\Raffle_winner;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class ExportRaffles implements FromCollection, WithHeadings ,WithEvents
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
        return Raffle_winner::query()
            ->join('users', 'raffle_winners.user_id', '=', 'users.id')->whereBetween(
                DB::raw('DATE(raffle_winners.created_at)'),
                [$this->request->start_date, $this->request->end_date]
            )->selectRaw("CONCAT(name,' ' ,last_name) AS full_name, users.email")->get();
    }



    /**

     * Write code on Method

     *

     * @return response()

     */

    public function headings(): array
    {
        return ["Nombre y Apellido", "Correo Electrónico"];
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
