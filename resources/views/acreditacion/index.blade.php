@extends('layouts.app')

@section('title', 'Acreditaciones')

@section('content')
    {{ Breadcrumbs::render('acreditaciones') }}
    <div class="text-end">
        <a href="{{url('/acreditaciones/create')}}" type="button" class="btn btn-success">
            <i class="bi bi-plus"></i>
            Nuevo
        </a>
        
        <button class="btn btn-primary" type="button" id="btnPreparar">
            <i class="bi bi-cash"></i>
            Pagar
        </button>
    </div>
    <form action="{{ url('acreditaciones') }}" method="POST" class="needs-validation disabled-onsubmit" novalidate>
        @csrf
        @method('GET')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-floating">
                    <select class="form-select" id="select_afiliado" name="afiliado_id" aria-label="Afiliado">
                        <option value="">{{__('Seleccione al afiliado')}}</option>
                        @foreach($afiliados as $key=>$item)
                            @if ($item->id == $model->afiliado_id)
                                <option value="{{$item->id}}" selected> {{$item->nombre_completo}} </option>
                            @else
                                <option value="{{$item->id}}"> {{$item->nombre_completo}} </option>
                            @endif
                        @endforeach
                        <label for="select_afiliado">Seleccionar afiliado</label>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                    {{ __('Buscar') }}
                </button>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">
                        <a href="#" id="select_meses">
                            <i class="bi bi-check2-square"></i>
                        </a>
                    </th>
                    <th scope="col">Afiliado</th>
                    <th scope="col">Gestion</th>
                    <th scope="col">Mes</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Pagado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownActions" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownActions">
                                    <li>
                                        <a href="{{ route('acreditaciones.show', $item->id) }}" class="dropdown-item" type="button">
                                            <i class="bi bi-eye"></i> Ver
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('pagos/create', $item->id) }}" class="dropdown-item" type="button">
                                            <i class="bi bi-cash"></i> Pagar
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('acreditaciones.edit', $item->id) }}" class="dropdown-item" type="button">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        <form class="d-inline" action="{{ route('acreditaciones.destroy',$item->id) }}" method="POST" data-confirm="Esta seguro de eliminar este elemnto">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </li>
                                    
                                </ul>
                            </div>
                        </td>
                        <td class="align-middle" for="flexCheck-{{$item->id}}">
                            @if ($item->pendiente == false) 
                                <i class="bi bi-check2-square"></i>
                            @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="acreditaciones[]" value="{{$item->id}}" id="flexCheck-{{$item->id}}">
                                </div>
                            @endif
                        </td>
                        <td>{{
                        $item->afiliado?$item->afiliado->nombre_completo:$item->afiliado_id}}</td>
                        <td>{{$item->gestion}}</td>
                        <td class="text-capitalize">{{$item->mes}}</td>
                        <td>{{$item->monto}}</td>
                        <td>
                            @if ($item->pendiente) 
                                <span class="badge bg-danger">Pendiente</span>        
                            @else
                                <span class="badge bg-success">Pagado</span>        
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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
                var arrStr = encodeURIComponent(JSON.stringify(myArray));
                window.location.href = '/pagos/create?seleccionados=' + arrStr;
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

            $('#select_afiliado').select2({
                selectionCssClass:'form-select',
                theme: "bootstrap-5",
                containerCssClass: "form-floating mb-3"
            });
        });
    </script>
@endsection

