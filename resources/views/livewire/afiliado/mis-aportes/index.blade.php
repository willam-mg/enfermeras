<div>
    <div class="row mb-3">
        <div class="col-xs-12 col-sm-12 col-md-9">
            <h4>
                Aportes
                <div wire:loading wire:target="updateFocusYear" style="display: none" class="spinner-border spinner-border-sm"
                    role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </h4>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="card">
                <div class="card-body p-1">
                    <h4>
                        Total: 
                        <span id="misaportes-total-aportes">{{$totalAportes}}</span> Bs.
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills nav-fill mb-3">
        @foreach ($years as $year)
            <li class="nav-item">
                <button class="nav-link border border-secondary rounded {{$focusYear == $year?'active':''}}" id="misaportes-pills-tab-{{$year}}"
                        type="button" wire:click="updateFocusYear({{$year}})">
                    <span class="misaportesspan-text-year-{{$year}} {{preg_grep("/$year/i", $aportesToPay)?'text-warning fw-bold':''}}">
                        {{$year}}
                    </span>
                </button>
            </li>
        @endforeach
        <li class="nav-item">
            <button class="btn btn-outline-success" type="button" onclick="openModalAddGestion()">
                <i class="bi bi-plus"></i>
                {{__('Agregar año')}}
            </button>
        </li>
    </ul>

    @include('livewire.afiliado.mis-aportes._modal_add_gestion')

    <div class="row">
        <h4 class="text-center mb-3">
            Gestion {{$focusYear}}
        </h4>
        @include('livewire.afiliado.mis-aportes._modal_edit_aporte')
        @foreach ($misaportes as $key=>$itemAporte)
            <div class="col-xs-2 col-md-2 mb-3">
                <div class="form-check text-center">
                    @if( $itemAporte->estado == \App\Models\Aporte::PAGADO )
                        <a href="#" type="button" wire:click="edit({{$itemAporte->id}})" class="link-dark calendar-aporte" style="padding-top:22px">
                            <b class="text-capitalize">
                                {{$itemAporte->mes_name}}
                            </b> <br>
                            {{$itemAporte->monto}} <br>
                            <span class="badge rounded-pill bg-success">Pagado</span> <br>
                        </a>
                    @else
                        <label onclick="checkMonthToPay(this)" wire:click="updateTotalAportes()" class="form-check-label calendar-aporte {{in_array($itemAporte->gestion.'-'.$itemAporte->mes.'-'.$itemAporte->monto, $aportesToPay)?'calendar-aporte-checked':'calendar-aporte-pendiente'}}" data-year="{{$itemAporte->gestion}}" data-value="{{$itemAporte->id}}" for="misaportes-monthcheck-{{$itemAporte->id}}" style="padding-top:22px">
                            <b class="text-capitalize">
                                {{$itemAporte->mes_name}}
                            </b> <br>
                            <small>
                                {{$itemAporte->monto}} 
                            </small> <br>
                            
                            @if ($itemAporte->estado == \App\Models\Aporte::PENDIENTE)
                                <span class="badge rounded-pill bg-danger">
                                    Pendiente
                                </span>
                            @else
                                <span class="badge rounded-pill bg-success">
                                    Pagado
                                </span>
                            @endif  <br>
                            <input style="visibility: hidden" class="misaporte-month" data-monto="{{$itemAporte->monto}}" data-year="{{$itemAporte->gestion}}" data-month="{{$itemAporte->mes}}"
                                name="misaportesmonthsselected-{{$itemAporte->gestion}}[]" type="checkbox"
                                wire:model.defer="aportesToPay.{{$itemAporte->id}}"
                                value="{{$itemAporte->gestion.'-'.$itemAporte->mes.'-'.$itemAporte->monto}}"
                                id="misaportes-monthcheck-{{$itemAporte->id}}">
                        </label>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 col-xl-9 mb-3 text-end">
            <button class="btn btn-outline-danger" @if( $totalAportes == 0 ) disabled @endif  onclick="misaportesDeleteAllMonths({{$focusYear}}, true)" type="button">
                <i class="bi bi-trash"></i>
                Eliminar
            </button>
            <button class="btn btn-outline-secondary" @if( $totalAportes == 0 ) disabled @endif onclick="misaportescheckAllMonths({{$focusYear}}, true)" type="button">
                <i class="bi bi-x"></i>
                Ningun mes
            </button>
            <button class="btn btn-outline-success" onclick="misaportescheckAllMonths({{$focusYear}})" type="button">
                <i class="bi bi-check-all"></i>
                Todos los meses
            </button>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-end">
            <button class="btn btn-success" @if( $totalAportes == 0 ) disabled @endif wire:loading.attr="disabled" onclick="registrarMisAportes()">
                <i class="bi bi-cash"></i>
                Registrar pago
            </button>
        </div>
    </div>

    <x-page.loading />

    @push('scripts')
        <script>
            function checkMonthToPay(element) {
                let id = $(element).attr('data-value');
                if ($('#misaportes-monthcheck-'+id).is(':checked')) {
                    $(element).removeClass('calendar-aporte-pendiente');
                    $(element).addClass('calendar-aporte-checked');
                }else {
                    $(element).removeClass('calendar-aporte-checked');
                    $(element).addClass('calendar-aporte-pendiente');
                }
                misaportesCalculateTotales();
            }

            function misaportescheckAllMonths(year, unchecked = false) {
                $(`input[name='misaportesmonthsselected-${year}[]']`).each(function() {
                    if ($(this).is(':checked') == unchecked) {
                        this.click();
                    }
                });
                misaportesIsAllSelectedMonths(year);
            }
            
            function misaportesDeleteAllMonths(year) {
                var itemsToPay = @this.aportesToPay;
                if (itemsToPay.length == 0) {
                    Swal.fire({
                        icon: 'info',
                        title: '',
                        text: 'No hay meses seleccionados'
                    });
                } else {
                    Swal.fire({
                        title: "Aportes",
                        text: "¿ Esta seguro de eliminar estos aportes ?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Si, eliminalo !'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.destroyAportes();
                        }
                    });
                    
                }

                $(`input[name='misaportesmonthsselected-${year}[]']`).each(function() {
                    if ($(this).is(':checked')) {
                        let id = $(this).attr('data-value');
                        
                        // this.click();
                    }
                });
                
            }

            function misaportesIsAllSelectedMonths(year) {
                let count = 0;
                    $(`input[name='misaportesmonthsselected-${year}[]']`).each(function() {
                    if ($(this).is(':checked')) {
                        count++;
                    }
                });
                if (count > 0) {
                    $(`.misaportesspan-text-year-${year}`).addClass(['text-warning', 'fw-bold']);
                } else {
                    $(`.misaportesspan-text-year-${year}`).removeClass(['text-warning', 'fw-bold']);
                }
            }

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

            function registrarMisAportes() {
                var itemsToPay = @this.aportesToPay;
                if (itemsToPay.length == 0) {
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

            function openModalAddGestion() {
                $('#modal-misaportes-add-gestion').modal('show');
            }
        </script>    
    @endpush
</div>