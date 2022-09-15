@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reporte <b>usuarios</b> registrados por fecha y departamento</div>

                <div class="card-body">
                    @if($errors->any())
                    @foreach ($errors->all() as $err)
                    <li>{{ $err}} </li>
                    @endforeach
                    @else

                    @endif
                    <form action="{{ route('reports.generateUsers') }}" method="get">
                        @csrf
                        <div class="form-group d-flex">
                            <input type="date" name="start_date" class="form-control" value="{{$current_date}}">
                            <input type="date" name="end_date" class="form-control" value="{{$current_date}}">
                            <select name="state_id" id="state_id" class="form-control">
                                <option value="">Seleccionar Departamento...</option>
                                <option value="ALL" style="color: green">Todos</option>
                                @foreach ($states as $state )
                                <option value="{{$state->id}} "> {{ $state->state }} </option>
                                @endforeach
                            </select>
                            @error('state_id')

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <button type="submit" class="btn btn-success">Generar Excel</button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="card">
                <div class="card-header">Reporte de <b>sorteos</b> realizados por fecha </div>

                <div class="card-body">
                    <form action="{{route('reports.generateRaffles')}}" method="get">
                        <div class="form-group d-flex">
                            <input type="date" class="form-control" name="start_date" value="{{$current_date}}">
                            <input type="date" class="form-control" name="end_date" value="{{$current_date}}">
                            <button class="btn btn-success">Generar Excel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection