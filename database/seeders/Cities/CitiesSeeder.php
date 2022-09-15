<?php

namespace Database\Seeders\Cities;

use App\Models\city\City;
use App\Models\State\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.min.json');
        $response_data = $response->json();

        foreach ($response_data as $item) {
            $state_id =  State::where('state', '=', $item['departamento'])->first()->id;
            foreach ($item['ciudades'] as  $city) {
                $validate_city = City::where('city', '=', $city)->first();
                if (!is_null($validate_city)) continue;
                City::create([
                    'city' => $city,
                    'state_id' =>  $state_id
                ]);
            }
        }
    }
}
