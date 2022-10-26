<div>
    <div class="row">
        <div class="col-xs-12 col-md-7">
            <div class="input-group mb-3">
                <input type="text" autofocus class="form-control" wire:model="fieldSearch" placeholder="{{__("Nombre completo, N° afiliado, C.I.")}}" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                    <i class="bi bi-search"></i>
                </button>
                {{-- <button type="button" class="btn btn-outline-primary" wire:click="$set('advancedFilter', true)" data-bs-toggle="modal" data-bs-target="#modal-search">
                    Busqueda avanzada
                </button> --}}
            </div>
        </div>
        <div class="col-xs-12 col-md-5">
            <div class="mb-3 text-end">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-create">
                    <i class="bi bi-plus"></i>
                    Nuevo afiliado
                </button>
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
                    <th scope="col" class="text-nowrap">{{__("Cargo")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Nombre completo")}}</th>
                    <th scope="col" class="text-nowrap">{{__("N° matricula")}}</th>
                    <th scope="col" class="text-nowrap">{{__("CI.")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Fecha nacimiento")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Egreso")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Telefono")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Fecha registro")}}</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr onclick="onSelectAfiliado({{$item->id}}, this, event)" title="Seleccionar Afiliado" >
                        <th scope="row">{{$item->id}}</th>
                        <td>
                            @if ($item->src_foto)
                                <img src="{{asset('storage/uploads/thumbnail-small/' . $item->src_foto)}}" alt="foto" width="50">
                            @else
                                <img src="/img/img_user_none.svg" alt="foto" width="50">
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
                        <td>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownActions" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownActions">
                                    <li>
                                        <button type="button" wire:click="$emitTo('afiliado.show-component', 'display-show', {{$item->id}})" class="dropdown-item" type="button">
                                            <i class="bi bi-eye"></i> Ver
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" wire:click="$emitTo('afiliado.edit', 'display-edit', {{$item->id}})" class="dropdown-item" type="button">
                                            <i class="bi bi-pencil"></i> Editar
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" onclick="destroyAfiliado({{$item->id}})" class="dropdown-item"
                                            type="button">
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
                de  {{$data->total()}} registros
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="btn-group float-end">
                {{$data->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <x-layout.loading/>
    
    {{-- modal --}}
    <div wire:ignore.self  class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-search" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" name="numero_afiliado" wire:model="modelFilter.numero_afiliado" class="form-control @error('numero_afiliado') is-invalid @enderror" placeholder="Nombre">
                                <label class="form-label" for="numero_afiliado">Numero de afiliado</label>
                                @error('numero_afiliado')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" name="nombre_completo" wire:model="modelFilter.nombre_completo" class="form-control @error('nombre_completo') is-invalid @enderror" placeholder="Nombre">
                                <label class="form-label" for="nombre_completo">Nombre completo</label>
                                @error('nombre_completo')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" name="ci" wire:model="modelFilter.ci" class="form-control @error('ci') is-invalid @enderror" placeholder="ci">
                                <label class="form-label" for="ci">Ci</label>
                                @error('ci')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="$set('advancedFilter', false)" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x"></i> 
                        Cerrar
                    </button>
                    <button type="button" wire:click="search" class="btn btn-primary">
                        <i class="bi bi-search"></i> 
                        Buscar
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- create modal --}}
    <livewire:afiliado.create-component />
    {{-- show modal --}}
    <livewire:afiliado.show-component/>
</div>
@push('scripts')
    <script>
        function onSelectAfiliado(idAfiliado, element, event) {
            if($(event.target).is('td, th, span')){
                @this.emitTo('afiliado.show-component', 'display-show', idAfiliado)
                $('tr').removeClass('table-secondary');
                $(element).addClass('table-secondary');
            }
        }

        function destroyAfiliado(id) {
            Swal.fire({
                title: "Afiliado",
                text: "¿ Esta seguro de eliminar este elemnto ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Si, eliminalo !'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.destroy(id);
                }
            })
        }
    </script>
@endpush
