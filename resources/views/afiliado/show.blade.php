@extends('layouts.app')

@section('title', 'Modificar afiliado')

@section('content')
    {{ Breadcrumbs::render('afiliados.edit', $model) }}

    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-3">
            @if ($model->foto)
                <img src="{{$model->foto_thumbnail}}" alt="foto" width="100%">
            @else
                <img src="/img/no-image-user.png" alt="foto" width="100%">
            @endif
        </div>
        <div class="col-xs-12 col-md-5">
            <ul class="list-group mb-3">
                <li class="list-group-item">
                    <b>{{__("N° afiliado: ")}} </b>
                    {{$model->numero_afiliado}}
                </li>
                <li class="list-group-item">
                    <b>{{__("Cargo: ")}} </b>
                    {{$model->cargo}}
                </li>
                <li class="list-group-item">
                    <b>{{__("Nombre completo: ")}} </b>
                    {{$model->nombre_completo}}
                </li>
                <li class="list-group-item">
                    <b>{{__("N° matricula: ")}} </b>
                    {{$model->numero_matricula}}
                </li>
                <li class="list-group-item">
                    <b>{{__("CI: ")}} </b>
                    {{$model->ci}}
                </li>
                <li class="list-group-item">
                    <b>{{__("Fecha de nacimiento: ")}} </b>
                    {{$model->fecha_nacimiento}}
                </li>
                <li class="list-group-item">
                    <b>{{__("Grupo sanguineo: ")}} </b>
                    {{$model->grupo_sanguineo}}
                </li>
                <li class="list-group-item">
                    <b>{{__("Egreso: ")}} </b>
                    {{$model->grupo_sanguineo}}
                </li>
                <li class="list-group-item">
                    <b>{{__("Domicilio: ")}} </b>
                    {{$model->domicilio}}
                </li>
                <li class="list-group-item">
                    <b>{{__("Telefono: ")}} </b>
                    {{$model->telefono}}
                </li>
                <li class="list-group-item">
                    <b>{{__("Fecha de regsitro: ")}} </b>
                    {{$model->fecha_registro}}
                </li>
            </ul>

            <div class="mb-3">
                <a href="{{ url('imprimir-credencial', $model->id) }}" class="btn btn-info">
                    <i class="bi bi-printer"></i>
                    Imprimir credencial
                </a>
            </div>

        </div>
    </div>
@endsection
