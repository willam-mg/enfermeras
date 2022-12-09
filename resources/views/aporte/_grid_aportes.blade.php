<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">
                    <a href="#" id="select_meses" data-bs-toggle="tooltip" title="Seleccionar todo">
                        <i class="bi bi-check2-square"></i>
                    </a>
                </th>
                <th scope="col">Afiliado</th>
                <th scope="col">Gestion</th>
                <th scope="col">Mes</th>
                <th scope="col">Monto</th>
                <th scope="col">Pagado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr>
                    <td class="align-middle" for="flexCheck-{{$item->id}}">
                        @if ($item->estado == \App\Models\Aporte::PENDIENTE) 
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{$selected === false?'disabled':''}} name="aportes[]" value="{{$item->id}}" id="flexCheck-{{$item->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$model->afiliado_id === null?'Seleccione el afiliado':'Mes '.$item->mes.' '.$item->gestion}}">
                            </div>
                        @else
                            <i class="bi bi-check2-square"></i>
                        @endif
                    </td>
                    <td>
                        @if ( $item->afiliado )
                            {{$item->afiliado->nombre_completo}}
                        @else
                            <span class="text-danger"> No existe ( {{$item->afiliado_id}} ) </span>
                        @endif
                    </td>
                    <td>{{$item->gestion}}</td>
                    <td class="text-capitalize">{{$item->mes}}</td>
                    <td>{{$item->monto}}</td>
                    <td>
                        @if ($item->estado == \App\Models\Aporte::PENDIENTE)
                            <span class="badge rounded-pill bg-danger">Pendiente</span>        
                        @else
                            <span class="badge rounded-pill bg-success">Pagado</span>        
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="aportes_dropdownActions{{$item->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="aportes_dropdownActions{{$item->id}}">
                                <li>
                                    <a href="{{ route('aportes.show', $item->id) }}" class="dropdown-item" type="button">
                                        <i class="bi bi-eye"></i> Ver
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('pagos/create', $item->id) }}" class="dropdown-item" type="button">
                                        <i class="bi bi-cash"></i> Pagar
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('aportes.edit', $item->id) }}" class="dropdown-item" type="button">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                </li>
                                <li>
                                    <form class="d-inline" action="{{ route('aportes.destroy',$item->id) }}" method="POST" data-confirm="Esta seguro de eliminar este elemento">
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row mb-3">
    <div class="col-xs-12 col-md-6">
        @if ($data) 
            <div>Mostrando {{($data->currentpage()-1)*$data->perpage()+1}} al {{$data->currentpage()*$data->perpage()}}
                de  {{$data->total()}} registros
            </div>
        @endif
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="btn-group float-end">
            {{-- {{ $data->links() }} --}}
            @if ($data) 
                {{$data->appends(request()->query())->links() }}
            @endif
        </div>
    </div>
</div>