@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registro Sorteo </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('landingPage.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control 
                                    @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required
                                    onkeydown="return /[a-z]/i.test(event.key)" autocomplete="name" autofocus>

                                <span class="invalid-feedback" role="alert">
                                    @error('name')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Apellido')
                                }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control 
                                    @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}" required autocomplete="last_name" autofocus
                                    onkeydown="return /[a-z]/i.test(event.key)">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="citizenship_card" class="col-md-4 col-form-label text-md-end">{{ __('Cédula de
                                Ciudadanía')
                                }}</label>

                            <div class="col-md-6">
                                <input id="citizenship_card" type="number"
                                    class="form-control @error('citizenship_card') is-invalid @enderror"
                                    name="citizenship_card" value="{{ old('citizenship_card') }}" required
                                    autocomplete="citizenship_card">

                                @error('citizenship_card')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Teléfono')
                                }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="number"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="state_id" class="col-md-4 col-form-label text-md-end">{{ __('Departamento')
                                }}</label>

                            <div class="col-md-6">
                                <select name="state_id" id="state_id"
                                    class="form-control @error('state_id') is-invalid @enderror"
                                    onchange="generateCitiesBystate_id(event)"
                                    class="form-control @error('state_id') is-invalid @enderror" required
                                    autocomplete="state_id">
                                    <option value="">Seleccionar...</option>
                                    @foreach ($states as $state)
                                    <option value="{{ $state['id'] }}"> {{ $state['state'] }} </option>
                                    @endforeach
                                </select>
                                @error('state_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="city_id" class="col-md-4 col-form-label text-md-end">{{ __('Ciudad')
                                }}</label>

                            <div class="col-md-6">
                                <select name="city_id" id="city_id" class="form-control" disabled
                                    class="form-control @error('city_id') is-invalid @enderror" required
                                    autocomplete="city_id">
                                    <option value="">Seleccionar...</option>
                                </select>
                                @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <span class="text-left">
                                Autorizo el tratamiento de mis datos de acuerdo con la
                                finalidad establecida en la política de protección de datos personales.
                                <input type="checkbox" value="1" onclick="handleBtnRegister(event)" name="habeas_data"
                                    id="habeas_data">
                            </span>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="register" disabled>
                                    {{ __('Registrar') }}
                                </button>
                                <button type="reset" class="btn btn-secondary">
                                    {{ __('Limpiar Formulario') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="raffle_container" style="height:300px">
    <button class="btn btn-success" onclick="getUserWinner()">¡Realizar Sorteo!</button><br>
    <div role="alert" id="winner" hidden>

    </div>
</div>
@endsection

<script>
    const handleBtnRegister = (e) => {
        const btnRegister = document.getElementById('register')
        return btnRegister.disabled = !btnRegister.disabled;
    }

    const generateCitiesBystate_id = async (e) => {
        const selectCities  = document.getElementById('city_id');

        const url = "{{ route('landingPage.cities') }}";
        const FULL_URL = url.concat(`?id=${e.target.value} `);
        const res = await fetch(FULL_URL);
        const {cities} = await res.json();
        var opcions ="<option value=''>Seleccionar...</option>";        
        Object.values(cities).forEach(item => {
            opcions+= `<option value=${item.id} > ${item.city} </option>`;
        });
        selectCities.innerHTML = opcions;
        selectCities.disabled = false;
    }

    const getUserWinner = async() => {
        const span_winner = document.getElementById('winner');
        const url = "{{route('landingPage.generate_raffle')}}";
        const response = await fetch(url);
        const {winner,alert} = await response.json();
        span_winner.setAttribute("class",alert);
        span_winner.textContent = winner;
        span_winner.hidden = false;
    }
</script>