@extends('layouts.app')

@section('title', 'Modificar afiliado')

@section('content')
    {{ Breadcrumbs::render('afiliados.edit', $model) }}

    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-5">
            <form action="{{ route('afiliados.update', $model->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <input type="text" name="nombre_completo" value="{{$model->nombre_completo}}" class="form-control @error('nombre_completo') is-invalid @enderror" placeholder="Nombre" required>
                    <label class="form-label" for="nombre_completo">Nombre completo</label>
                    @error('nombre_completo')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="ci"  value="{{$model->ci}}" class="form-control @error('ci') is-invalid @enderror" placeholder="ci" required>
                    <label class="form-label" for="ci">Ci</label>
                    @error('ci')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="telefono" value="{{$model->telefono}}" class="form-control @error('telefono') is-invalid @enderror" placeholder="telefono" required>
                    <label class="form-label" for="telefono">Telefono</label>
                    @error('telefono')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="celular"  value="{{$model->celular}}" class="form-control @error('celular') is-invalid @enderror" placeholder="celular" required>
                    <label class="form-label" for="celular">Celular</label>
                    @error('celular')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <textarea type="text" name="direccion" value="{{$model->direccion}}" class="form-control @error('direccion') is-invalid @enderror" placeholder="direccion" required>
                    </textarea>
                    <label class="form-label" for="direccion">Direccion</label>
                    @error('direccion')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-plus"></i>
                        {{ __('Modificar') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
