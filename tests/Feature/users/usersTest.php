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
        $rand = rand(3, 100);
        $user_fields = [
            'name' => 'Cristian',
            'last_name' => 'Parada Gualteros',
            'citizenship_card' => mt_rand(1000000000, 9999999999),
            'phone' =>  mt_rand(1000000000, 9999999999),
            'email' => "cristian{$rand}@mail.es",
            'state_id' => $state_id,
            'city_id' => $city_id,
            'habeas_data' => 1
        ];
        $this->post(route('landingPage.store', $user_fields));
        $this->assertDatabaseHas('users', $user_fields);
    }

    /**
     * Comprueba la obtención de ciudades dependiendo 
     * del departamento seleccionado.
     */
    public function test_a_get_cities_by_state(): void
    {
        $state_id = State::all()->random()->id;
        $response = $this->get(route('landingPage.cities', ['id' => $state_id]));
        $response_data = $response->json();
        foreach ($response_data['cities'] as $city) {
            //$this->assertArrayHasKey($city, $response_data['cities']);
            $this->assertDatabaseHas('cities', $city);
        }
        $response->assertStatus(200);
    }
}
