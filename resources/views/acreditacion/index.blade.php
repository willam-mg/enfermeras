@extends('layouts.app')

@section('title', 'Aportes')

@section('content')
    {{ Breadcrumbs::render('acreditaciones') }}
    <div class="text-end">
        <a href="{{url('/acreditaciones/create')}}" type="button" class="btn btn-success"  data-bs-toggle="tooltip"  data-bs-placement="top" title="Nueva acredtiacion">
            <i class="bi bi-plus"></i>
            Nuevo
        </a>
        
        <button class="btn btn-primary" type="button" {{$selected?'':'disabled'}} id="btnPreparar">
            <i class="bi bi-cash"></i>
            Pagar
        </button>
    </div>
    <form action="{{ url('acreditaciones') }}" method="POST" class="needs-validation disabled-onsubmit" novalidate>
        @csrf
        @method('GET')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-floating mb-3">
                    <select class="form-select select-search @error('afiliado_id') is-invalid @enderror" id="select_afiliado" name="afiliado_id" aria-label="Afiliado">
                        <option value="">{{__('Seleccione al afiliado')}}</option>
                        @foreach($afiliados as $key=>$item)
                            @if ($item->id == $model->afiliado_id)
                                <option value="{{$item->id}}" selected> {{$item->nombre_completo}} </option>
                            @else
                                <option value="{{$item->id}}"> {{$item->nombre_completo}} </option>
                            @endif
                        @endforeach
                    </select>
                    <label for="select_afiliado">Seleccionar afiliado</label>
                    @error('afiliado_id')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
                <div class="form-floating mb-3">
                    <input type="number" name="gestion" value="{{$model->gestion}}" list="list_gestiones" class="form-control @error('gestion') is-invalid @enderror" placeholder="gestion">
                    <label class="form-label" for="gestion">Gestion</label>
                    @include('acreditacion._list_gestiones')
                    @error('gestion')
                    <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
                <div class="form-floating mb-3">
                    <select class="form-select select-search @error('mes') is-invalid @enderror" id="mes" name="mes" aria-label="Afiliado">
                        <option value="" {{$model->mes == null?'selected':''}}>{{__('Todos')}}</option>
                        @include('acreditacion._options_meses')
                    </select>
                    <label for="mes">Mes</label>
                    @error('mes')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
                <div class="form-floating  mb-3">
                    <select class="form-select @error('pendiente') is-invalid @enderror" id="pendiente" name="pendiente" aria-label="Pagado">
                        <option value="" {{$model->pendiente == null?'selected':''}}>{{__('Todos')}}</option>
                        <option value="2" {{$model->pendiente == 2?'selected':''}}>{{__('Pagado')}}</option>
                        <option value="1" {{$model->pendiente == 1?'selected':''}}>{{__('Pendiente')}}</option>
                    </select>
                    <label for="pendiente">Pendiente</label>
                    @error('pendiente')
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

    

    <script>
        document.addEventListener("DOMContentLoaded", function(){
            var allChecked = false;
            $("#btnSelectAll").on("click", function() {
                $('.form-check-input').prop('checked', true);
            });
            $('#btnPreparar').on('click', function(e) {
                e.preventDefault();
                let myArray = [];
                $('input[name^="acreditaciones"]').each(function() {
                    if ($(this).prop("checked") === true) {
                        let id = $(this).val();
                        myArray.push(id);
                    }
                });
                if ( !myArray.length == 0 )  {
                    if ( confirm("Pagar estas mensualidades ?") ) {
                        var arrStr = encodeURIComponent(JSON.stringify(myArray));
                        window.location.href = '/pagos/create?seleccionados=' + arrStr;
                    }
                } else {
                    alert('No hay acreditaciones seleccionadas');
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

            $('.select-search').select2({
                theme: "bootstrap-5",
            });

            $('.select-search')
                .parent('div')
                .children('span')
                .children('span')
                .children('span')
                .css('height', ' calc(3.5rem + 2px)');
            $('.select-search')
                .parent('div')
                .children('span')
                .children('span')
                .children('span')
                .children('span')
                .css('margin-top', '18px');
            $('.select-search')
                .parent('div')
                .find('label')
                .css('z-index', '1');
            
        });
    </script>
    
@endsection

