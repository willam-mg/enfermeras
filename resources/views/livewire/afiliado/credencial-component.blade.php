<div>
    <h1>{{$idCredencial}}</h1>
    <a href="{{ url('imprimir-credencial/'.$idCredencial.'/front') }}" target="_blank" class="btn btn-primary">
        <i class="bi bi-printer"></i>
        Frontal 
    </a>
    <a href="{{ url('imprimir-credencial/'.$idCredencial.'/back') }}" target="_blank" class="btn btn-info">
        <i class="bi bi-printer"></i>
        Trasero  
    </a>
    <div class="table-responsive mb-3">
        <table class="table align-middle table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="text-nowrap">{{__("Fecha de registro")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Fecha de emisión")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Fecha de vencimiento")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Renovación")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Costo de renovación")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Estado")}}</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                    @foreach ($data as $key => $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->fecha_registro}}</td>
                            <td>{{$item->fecha_emision}}</td>
                            <td>{{$item->fecha_vencimiento}}</td>
                            <td>
                                @if ($item->renovacion == 1) 
                                    <span class="badge rounded-pill bg-success">Si</span>        
                                @else
                                    <span class="badge rounded-pill bg-primary">No</span>        
                                @endif
                            </td>
                            <td>{{$item->costo_renovacion}}</td>
                            <td>
                                @if ($item->estado == 1) 
                                    <span class="badge rounded-pill bg-success">Entregado</span>        
                                @else
                                    <span class="badge rounded-pill bg-primary">Pendiente</span>        
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownActions" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownActions">
                                        <li>
                                            <button type="button" wire:click="$set('idCredencial', '{{$item->id}}')" class="dropdown-item" type="button">
                                                <i class="bi bi-eye"></i> Seleccionar
                                            </button>
                                        </li>
                                        {{-- <li>
                                            <button wire:click="edit({{$item}})"  class="dropdown-item" type="button">
                                                <i class="bi bi-pencil"></i> Editar
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" wire:click="delete({{$item}})"  class="dropdown-item"">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </li> --}}
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    @if (count($data) > 0)
        <div class="row mb-3">
            <div class="col-xs-12 col-md-6">
                <div>Mostrando {{($data->currentpage()-1)*$data->perpage()+1}} al {{$data->currentpage()*$data->perpage()}}
                    de  {{$data->total()}} registros
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="btn-group float-end">
                    {{$data->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
