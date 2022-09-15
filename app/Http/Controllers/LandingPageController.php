<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return view('LaginPage.index');
    }


    /**
     * Método usado para el registro de usuarios en la BD
     * @param Request
     * @param User
     * @return Response
     */
    public function store(Request $request, User $user)
    {
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
        $user->create($request->all());

        return $this->index();
    }
}
