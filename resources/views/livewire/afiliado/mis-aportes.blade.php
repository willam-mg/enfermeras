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
                <button class="nav-link {{$focusYear == $year?'active':''}}" id="misaportes-pills-tab-{{$year}}"
                        type="button" wire:click="updateFocusYear({{$year}})">
                    <span class="misaportesspan-text-year-{{$year}} {{preg_grep("/$year/i", $aportesToPay)?'text-warning fw-bold':''}}">
                        {{$year}}
                    </span>
                </button>
            </li>
        @endforeach
    </ul>

    <div class="row">
        <h4 class="text-center mb-3">
            Gestion {{$focusYear}}
        </h4>
        @foreach ($misaportes as $key=>$itemAporte)
            <div class="col-xs-2 col-md-2 mb-3">
                <div class="form-check text-center">
                    @if( $itemAporte->estado == \App\Models\Aporte::PAGADO )
                        <a href="#" type="button" onclick="alert('hello')" class="link-dark calendar-aporte" style="padding-top:22px">
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
    <div class="text-center mb-2">
        <button class="btn btn-outline-secondary" onclick="misaportescheckAllMonths({{$focusYear}}, true)" type="button">
            <i class="bi bi-x"></i>
            Ningun mes
        </button>
        <button class="btn btn-outline-success" onclick="misaportescheckAllMonths({{$focusYear}})" type="button">
            <i class="bi bi-check-all"></i>
            Todos los meses
        </button>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6"></div>
        <div class="col-xs-12 col-sm-12 col-md-6 text-end">
            <button class="btn btn-lg btn-success" onclick="registrarMisAportes()">
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
                calculateTotales();
            }

            function misaportescheckAllMonths(year, unchecked = false) {
                $(`input[name='misaportesmonthsselected-${year}[]']`).each(function() {
                    if ($(this).is(':checked') == unchecked) {
                        this.click();
                    }
                });
                isAllSelectedMonths(year);
            }

            function isAllSelectedMonths(year) {
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

            function calculateTotales() {
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
                console.log(itemsToPay);
                if (itemsToPay.length == 0) {
                    Swal.fire({
                        icon: 'info',
                        title: '',
                        text: 'Seleccione los meses a pagar'
                    });
                } else {
                    Swal.fire({
                        title: "Afiliado",
                        text: "¿ Esta seguro de regsitrar los aportes seleccionados ?",
                        icon: 'warning',
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
        </script>    
    @endpush
</div>