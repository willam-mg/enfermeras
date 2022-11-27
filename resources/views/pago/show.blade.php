@extends('layouts.main')

@section('title', 'Modificar afiliado')

@section('content')
    {{ Breadcrumbs::render('aportes.show', $model) }}

    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-5">
            <ul class="list-group mb-3">
                <li class="list-group-item">
                    <b>{{__("Afiliado: ")}} </b>
                    {{$model->afiliado->nombre_completo}}
                </li>
                <li class="list-group-item">
                    <b>{{__("Gestion: ")}} </b>
                    {{$model->gestion}}
                </li>
                <li class="list-group-item">
                    <b>{{__("Mes: ")}} </b>
                    {{$model->mes}}
                </li>
                <li class="list-group-item">
                    <b>{{__("Monto: ")}} </b>
                    {{$model->monto}}
                </li>
                <li class="list-group-item">
                    <b>{{__("Pendiente: ")}} </b>
                    {{$model->pendiente}}
                </li>
            </ul>
        </div>
    </div>
@endsection
