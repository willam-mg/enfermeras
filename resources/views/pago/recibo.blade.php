@extends('layouts.app')

@section('title', 'Recibo')

@section('content')
    {{ Breadcrumbs::render('pagos.show', $model) }}
    <a href="{{url('pagos/recibopdf/'.$model->id)}}" class="btn btn-primary">
        <i class="bi bi-print"></i>
        Imprimir
    </a>
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-8">
            @include('pago._recibo')
        </div>
    </div>
@endsection
