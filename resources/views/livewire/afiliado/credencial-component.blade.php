<div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-credencial-home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tab-credencial-nuevo" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="tab-credencial-home" role="tabpanel" aria-labelledby="home-tab">

            
            <h1>{{$idCredencial}}</h1>
            <a href="{{ url('imprimir-credencial/'.$idCredencial.'/front') }}" target="_blank" class="btn btn-primary">
                <i class="bi bi-printer"></i>
                Frontal 
            </a>
            <a href="{{ url('imprimir-credencial/'.$idCredencial.'/back') }}" target="_blank" class="btn btn-info">
                <i class="bi bi-printer"></i>
                Trasero  
            </a>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-credencial">
                Registrar Entrega de Credencial
            </button>
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
        <div class="tab-pane fade" id="tab-credencial-nuevo" role="tabpanel" aria-labelledby="profile-tab">
            
            <form wire:submit.prevent="save">
                <div class="form-floating mb-3">
                    <input type="date" name="fecha_emision" wire:model.defer="fecha_emision"  class="form-control">
                    <label class="form-label" for="fecha_nacimiento">Fecha emision</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" name="fecha_vensimiento" wire:model.defer="fecha_vencimiento" class="form-control">
                    <label class="form-label" for="fecha_nacimiento">Fecha vencimiento</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="renovacion" wire:model.defer="renovacion" class="form-control" >
                    <label class="form-label" for="renovacion">{{__("Renovacion")}}</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="costo_renovacion" wire:model.defer="costo_renovacion" class="form-control" >
                    <label class="form-label" for="costo_renovacion">{{__("Costo de renovacion")}}</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="estado" wire:model.defer="estado" class="form-control" >
                    <label class="form-label" for="estado">{{__("Estado")}}</label>
                </div>
                <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:target="file">
                    <i class="bi bi-plus"></i>
                    {{ __('Registrar') }}
                </button>
            </form>

        </div>
    </div>

</div>