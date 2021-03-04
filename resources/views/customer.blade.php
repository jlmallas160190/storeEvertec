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
        <h3 class="card-title">Clientes</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table" class="table table-condensed table-hover dataTable" role="grid"
                aria-describedby="example1_info" style="overflow-y: auto">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apelidos</th>
                        <th>Correo</th>
                        <th>Celular</th>
                        <th>Dirección</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>
                            @if( $customer->user)
                            {{$customer->user->first_name}}
                            @endif
                        </td>
                        <td>
                            @if( $customer->user)
                            {{$customer->user->last_name}}
                            @endif
                        </td>
                        <td>
                            @if( $customer->user)
                            {{$customer->user->email}}
                            @endif
                        </td>
                        <td>
                            @if( $customer->user)
                            {{$customer->user->mobile}}
                            @endif
                        </td>
                        <td>
                            @if( $customer->user)
                            {{$customer->user->address}}
                            @endif
                        </td>
                    </tr>

                    @endforeach
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@stop