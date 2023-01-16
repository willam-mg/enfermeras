<div>
    @section('title', __('Aportes'))
    @section('breadcrumbs', Breadcrumbs::render('aportes') )
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-9">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-10">
                    <form wire:submit.prevent="search">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="input-group mb-3">
                                    <input type="hidden" wire:model.defer="searchAfiliadoId">
                                    <input type="text" focus wire:click="openSelectAfiliado()" class="form-control pe-auto" style="cursor:pointer" wire:model.defer="searchAfiliadoNombre"
                                        placeholder="{{__(" Afiliado")}}" aria-label="Afiliado" aria-describedby="button-addon2" readonly
                                        title="Afiliado" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <button class="btn btn-outline-secondary" wire:click="openSelectAfiliado()" type="button" id="button-addon2">
                                        <i class="bi bi-hand-index"></i>
                                    </button>
                                    @if ($searchAfiliadoId)
                                        <button class="btn btn-outline-secondary" type="button" wire:click="emptySearchAfiliadoId()" title="Limpiar" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <div class="mb-3">
                                    <input type="number" name="gestion" wire:model.defer="searchGestion" class="form-control" placeholder="Gestion" title="Gestion" data-bs-toggle="tooltip" data-bs-placement="top">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <div class="mb-3">
                                    <select class="form-select" wire:model.defer="searchMes" id="mes" name="mes" aria-label="Afiliado" title="Mes" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <option value="">{{__('Mes')}}</option>
                                        <option value="1"> {{__('Enero')}} </option>
                                        <option value="2"> {{__('Febreo')}} </option>
                                        <option value="3"> {{__('Marzo')}} </option>
                                        <option value="4"> {{__('Abril')}} </option>
                                        <option value="5"> {{__('Mayo')}} </option>
                                        <option value="6"> {{__('Junio')}} </option>
                                        <option value="7"> {{__('Julio')}} </option>
                                        <option value="8"> {{__('Agosto')}} </option>
                                        <option value="9"> {{__('Septiembre')}} </option>
                                        <option value="10"> {{__('Octubre')}} </option>
                                        <option value="11"> {{__('Noviembre')}} </option>
                                        <option value="12"> {{__('Diciembre')}} </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <div class="mb-3">
                                    <select class="form-select" wire:model.defer="searchEstado" id="estado" name="estado" aria-label="Pagado" title="Estado" data-bs-toggle="tooltip" data-bs-placement="top">
                                        <option value="">{{__('Estado')}}</option>
                                        <option value="{{\App\Models\Aporte::PAGADO}}">{{__('Pagado')}}</option>
                                        <option value="{{\App\Models\Aporte::PENDIENTE}}">{{__('Pendiente')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <i class="bi bi-search"></i>
                                    {{ __('Buscar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2 text-end">
                    <a type="button" class="btn btn-outline-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Nuevo aporte">
                        <i class="bi bi-plus"></i>
                        Nuevo
                    </a>
                </div>
            </div>
        
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">Afiliado</th>
                            <th scope="col">Gestion</th>
                            <th scope="col">Mes</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Pagado</th>
                            <th scope="col">Acciones</th>
                            <th class="text-center" scope="col">
                                Seleccionar
                            </th>
                        </tr>
                    </thead>
                    @if(count($data) > 0)
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
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
                                        @if ( $item->afiliado )
                                            {{$item->afiliado->nombre_completo}}
                                        @else
                                            <span class="text-danger"> No existe ( {{$item->afiliado_id}} ) </span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <b>
                                            {{$item->gestion}}
                                        </b>
                                    </td>
                                    <td class="text-capitalize">
                                        {{$item->mes_name}}
                                    </td>
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
                                            <button class="btn dropdown-toggle" type="button" id="aportes_dropdownActions{{$item->id}}"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="aportes_dropdownActions{{$item->id}}">
                                                <li>
                                                    <a class="dropdown-item" wire:click="show({{$item->id}})" type="button">
                                                        <i class="bi bi-eye"></i> Ver
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" wire:click="edit({{$item->id}})" type="button">
                                                        <i class="bi bi-pencil"></i> Editar
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" onclick="deleteAporte({{$item->id}})" type="button">
                                                        <i class="bi bi-trash"></i> Eliminar
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->estado == \App\Models\Aporte::PENDIENTE)
                                        <label class="form-check-label align-middle w-100 h-100 p-2 text-center position-relative start-0"
                                            for="flexCheck-{{$item->id}}"
                                            wire:click="updateTotalAportes()">
                                            <input type="checkbox" class="form-check-input  position-relative" wire:model.defer="aportesToPay.{{$item->id}}"
                                                id="flexCheck-{{$item->id}}"
                                                title="{{$searchAfiliadoId === null?'Seleccione el afiliado':$item->mes_name.' '.$item->gestion}}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" data-monto="{{$item->monto}}"
                                                data-year="{{$item->gestion}}" data-month="{{$item->mes}}" name="aportesmonthsselected[]" ;
                                                value="{{$item->gestion.'-'.$item->mes.'-'.$item->monto}}" {{!$searchAfiliadoId?'disabled':''}}>
                                        </label>
                                        @else
                                        <div class="align-middle w-100 h-100 p-2 text-center position-relative start-0">
                                            <i class="bi bi-check2-square"></i>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                </td>
                                <td class="text-center">
                                    @if ( $totalAportes > 0 )
                                        <button class="btn btn-outline-secondary" onclick="aportescheckAll(true)" title="Ninguno" @if(!$searchAfiliadoId) disabled @endif>
                                            <i class="bi bi-x"></i>
                                        </button>
                                    @endif
                                    <button class="btn btn-outline-secondary" onclick="aportescheckAll()" title="Seleccionar todo"  @if(!$searchAfiliadoId)
                                        disabled @endif>
                                        <i class="bi bi-check2-square"></i>
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    @else
                        <tbody>
                            <tr>
                                <td class="text-center" colspan="8">No hay resultados</td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
            <div class="row mb-3">
                <div class="col-xs-12 col-md-6">
                    @if ($data)
                        <div>Mostrando {{($data->currentpage()-1)*$data->perpage()+1}} al {{$data->currentpage()*$data->perpage()}}
                            de {{$data->total()}} registros
                        </div>
                    @endif
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="btn-group float-end">
                        @if ($data)
                            {{$data->appends(request()->query())->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="d-block d-sm-none col-xs-12 col-sm-12 col-md-3 mb-3">
            @include('livewire.aportes._total_pay_box')
        </div>

        <div class="d-none d-sm-block shadow-sm position-fixed top-50 translate-middle bg-light" style="width:270px; min-height:100vh; z-index:0; right:-136px; padding-top:147px">
            @include('livewire.aportes._total_pay_box')
        </div>
    </div>

    <livewire:afiliado.select-afiliado key="aportes-index">
    @include('livewire.aportes.show')
    @include('livewire.aportes.edit')

    <x-page.loading />

    @push('scripts')
        <script>
            function misaportesCalculateTotales() {
                let totalAportes = 0;
                $(`.misaporte-month`).each(function() {
                    if ($(this).is(':checked')) {
                        totalAportes += parseFloat($(this).attr('data-monto'));
                    }
                });
                $('#misaportes-total-aportes').html("");
                $('#misaportes-total-aportes').append(totalAportes);
            }

            // function checkMonthToPay(element) {
            //     let id = $(element).attr('data-value');
            //     if ($('#misaportes-monthcheck-'+id).is(':checked')) {
            //         $(element).removeClass('calendar-aporte-pendiente');
            //         $(element).addClass('calendar-aporte-checked');
            //     }else {
            //         $(element).removeClass('calendar-aporte-checked');
            //         $(element).addClass('calendar-aporte-pendiente');
            //     }
            //     misaportesCalculateTotales();
            // }

            function aportescheckAll(unchecked = false) {
                // $(`input[name='aportesmonthsselected-${year}[]']`).each(function() {
                $(`input[name='aportesmonthsselected[]']`).each(function() {
                    if ($(this).is(':checked') == unchecked) {
                        this.click();
                    }
                });
                // @this.updateTotalAportes();
                // misaportesIsAllSelectedMonths(year);
            }

            function aportesStore() {
                var itemsToPay = @this.countAportesToPay;
                if (itemsToPay == 0) {
                    Swal.fire({
                        icon: 'info',
                        title: '',
                        text: 'Seleccione los meses a pagar'
                    });
                } else {
                    Swal.fire({
                        title: "Aportes",
                        text: "¿ Esta seguro de regsitrar los aportes seleccionados ?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#1c8854',
                        confirmButtonText: 'Si registrar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                @this.store();
                            }
                        });
                }
            }

            function deleteAporte(id){
                Swal.fire({
                    title: "Aportes",
                    text: "¿ Esta seguro de eliminar el aporte ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Si, eliminalo !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.destroy(id);
                    }
                });
            }
            
            document.addEventListener("DOMContentLoaded", function(){
                // var allChecked = false;
                // $("#btnSelectAll").on("click", function() {
                //     $('.form-check-input').prop('checked', true);
                // });
                // $('#btnPreparar').on('click', function(e) {
                //     e.preventDefault();
                //     let myArray = [];
                //     $('input[name^="aportes"]').each(function() {
                //         if ($(this).prop("checked") === true) {
                //             let id = $(this).val();
                //             myArray.push(id);
                //         }
                //     });
                //     if ( !myArray.length == 0 )  {
                //         if ( confirm("Pagar estas mensualidades ?") ) {
                //             var arrStr = encodeURIComponent(JSON.stringify(myArray));
                //             window.location.href = '/pagos/create?seleccionados=' + arrStr;
                //         }
                //     } else {
                //         alert('No hay aportes seleccionadas');
                //     }
                // });
    
                // function checkAll() {
                //     $('input[name^="aportes"]').prop("checked", true);
                // }
                // $('#select_meses').on('click', function() {
                //     if (!allChecked) {
                //         checkAll();
                //         allChecked = true;
                //     } else {
                //         $('input[name^="aportes"]').prop("checked", false);
                //         allChecked = false;
                //     }
                // });
    
                // $('.select-search').select2({
                //     theme: "bootstrap-5",
                // });
    
                // $('.select-search')
                //     .parent('div')
                //     .children('span')
                //     .children('span')
                //     .children('span')
                //     .css('height', ' calc(3.5rem + 2px)');
                // $('.select-search')
                //     .parent('div')
                //     .children('span')
                //     .children('span')
                //     .children('span')
                //     .children('span')
                //     .css('margin-top', '18px');
                // $('.select-search')
                //     .parent('div')
                //     .find('label')
                //     .css('z-index', '1');
                
            });
        </script>
    @endpush
</div>