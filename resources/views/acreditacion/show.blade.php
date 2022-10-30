@extends('layouts.app')

@section('title', 'Modificar afiliado')

@section('content')
    {{ Breadcrumbs::render('acreditaciones.show', $model) }}

    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-5">
            <ul class="list-group mb-3">
                <li class="list-group-item">
                    <b>{{__("Afiliado: ")}} </b>
                    @if ( $model->afiliado )
                        {{$model->afiliado->nombre_completo}}
                    @else
                        <span class="text-danger"> No existe ( {{$model->afiliado_id}} ) </span>
                    @endif
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
