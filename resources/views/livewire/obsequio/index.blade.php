
<div>
    <div class="row">
        <div class="col-xs-12 col-md-7">
            <div class="input-group mb-3">
                <input type="text" autofocus class="form-control" wire:model="fieldSearch" placeholder="{{__(" Nombre
                    completo, N° afiliado, C.I.")}}" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
        <div class="col-xs-12 col-md-5">
            <div class="mb-3 text-end">
                {{-- <button type="button" class="btn btn-success" wire:click="agregar()">
                    <i class="bi bi-plus"></i>
                    Agregar
                </button> --}}
            </div>
        </div>
    </div>
    
    <div class="table-responsive mb-3">
        <table class="table align-middle table-bordered table-hover table-row-pointer">
            <thead class="table-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="text-nowrap">{{__("Foto")}}</th>
                    <th scope="col" class="text-nowrap">{{__("N° afiliado")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Nombre completo")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Fecha_entrega")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Hora entrega")}}</th>
                    <th scope="col" class="text-nowrap">{{__("usuario")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Observacion")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Estado")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Acciones")}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                <tr title="Seleccionar Afiliado">
                    <th scope="row">{{$item->id}}</th>
                    <td>
                        @if ($item->afiliado)
                            @if ($item->afiliado->src_foto)
                            <img src="{{asset('storage/uploads/thumbnail-small/' . $item->afiliado->src_foto)}}" alt="foto" width="50">
                            @else
                            <img src="{{asset('images/img_user_none.svg')}}" alt="foto" width="50">
                            @endif
                        @else
                            <x-page.noexists :value="$item->afiliado_id" />
                        @endif
                    </td>
                    <td>
                        @if ($item->afiliado)
                            {{$item->afiliado->numero_afiliado}}
                        @else
                            <x-page.noexists :value="$item->afiliado_id" />
                        @endif
                    </td>
                    <td>
                        @if ($item->afiliado)
                            {{$item->afiliado->nombre_completo}}
                        @else
                            <x-page.noexists :value="$item->afiliado_id" /> 
                        @endif
                    </td>
                    <td>{{$item->fecha_entrega}}</td>
                    <td>{{$item->hora_entrega}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->observacion}}</td>
                    <td>
                        @if ($item->estado == 1)
                            <span class="badge rounded-pill bg-success">Entregado</span>
                        @else
                            <span class="badge rounded-pill bg-primary">Pendiente</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-primary" @if($item->estado==1) {{'disabled'}} @endif wire:click="entregar({{$item->id}})">
                            <i class="bi bi-check"></i>
                            Entregar
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="row mb-3">
        <div class="col-xs-12 col-md-6">
            <div>Mostrando {{($data->currentpage()-1)*$data->perpage()+1}} al {{$data->currentpage()*$data->perpage()}}
                de {{$data->total()}} registros
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="btn-group float-end">
                {{$data->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
    
    <x-page.loading />
</div>

