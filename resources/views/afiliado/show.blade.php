@extends('layouts.app')

@section('title', 'Modificar afiliado')

@section('content')
    {{ Breadcrumbs::render('afiliados.edit', $model) }}

    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-3 mb-3">
            @if ($model->foto)
                <img src="{{$model->foto_thumbnail}}" alt="foto" width="100%">
            @else
                <img src="/img/no-image-user.png" alt="foto" width="100%">
            @endif
            <h4 class="mt-3">{{$model->nombre_completo}}</h4>
        </div>
        <div class="col-xs-12 col-md-5">
            <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Informacion</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link position-relative" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        Requisitos
                        <span class="position-absolute top-0 start-100 translate-middle p-2 {{$porcentajeColor}} border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                        {{-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill {{$porcentajeColor}}">
                            <small>
                                {{count($misRequisitos)}} / {{count($requisitos)}}
                            </small>
                        </span> --}}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-credicial-tab" data-bs-toggle="pill" data-bs-target="#pills-credencial" type="button" role="tab" aria-controls="pills-credencial" aria-selected="false">Credencial</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    @include('afiliado._datos')
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @include('afiliado._requisitos')
                </div>
                <div class="tab-pane fade" id="pills-credencial" role="tabpanel" aria-labelledby="pills-credencial-tab">
                    @include('afiliado._credencial')
                </div>
            </div>


        </div>
    </div>
@endsection
