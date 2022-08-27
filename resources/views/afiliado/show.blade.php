@extends('layouts.app')

@section('title', 'Modificar afiliado')

@section('content')
    {{ Breadcrumbs::render('afiliados.edit', $model) }}

    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-5">
            <ul class="list-group mb-3">
                <li class="list-group-item">
                    <b>Nombre completo: </b>
                    {{$model->nombre_completo}}
                </li>
                <li class="list-group-item">
                    <b>Ci: </b>
                    {{$model->ci}}
                </li>
                <li class="list-group-item">
                    <b>Telefono: </b>
                    {{$model->telefono}}
                </li>
                <li class="list-group-item">
                    <b>Celular: </b>
                    {{$model->celular}}
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
