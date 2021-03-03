@extends('layout')

@section('content')
<div class="table-responsive">
    <div class="col-xs-12 row">
        <div class="box-header">
            <h1 class="box-title">Clientes</h1>
        </div>

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
    <div class="box with-bcustomer">
        <div class="box-body table-responsive">
            <table id="table" class="table table-condensed table-hover dataTable" role="grid"
                aria-describedby="example1_info" style="overflow-y: auto">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apelidos</th>
                        <th>Correo</th>
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