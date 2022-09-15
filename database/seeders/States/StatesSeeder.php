<?php

namespace Database\Seeders\States;

use App\Models\State\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < count(State::COL_STATES); $i++) {
            $state = State::where('state', '=', State::COL_STATES[$i])->first();
            if (!is_null($state)) continue;
            State::create(['state' => State::COL_STATES[$i]]);
        }
    }
}
