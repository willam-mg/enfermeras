<div>
    <h4>
        Aportes
        <div wire:loading wire:target="updateFocusYear" style="display: none" class="spinner-border spinner-border-sm"
            role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </h4>
        <ul class="nav nav-pills nav-fill mb-3" role="tablist">
            @foreach ($years as $year)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{$focusYear == $year?'active':''}}" id="misaportes-pills-tab-{{$year}}"
                            type="button" role="tab"
                        aria-controls="pills-step1" aria-selected="true" wire:click="updateFocusYear({{$year}})">
                        <span class="span-text-year-{{$year}}">
                            {{$year}}
                        </span>
                    </button>
                </li>
            @endforeach
        </ul>

    <div class="tab-content">
        <div class="row">
            <h4 class="text-center mb-3">
                {{$focusYear}}
            </h4>
            @foreach ($data as $key=>$itemAporte)
                <div class="col-xs-2 col-md-2 mb-3">
                    <div class="form-check text-center">
                        <label class="form-check-label calendar-aporte label-month {{$itemAporte->estado==\App\Models\Aporte::PAGADO?'calendar-aporte-checked':''}}" data-year="{{$itemAporte->gestion}}" data-value="{{$itemAporte->gestion.$itemAporte->mes}}" for="afiliado-create-requisitos-{{$itemAporte->gestion.$itemAporte->mes}}" style="padding-top:22px">
                            <b class="text-capitalize">
                                {{$itemAporte->mes_name}}
                            </b> <br>
                            {{$itemAporte->monto}} <br>
                            @if ($itemAporte->estado == \App\Models\Aporte::PENDIENTE)
                                <span class="badge rounded-pill bg-danger">Pendiente</span>
                            @else
                                <span class="badge rounded-pill bg-success">Pagado</span>
                            @endif
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mb-2">
            <button class="btn btn-outline-secondary" onclick="checkAllMonths({{$focusYear}}, true)" type="button">
                <i class="bi bi-x"></i>
                Ningun mes
            </button>
            <button class="btn btn-outline-success" onclick="checkAllMonths({{$focusYear}})" type="button">
                <i class="bi bi-check-all"></i>
                Todos los meses
            </button>
        </div>
    </div>
</div>