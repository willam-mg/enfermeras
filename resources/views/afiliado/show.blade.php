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
            <div class="d-grid gap-2 mb-3">
                <a href="{{ route('afiliados.edit', $model->id) }}" class="btn btn-warning" type="button">
                    <i class="bi bi-pencil"></i> Editar
                </a>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                        Datos personales
                    </button>
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
                    <button class="nav-link" id="pills-credicial-tab" data-bs-toggle="pill" data-bs-target="#pills-credencial" type="button" role="tab" aria-controls="pills-credencial" aria-selected="false">
                        Credencial
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-acredtiaciones-tab" data-bs-toggle="pill" data-bs-target="#pills-acreditaciones" type="button" role="tab" aria-controls="pills-credencial" aria-selected="false">
                        Acreditaciones
                    </button>
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
                    @include('afiliado._tab-credencial')
                </div>
                <div class="tab-pane fade" id="pills-acreditaciones" role="tabpanel" aria-labelledby="pills-acreditaciones-tab">
                    <div class="text-end">
                        <button class="btn btn-primary" type="button" id="btnPreparar">
                            <i class="bi bi-cash"></i>
                            Pagar
                        </button>
                    </div>
                    <form action="{{ url('afiliados', $model->id) }}" method="POST" class="needs-validation disabled-onsubmit" novalidate>
                        @csrf
                        @method('GET')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="number" name="gestion" value="{{$acreditacionMd->gestion}}" list="list_gestiones" class="form-control @error('gestion') is-invalid @enderror" placeholder="gestion">
                                    <label class="form-label" for="gestion">Gestion</label>
                                    @include('acreditacion._list_gestiones')
                                    @error('gestion')
                                        <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3 pt-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i>
                                    {{ __('Buscar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @include('acreditacion._grid_acreditaciones')
                </div>
            </div>


        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function(){
            var allChecked = false;
            $("#btnSelectAll").on("click", function() {
                $('.form-check-input').prop('checked', true);
            });
            $('#btnPreparar').on('click', function(e) {
                e.preventDefault();
                if ( confirm("Pagar estas mensualidades ?") ) {
                    let myArray = [];
                    $('input[name^="acreditaciones"]').each(function() {
                        if ($(this).prop("checked") === true) {
                            let id = $(this).val();
                            myArray.push(id);
                        }
                    });
                    var arrStr = encodeURIComponent(JSON.stringify(myArray));
                    window.location.href = '/pagos/create?seleccionados=' + arrStr;
                }
            });

            function checkAll() {
                $('input[name^="acreditaciones"]').prop("checked", true);
            }
            $('#select_meses').on('click', function() {
                if (!allChecked) {
                    checkAll();
                    allChecked = true;
                } else {
                    $('input[name^="acreditaciones"]').prop("checked", false);
                    allChecked = false;
                }
            });
        });
    </script>
@endsection
