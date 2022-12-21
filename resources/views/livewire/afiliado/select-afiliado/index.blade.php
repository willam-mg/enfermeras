<div>
    <div wire:ignore.self class="modal" id="modal-select-afiliado" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Seleccionar afiliado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($advancedFilter) 
                        <form wire:submit.prevent="searchAfiliado">
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" wire:model.defer="afiliadoNumeroAfiliado" placeholder="{{__(" Numero
                                            de afiliado")}}" title="Numero de afiliado" data-bs-toggle="tooltip" data-bs-placement="top">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" wire:model.defer="afiliadoNombreCompleto" placeholder="{{__(" Nombre
                                            completo")}}" title="Nombre completo" data-bs-toggle="tooltip" data-bs-placement="top">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" wire:model.defer="afiliadoCi" placeholder="{{__(" C.I.")}}"
                                            title="C.I." data-bs-toggle="tooltip" data-bs-placement="top">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <div class="mb-3">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="bi bi-search"></i>
                                            Buscar
                                        </button>
                                        <button class="btn btn-outline-secondary" wire:click="$set('advancedFilter', false)" title="Busqueda simple" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="bi bi-filter"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control pe-auto" wire:model="searchField"
                                        placeholder="{{__(" Nombre completo, ci")}}" aria-label="Afiliado"
                                        aria-describedby="wireselect-afiliado-button-addon2">
                                    <button class="btn btn-outline-secondary" type="button" id="wireselect-afiliado-button-addon2">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 text-end">
                                <button class="btn btn-outline-secondary" wire:click="$set('advancedFilter', true)" title="Busqueda avanzada" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <i class="bi bi-filter"></i>
                                </button>
                            </div>
                        </div>
                    @endif
    
                    <div class="table-responsive mb-3">
                        <table class="table align-middle table-bordered table-hover table-row-pointer">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col" class="text-nowrap">{{__("Foto")}}</th>
                                    <th scope="col" class="text-nowrap">{{__("N° afiliado")}}</th>
                                    <th scope="col" class="text-nowrap">{{__("Cargo")}}</th>
                                    <th scope="col" class="text-nowrap">{{__("Nombre completo")}}</th>
                                    <th scope="col" class="text-nowrap">{{__("N° matricula")}}</th>
                                    <th scope="col" class="text-nowrap">{{__("CI.")}}</th>
                                    <th scope="col" class="text-nowrap">{{__("Fecha nacimiento")}}</th>
                                    <th scope="col" class="text-nowrap">{{__("Egreso")}}</th>
                                    <th scope="col" class="text-nowrap">{{__("Telefono")}}</th>
                                    <th scope="col" class="text-nowrap">{{__("Fecha registro")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($afiliados as $key => $item)
                                <tr onclick="wireSelectAfiliado({{$item->id}}, this, event)"
                                    title="Seleccionar Afiliado" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <th scope="row">{{$item->id}}</th>
                                    <td>
                                        @if ($item->src_foto)
                                        <img src="{{asset('storage/uploads/thumbnail-small/' . $item->src_foto)}}"
                                            alt="foto" width="50">
                                        @else
                                        <img src="{{asset('images/img_user_none.svg')}}" alt="foto" width="50">
                                        @endif
                                    </td>
                                    <td>{{$item->numero_afiliado}}</td>
                                    <td>{{$item->cargo}}</td>
                                    <td>{{$item->nombre_completo}}</td>
                                    <td>{{$item->numero_matricula}}</td>
                                    <td>{{$item->ci}}</td>
                                    <td>{{$item->fecha_nacimiento}}</td>
                                    <td>{!! Str::limit($item->egreso, 5, ' ...') !!}</td>
                                    <td>{{$item->telefono}}</td>
                                    <td>{{$item->fecha_registro}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
    
                    <div class="row mb-3">
                        <div class="col-xs-12 col-md-6">
                            <div>Mostrando {{($afiliados->currentpage()-1)*$afiliados->perpage()+1}} al
                                {{$afiliados->currentpage()*$afiliados->perpage()}}
                                de {{$afiliados->total()}} registros
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="btn-group float-end">
                                {{$afiliados->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-page.loading />
    @push('scripts')
    <script>
        function wireSelectAfiliado(id) {
            @this.selectAfiliado(id);
        }
    </script>
    @endpush
</div>
