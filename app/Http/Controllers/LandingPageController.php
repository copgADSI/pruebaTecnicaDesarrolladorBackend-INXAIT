<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LandingPage\LandingPageDashboard;
use App\Models\raffle\Raffle_winner;
use App\Models\State\State;
use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        $states = State::all()->toArray();
        return view('LaginPage.index', compact('states'));
    }


    /**
     * Método usado para el registro de usuarios en la BD
     * @param Request
     * @param User
     * @return Response
     */
    public function store(Request $request, User $user)
    {
        $user_data = $request->except(['_token']);
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'citizenship_card' => 'required|min:7|unique:users|numeric',
            'phone' => 'required|min:10|unique:users|numeric',
            'email' => 'required|email|unique:users',
            'state_id' => 'required|numeric',
            'city_id'   => 'required|numeric',
            'habeas_data' => 'required',
        ]);
        $user->create($user_data);
        return $this->index();
    }

    /**
     * Método usado para obtener ciudades del departamento seleccionado.
     * @param Request
     * @return Response
     */
    public function getCities(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $cities = (new LandingPageDashboard())
            ->generateCitiesByStateId($request->id);

        return response()->json([
            'total' => $cities->count(),
            'cities' => $cities->toArray()
        ], 200);
    }


    public function raffleView()
    {
        return view('Raffle.index');
    }

    /**
     * Método encargado de la generación del sorteo.
     * @param User
     * @param Raffle_winner
     * @return Response
     */
    public function generateRaffle(User $user, Raffle_winner $raffle)
    {
        $users = $user->all();
        if ($users->count() >= 5) {
            $raffle_winner = $user->inRandomOrder()->first();
            $raffle->create(['user_id' => $raffle_winner->id]);
            return response()->json(
                [
                    'winner' => "Último usuario ganador {$raffle_winner->name} {$raffle_winner->last_name} ",
                    'id' =>  $raffle_winner->id,
                    'email' => $raffle_winner->email
                ],
                200
            );
        } else {
            throw new \Exception('Para realizar el sorteo deben haber por lo menos 5 usuarios registrados');
        }
    }
}
