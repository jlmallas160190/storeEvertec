@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detalle de Órden</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label>Cliente: </label>
            <label>{{$order->customer_name}}</label>
        </div>
        <div class="form-group">
            <h3>Total <span class="label label-default">{{$order->total}}</span></h3>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            @if($order->status===\App\Constants\OrderStatus::CREATED)
            <form role="form" method="POST" action="/orders/complete-pay/{{$order->id}}">
                {{ csrf_field() }}
                <button class="btn btn-success" style="margin-right: 1rem"><i
                        class="fa fa-credit-card"></i>Pagar</button>
            </form>
            @endif
            <a type="button" class="btn btn-primary" href="/orders/index"><i class="fa fa-angle-left"></i>Regresar</a>
        </div>
    </div>
</div>
@stop