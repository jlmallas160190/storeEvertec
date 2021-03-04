@extends('layout')

@section('content')
<div class="col-xs-12 row">

    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('message') }}
    </div>
    @endif
    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error') }}
    </div>
    @endif
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Órdenes</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table" class="table table-condensed table-hover dataTable" role="grid"
                aria-describedby="example1_info" style="overflow-y: auto">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Correo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            {{$order->customer_name}}
                        </td>
                        <td>
                            {{$order->customer_mobile}}
                        </td>
                        <td>
                            @switch($order->status)
                            @case(\App\Constants\OrderStatus::CREATED)
                            <span class="label label-success bg-green">Creado</span>
                            @break
                            @case(\App\Constants\OrderStatus::APPROVED)
                            <span class="label bg-aqua">Pagado</span>
                            @break
                            @case(\App\Constants\OrderStatus::REJECTED)
                            <span class="label bg-green">Rechazado</span>
                            @break
                            @default
                            <span class="label bg-yellow">{{ $order->status }}</span>
                            @endswitch
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <button class="btn btn-primary">Crear</button>
        </div>
    </div>
</div>
@stop