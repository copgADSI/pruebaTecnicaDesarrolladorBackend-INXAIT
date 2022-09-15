@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reporte <b>usuarios</b> registrados por fecha </div>

                <div class="card-body">
                    <form action="" method="get">
                        <div class="form-group d-flex">
                            <input type="date" class="form-control" value="{{$current_date}}">
                            <input type="date" class="form-control" value="{{$current_date}}">
                            <button class="btn btn-success">Generar Excel</button>
                        </div>
                    </form>
                </div>
                
            </div>

            <div class="card">
                <div class="card-header">Reporte de <b>sorteos</b> realizados por fecha </div>

                <div class="card-body">
                    <form action="" method="get">
                        <div class="form-group d-flex">
                            <input type="date" class="form-control" value="{{$current_date}}">
                            <input type="date" class="form-control" value="{{$current_date}}">
                            <button class="btn btn-success">Generar Excel</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection