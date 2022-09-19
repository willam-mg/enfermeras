@extends('layouts.app')

@section('title', 'Nuevo pago')

@section('content')
    {{ Breadcrumbs::render('pagos.create') }}

    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-5">
            <form action="{{ route('pagos.store') }}" method="POST" class="needs-validation disabled-onsubmit" novalidate>
                @csrf
                @method('POST')
                <div class="form-floating  mb-3">
                    <select class="form-select @error('acreditacion_id') is-invalid @enderror" id="acreditacion_id" name="acreditacion_id" aria-label="Afiliado">
                        <option selected>{{__('Seleccione el afiliado')}}</option>
                        @foreach ($acreditaciones as $item)
                            <option value="{{$item->id}}">{{$item->afiliado->nombre_completo.' '$item->gestion.' '$item->mes}}</option>
                        @endforeach
                    </select>
                    <label for="acreditacion_id">Acreditacion</label>
                    @error('acreditacion_id')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="number" name="monto" class="form-control @error('monto') is-invalid @enderror" placeholder="Monto" required>
                    <label class="form-label" for="monto">Monto</label>
                    @error('monto')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
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
