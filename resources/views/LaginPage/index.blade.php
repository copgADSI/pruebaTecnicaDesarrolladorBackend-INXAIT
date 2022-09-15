@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registro Sorteo </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control 
                                    @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required
                                    autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('Apellido')
                                }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control 
                                    @error('lastname') is-invalid @enderror" name="lastname"
                                    value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="citizenship" class="col-md-4 col-form-label text-md-end">{{ __('Cédula de
                                Ciudadanía')
                                }}</label>

                            <div class="col-md-6">
                                <input id="citizenship" type="number"
                                    class="form-control @error('citizenship') is-invalid @enderror" name="citizenship"
                                    value="{{ old('citizenship') }}" required autocomplete="citizenship">

                                @error('citizenship')
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
                            <label for="state" class="col-md-4 col-form-label text-md-end">{{ __('Departamento')
                                }}</label>

                            <div class="col-md-6">
                                <select name="state" id="state" class="form-control"
                                    class="form-control @error('state') is-invalid @enderror" required
                                    autocomplete="state">
                                    <option value="">Seleccionar...</option>
                                </select>
                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('Ciudad')
                                }}</label>

                            <div class="col-md-6">
                                <select name="city" id="city" class="form-control"
                                    class="form-control @error('city') is-invalid @enderror" required
                                    autocomplete="city">
                                    <option value="">Seleccionar...</option>
                                </select>
                                @error('city')
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
                                <input type="checkbox" onclick="handleBtnRegister(event)" name="habeas_data" id="habeas_data">
                            </span>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="register" disabled>
                                    {{ __('Registrar') }}
                                </button>
                                <button type="button" class="btn btn-secondary">
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
@endsection

<script>
    const handleBtnRegister = (e) => {
        const btnRegister = document.getElementById('register')
        return btnRegister.disabled = !btnRegister.disabled;
    }
</script>