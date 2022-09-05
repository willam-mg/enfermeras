@extends('layouts.app')

@section('title', 'Nuevo afiliado')

@section('content')
    {{ Breadcrumbs::render('afiliados.create') }}

    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-5">
            <form action="{{ route('afiliados.store') }}" method="POST" class="needs-validation"  enctype="multipart/form-data" novalidate>
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" name="numero_afiliado" class="form-control @error('numero_afiliado') is-invalid @enderror" placeholder="{{__("N° afiliado")}}" required>
                            <label class="form-label" for="numero_afiliado">{{__("N° afiliado")}}</label>
                            @error('numero_afiliado')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="cargo" class="form-control @error('cargo') is-invalid @enderror" placeholder="Cargo" required>
                            <label class="form-label" for="cargo">Cargo</label>
                            @error('cargo')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                        <div class="form-floating mb-3">
                            <input type="text" name="nombre_completo" class="form-control @error('nombre_completo') is-invalid @enderror" placeholder="Nombre" required>
                            <label class="form-label" for="nombre_completo">Nombre completo</label>
                            @error('nombre_completo')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="form-floating mb-3">
                            <input type="number" name="numero_matricula" class="form-control @error('numero_matricula') is-invalid @enderror" placeholder="{{__("N° matricula")}}" required>
                            <label class="form-label" for="numero_matricula">{{__("N° matricula")}}</label>
                            @error('numero_matricula')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-md-5">
                        <div class="form-floating mb-3">
                            <input type="number" name="ci" class="form-control @error('ci') is-invalid @enderror" placeholder="CI" required>
                            <label class="form-label" for="ci">CI</label>
                            @error('ci')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-7">
                        <div class="form-floating mb-3">
                            <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" placeholder="Fecha nacimiento" required>
                            <label class="form-label" for="fecha_nacimiento">Fecha nacimiento</label>
                            @error('fecha_nacimiento')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text" name="grupo_sanguineo" list="list_grupo_sanguineo" class="form-control @error('grupo_sanguineo') is-invalid @enderror" placeholder="{{__("G. sanguineo")}}" required>
                            <label class="form-label" for="grupo_sanguineo">{{__("G. sanguineo")}}</label>
                            @include('afiliado._list_grupo_sanguineo')
                            @error('grupo_sanguineo')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <div class="form-floating mb-3">
                            <input type="text" name="egreso" class="form-control @error('egreso') is-invalid @enderror" placeholder="Egreso" required>
                            <label class="form-label" for="egreso">Egreso</label>
                            @error('egreso')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <textarea name="domicilio" class="form-control @error('domicilio') is-invalid @enderror" placeholder="Domicilio" rows="5" required></textarea>
                    <label class="form-label" for="domicilio">Domicilio</label>
                    @error('domicilio')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" name="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="telefono" required>
                            <label class="form-label" for="telefono">Telefono</label>
                            @error('telefono')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" placeholder="Foto" required>
                            <label class="form-label" for="foto">Foto</label>
                            @error('foto')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-plus"></i>
                        {{ __('Registrar') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection