<div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h4>
                Obsequios
                <div wire:loading wire:target="search" style="display: none" class="spinner-border spinner-border-sm"
                    role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </h4>
        </div>
        
    </div>
    <div class="table-responsive mb-3">
        <table class="table align-middle table-bordered table-hover table-row-pointer">
            <thead class="table-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="text-nowrap">{{__("Año")}}</th>
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
                <tr onclick="onSelectMiObsequio({{$item->id}}, {{$item->estado}}, this, event)" title="Entregar obsequio" @if($item->estado==1) style="cursor:default;" @endif>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->gestion}}</td>
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
                            <button class="btn dropdown-toggle" type="button" id="misobsequiosdropdownActions{{$item->id}}" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="misobsequiosdropdownActions{{$item->id}}">
                                <li>
                                    <button type="button" @if($item->estado==1) {{'disabled'}} @endif wire:click="selectObsequio({{$item->id}})" class="dropdown-item" type="button">
                                        <i class="bi bi-check"></i> Entregar
                                    </button>
                                </li>
                                <li>
                                    <button type="button" wire:click="selectObsequio({{$item->id}}, true)"
                                        class="dropdown-item" type="button">
                                        <i class="bi bi-pencil"></i> Editar
                                    </button>
                                </li>
                                <li>
                                    <button type="button" onclick="destroyMiObsequio({{$item->id}})" class="dropdown-item" type="button">
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

    @include('livewire.afiliado.mis-obsequios.create')

    <x-page.loading />

    @push('scripts')
        <script>
            function onSelectMiObsequio(id, estado, element, event) {
                if (estado != 1) {
                    if($(event.target).is('td, th, span')){
                        @this.selectObsequio(id);
                        $('tr').removeClass('table-primary');
                        $(element).addClass('table-primary');
                    }
                }
            }
            function destroyMiObsequio(id) {
                
            }
            function misObsequiosEntregar() {
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