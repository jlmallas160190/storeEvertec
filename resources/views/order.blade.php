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
                        <th>Teléfono</th>
                        <th>Subtotal</th>
                        <th>Impuesto</th>
                        <th>Descuento</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Accciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            {{$order->customer_name}}
                        </td>
                        <td>
                            {{$order->customer_email}}
                        </td>
                        <td>
                            {{$order->customer_mobile}}
                        </td>
                        <td>
                            {{$order->subtotal}}
                        </td>
                        <td>
                            {{$order->tax}}
                        </td>
                        <td>
                            {{$order->discount}}
                        </td>
                        <td>
                            {{$order->total}}
                        </td>
                        <td>
                            @switch($order->status)
                            @case(\App\Constants\OrderStatus::CREATED)
                            <span class="label label-success bg-blue">Creado</span>
                            @break
                            @case(\App\Constants\OrderStatus::PENDING)
                            <span class="label label-success bg-yellow">Pendiente</span>
                            @break
                            @case(\App\Constants\OrderStatus::APPROVED)
                            <span class="label  bg-green">Pagado</span>
                            @break
                            @case(\App\Constants\OrderStatus::REJECTED)
                            <span class="label bg-red">Rechazado</span>
                            @break
                            @case(\App\Constants\OrderStatus::FAILED)
                            <span class="label bg-red">Fallido</span>
                            @break
                            @default
                            <span class="label bg-yellow">{{ $order->status }}</span>
                            @endswitch
                        </td>
                        <td>
                            @if($order->status===\App\Constants\OrderStatus::CREATED) <a type="button"
                                class="btn btn-success" href="pay/{{$order->id}}"><i class="fa fa-credit-card"></i>Pagar</a>@endif
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