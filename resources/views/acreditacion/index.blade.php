@extends('layouts.app')

@section('title', 'Acreditaciones')

@section('content')
    {{ Breadcrumbs::render('acreditaciones') }}
    <div class="text-end">
        <a href="{{url('/acreditaciones/create')}}" type="button" class="btn btn-success">
            <i class="bi bi-plus"></i>
            Nuevo
        </a>
        
        <button class="btn btn-primary" type="button" id="btnPreparar" data-bs-toggle="modal" data-bs-target="#modalPago">
            <i class="bi bi-cash"></i>
            Pagar
        </button>
    </div>
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
                                    {{-- <li>
                                        <a href="{{ route('acreditaciones.edit', $item->id) }}" class="dropdown-item" type="button">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                    </li> --}}
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
                        <td class="text-center align-middle" for="flexCheck-{{$item->id}}">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="acreditaciones[]" value="{{$item->id}}" id="flexCheck-{{$item->id}}">
                            </div>
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

    {{-- Modal --}}
    <div class="modal fade" tabindex="-1" id="modalPago">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('pagos/create') }}" method="POST" id="form_pagar" class="needs-validation disabled-onsubmit" novalidate>
                @csrf
                @method('GET')
                    <div class="modal-header">
                        <h5 class="modal-title">Meses seleccionados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" disabled id="btnGuardar">
                            <i class="bi bi-chevron-right"></i>
                            Contiunar
                        </button>
                    </div>
                </form>
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
                let html = "";
                $('input[name^="acreditaciones"]').each(function() {
                    if ($(this).prop("checked") === true) {
                        let id = $(this).val();
                        html += `<input name="seleccionados[]" value="${id}">`;
                    }
                });
                $('#form_pagar').append(html);
                $('#btnGuardar').removeAttr('disabled');
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

