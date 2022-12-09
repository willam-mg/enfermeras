
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
                    <th scope="col" class="text-nowrap">{{__("Gestion")}}</th>
                    <th scope="col" class="text-nowrap">{{__("N° afiliado")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Nombre completo")}}</th>
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
                <tr onclick="onSelectObsequio({{$item->id}}, {{$item->estado}}, this, event)" title="Entregar obsequio" @if($item->estado==1) style="cursor:default;" @endif>
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
                        {{$item->gestion}}
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

