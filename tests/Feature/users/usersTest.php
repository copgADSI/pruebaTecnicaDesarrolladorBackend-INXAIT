<?php

namespace Tests\Feature\users;

use App\Models\city\City;
use App\Models\State\State;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class usersTest extends TestCase
{
    /**
     * Prueba para registro de usuario al concurso
     */
    public function test_user_register(): void
    {
        $state_id = State::all()->random()->id;
        $city_id = City::where('state_id', '=', $state_id)->inRandomOrder()->first()->id;

        $user_fields = [
            'name' => 'Roberto',
            'last_name' => 'Pérez',
            'citizenship_card' => '10512754321',
            'phone' =>  '3354598789',
            'email' => 'Roberto123Perez@mail.com',
            'state_id' => $state_id,
            'city_id' => $city_id,
            'habeas_data' => true
        ];

        $response =  $this->post(route('landingPage.store', $user_fields));
        dd($response);
        $this->assertDatabaseHas('users', $user_fields);
        $this->assertDatabaseCount('users', 1);
    }
}
