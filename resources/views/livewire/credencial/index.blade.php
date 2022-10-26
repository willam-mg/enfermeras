<div>
    <div class="row mb-3">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <a href="{{ url('imprimir-credencial/'.$idCredencial.'/front') }}" target="_blank" class="btn btn-primary {{!$idCredencial?'disabled':''}}" wire:loading.class="disabled">
                <i class="bi bi-printer"></i>
                Frontal {{$idCredencial?'('.$idCredencial.')':''}}
            </a>
            <a href="{{ url('imprimir-credencial/'.$idCredencial.'/back') }}" target="_blank" class="btn btn-info {{!$idCredencial?'disabled':''}}" wire:loading.class="disabled">
                <i class="bi bi-printer"></i>
                Trasero {{$idCredencial?'('.$idCredencial.')':''}}
            </a>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 text-end">
            <button type="button" class="btn btn-success" wire:click="$emitTo('credencial.create', 'setIdAfiliado', {{$paramId}})">
                <i class="bi bi-plus"></i> Agregar credencial
            </button>
        </div>
    </div>

    <div class="table-responsive mb-3">
        <table id="credencial_table" class="table align-middle table-bordered table-hover table-row-pointer">
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
                        <tr class="{{$idCredencial === $item->id?'table-success':''}}" onclick="onSelectIdCredencial({{$item->id}}, this, event)" title="Seleccionar credencial">
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
                                            <button wire:click="$emitTo('credencial.edit', 'setCredencial', {{$item->id}})"  class="dropdown-item" type="button" title="Editar">
                                                <i class="bi bi-pencil"></i> Editar
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" onclick="destroyCredencial({{$item->id}})" class="dropdown-item" title="Eliminar">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center">
                            No hay resultados
                        </td>
                    </tr>
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
    <x-layout.loading />
</div>

@push('scripts')
    <script>
        function onSelectIdCredencial(idCredencial, element, event) {
            if($(event.target).is('td, th, span')){
                console.log('event target', event);
                @this.$set('idCredencial', idCredencial);
                $('tr').removeClass('table-success');
                $(element).addClass('table-success');
            }
        }

        function destroyCredencial(id) {
            Swal.fire({
                title: "Credencial",
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