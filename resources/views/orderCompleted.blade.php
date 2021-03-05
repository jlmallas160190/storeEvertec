@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detalle de Órden</h3>
    </div>
    <div class="card-body">
       <h3>Orden completada</h3>
    </div>
    <div class="card-footer">
        <div class="row">
            <a type="button" class="btn btn-primary" href="/orders/index"><i class="fa fa-angle-left"></i>Regresar</a>
        </div>
    </div>
</div>
@stop