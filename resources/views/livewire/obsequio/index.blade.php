
<div>
    <form wire:submit.prevent="search">
        <div class="row">
            <div class="col-xs-6 col-md-2">
                <div class="input-group mb-3" wire:click="openSelectAfiliado()">
                    <input type="text" class="form-control pe-auto" style="cursor:pointer" wire:model.defer="searchAfiliadoId" placeholder="{{__("Afiliado")}}" aria-label="Afiliado" aria-describedby="button-addon2" readonly 
                        title="Afiliado" data-bs-toggle="tooltip" data-bs-placement="top">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                        <i class="bi bi-hand-index"></i>
                    </button>
                </div>
            </div>
            <div class="col-xs-6 col-md-2">
                <div class="mb-3">
                    <input type="number" class="form-control" wire:model.defer="searchGestion" placeholder="{{__("Gestion")}}" 
                        title="Gestion" data-bs-toggle="tooltip" data-bs-placement="top">
                </div>
            </div>
            <div class="col-xs-6 col-md-2">
                <div class="mb-3">
                    <select type="text" class="form-select" wire:model.defer="searchUserId" placeholder="{{__("Registrado por")}}" 
                        title="Registrado por" data-bs-toggle="tooltip" data-bs-placement="top">
                        <option value="" selected>Registrado por</option>
                        @foreach ($users as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-md-2">
                <div class="mb-3">
                    <select type="text" class="form-select" wire:model.defer="searchEstado" placeholder="{{__("Estado")}}" 
                        title="Estado" data-bs-toggle="tooltip" data-bs-placement="top">
                        <option value="" selected>Estado</option>
                        <option value="2">Pendiente</option>
                        <option value="1">Entregado</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-md-2">
                <div class="mb-3">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i>
                        Buscar
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="table-responsive mb-3">
        <table class="table align-middle table-bordered table-hover table-row-pointer">
            <thead class="table-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="text-nowrap">{{__("Foto")}}</th>
                    <th scope="col" class="text-nowrap">{{__("N° afiliado")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Nombre completo")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Gestion")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Fecha_entrega")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Hora entrega")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Registrado por")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Observacion")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Estado")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Acciones")}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                <tr onclick="onSelectObsequio({{$item->id}}, {{$item->estado}}, this, event)"  @if($item->estado==1) style="cursor:default;" @else title="Entregar obsequio" data-bs-toggle="tooltip" data-bs-placement="top" @endif>
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
                    <td class="text-center align-middle">
                        <b>
                            {{$item->gestion}}
                        </b>
                    </td>
                    <td>{{$item->fecha_entrega}}</td>
                    <td>{{$item->hora_entrega}}</td>
                    <td>
                        @if ($item->user)
                            {{$item->user->name}}
                        @endif
                    </td>
                    <td>{{$item->observacion}}</td>
                    <td>
                        @if ($item->estado == 1)
                            <span class="badge rounded-pill bg-success">Entregado</span>
                        @else
                            <span class="badge rounded-pill bg-danger">Pendiente</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="obsequiosdropdownActions{{$item->id}}" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="obsequiosdropdownActions{{$item->id}}">
                                <li>
                                    <button type="button" @if($item->estado==1) {{'disabled'}} @endif
                                        wire:click="selectObsequio({{$item->id}})" class="dropdown-item" type="button">
                                        <i class="bi bi-check"></i> Entregar
                                    </button>
                                </li>
                                <li>
                                    <button type="button" wire:click="selectObsequio({{$item->id}}, true)" class="dropdown-item"
                                        type="button">
                                        <i class="bi bi-pencil"></i> Editar
                                    </button>
                                </li>
                                <li>
                                    <button type="button" onclick="destroyObsequio({{$item->id}})" class="dropdown-item" type="button">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
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
    
    @include('livewire.obsequio.create')
    <livewire:afiliado.select-afiliado key="obsequio-index">

    <x-page.loading />
    @push('scripts')
        <script>
            function onSelectObsequio(id, estado, element, event) {
                if (estado != 1) {
                    if($(event.target).is('td, th, span')){
                        @this.selectObsequio(id);
                        $('tr').removeClass('table-primary');
                        $(element).addClass('table-primary');
                    }
                }
            }
            function destroyObsequio(id) {
                
            }
            function obsequiosEntregar() {
                event.preventDefault();
                Swal.fire({
                    title: "Obsequios",
                    text: "¿ Registrar entrega ?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#1c8854',
                    confirmButtonText: 'Si registrar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('is sending');
                        // event.stopImmediatePropagation();
                        // event.stopImmediatePropagation();
                        @this.entregar();
                    } 
                    // else {
                    //     return false;
                    // }
                });
            }
        </script>
    @endpush
</div>

