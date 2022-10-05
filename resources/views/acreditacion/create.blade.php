@extends('layouts.app')

@section('title', 'Nuevo usuario')

@section('content')
    {{ Breadcrumbs::render('acreditaciones.create') }}

    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-5">
            <form action="{{ route('acreditaciones.store') }}" method="POST" class="needs-validation disabled-onsubmit" novalidate>
                @csrf
                @method('POST')
                <div class="form-floating  mb-3">
                    <select class="form-select @error('afiliado_id') is-invalid @enderror" id="afiliado_id" name="afiliado_id" aria-label="Afiliado">
                        <option selected>{{__('Seleccione el afiliado')}}</option>
                        @foreach ($afiliados as $item)
                            <option value="{{$item->id}}">{{$item->nombre_completo}}</option>
                        @endforeach
                    </select>
                    <label for="afiliado_id">Afiliado</label>
                    @error('afiliado_id')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="number" name="gestion" list="list_gestiones"  class="form-control @error('gestion') is-invalid @enderror" placeholder="Gestion" required>
                    <label class="form-label" for="gestion">Gestion</label>
                    <datalist id="list_gestiones">
                        <option value="2020">
                        <option value="2021">
                        <option value="2022">
                        <option value="2023">
                        <option value="2024">
                        <option value="2025">
                        <option value="2026">
                        <option value="2027">
                        <option value="2028">
                        <option value="2029">
                        <option value="2030">
                        <option value="2031">
                        <option value="2032">
                        <option value="2033">
                        <option value="2034">
                        <option value="2035">
                        <option value="2036">
                        <option value="2037">
                        <option value="2038">
                        <option value="2039">
                        <option value="2040">
                        <option value="2041">
                        <option value="2042">
                        <option value="2043">
                        <option value="2044">
                        <option value="2045">
                    </datalist>
                    @error('gestion')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                <div class="form-floating  mb-3">
                    <select class="form-select @error('mes') is-invalid @enderror" id="mes" name="mes" aria-label="Afiliado">
                        <option selected>{{__('Seleccione el Mes')}}</option>
                        @include('acreditacion._options_meses')
                    </select>
                    <label for="mes">Mes</label>
                    @error('mes')
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
