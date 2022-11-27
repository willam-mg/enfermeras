<div>
    <div wire:ignore.self class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-afiliado-create"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Nuevo Afiliado</h5>
                    <div class="text-center" style="width: 70%; height: 100px; position: absolute; top:5px; left: 50%; -webkit-transform: translateX(-50%); transform: translateX(-50%)">
                        <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-step1-tab" data-bs-toggle="pill" data-bs-target="#pills-step1"
                                    type="button" role="tab" aria-controls="pills-step1" aria-selected="true">
                                    <span class="badge rounded-pill bg-primary">1</span>
                                    <small>Datos personales</small>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link position-relative" id="pills-step2-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-step2" type="button" role="tab" aria-controls="pills-step2" aria-selected="false">
                                    <span class="badge rounded-pill bg-primary">2</span>
                                    <small>Requisitos</small>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-step3-tab" data-bs-toggle="pill" data-bs-target="#pills-step3" type="button"
                                    role="tab" aria-controls="pills-step3" aria-selected="false">
                                    <span class="badge rounded-pill bg-primary">3</span>
                                    <small>Matricula y aportes</small>
                                </button>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-step4-tab" data-bs-toggle="pill" data-bs-target="#pills-step4" type="button"
                                    role="tab" aria-controls="pills-step4" aria-selected="false">
                                    Paso 4<br>
                                    <small>Vista Previa</small>
                                </button>
                            </li> --}}
                        </ul>
                    </div>
                    
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store" enctype="multipart/form-data">

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-step1" role="tabpanel" aria-labelledby="pills-step1-tab">
                                <div class="row justify-content-center">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="numero_afiliado" wire:model.defer="model.numero_afiliado"
                                                        class="form-control @error('model.numero_afiliado') is-invalid @enderror"
                                                        placeholder="{{__(" N° afiliado")}}">
                                                    <label class="form-label" for="numero_afiliado">{{__("N° afiliado")}}</label>
                                                    @error('model.numero_afiliado')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="cargo" wire:model.defer="model.cargo"
                                                        class="form-control @error('model.cargo') is-invalid @enderror" placeholder="Cargo">
                                                    <label class="form-label" for="cargo">Cargo</label>
                                                    @error('model.cargo')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="row">
                                            <div class="col-xs-12 col-md-8">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="nombre_completo" wire:model.defer="model.nombre_completo"
                                                        class="form-control @error('model.nombre_completo') is-invalid @enderror"
                                                        placeholder="Nombre">
                                                    <label class="form-label" for="nombre_completo">Nombre completo</label>
                                                    @error('model.nombre_completo')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="numero_matricula" wire:model.defer="model.numero_matricula"
                                                        class="form-control @error('model.numero_matricula') is-invalid @enderror"
                                                        placeholder="{{__(" N° matricula")}}">
                                                    <label class="form-label" for="numero_matricula">{{__("N° matricula")}}</label>
                                                    @error('model.numero_matricula')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3">
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="ci" wire:model.defer="model.ci"
                                                        class="form-control @error('model.ci') is-invalid @enderror" placeholder="CI">
                                                    <label class="form-label" for="ci">CI</label>
                                                    @error('model.ci')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-3">
                                                <div class="form-floating  mb-3">
                                                    <select wire:model.defer="model.expedido"
                                                        class="form-select @error('model.expedido') is-invalid @enderror">
                                                        <option value="CBBA" title="Cochabamba"> CBBA </option>
                                                        <option value="LPZ" title="La Paz"> LPZ </option>
                                                        <option value="SCZ" title="Santa Cruz"> SCZ </option>
                                                        <option value="ORU" title="Oruro"> ORU </option>
                                                        <option value="PSI" title="Potosi"> PSI </option>
                                                        <option value="CHQ" title="Chuquisaca"> CHQ </option>
                                                        <option value="TJA" title="Tarija"> TJA </option>
                                                        <option value="BNI" title="Beni"> BNI </option>
                                                        <option value="PND" title="Pando"> PND </option>
                                                        <option value="EXTRANJERO"> EXTRANJERO </option>
                                                    </select>
                                                    <label for="mes">Expedido</label>
                                                    @error('model.expedido')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="anos_servicio" wire:model.defer="model.anos_servicio"
                                                        class="form-control @error('model.anos_servicio') is-invalid @enderror" placeholder="anos_servicio">
                                                    <label class="form-label" for="anos_servicio">{{__('Años de servicio')}}</label>
                                                    @error('model.anos_servicio')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="grupo_sanguineo" wire:model.defer="model.grupo_sanguineo"
                                                        list="list_grupo_sanguineo"
                                                        class="form-control @error('model.grupo_sanguineo') is-invalid @enderror"
                                                        placeholder="{{__(" G. sanguineo")}}">
                                                    <label class="form-label" for="grupo_sanguineo">{{__("G. sanguineo")}}</label>
                                                    @include('afiliado._list_grupo_sanguineo')
                                                    @error('model.grupo_sanguineo')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-8">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="egreso" wire:model.defer="model.egreso"
                                                        class="form-control @error('model.egreso') is-invalid @enderror" placeholder="Egreso">
                                                    <label class="form-label" for="egreso">Egreso</label>
                                                    @error('model.egreso')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="form-floating mb-3">
                                            <textarea name="domicilio" wire:model.defer="model.domicilio"
                                                class="form-control @error('model.domicilio') is-invalid @enderror" placeholder="Domicilio"
                                                rows="5"></textarea>
                                            <label class="form-label" for="domicilio">Domicilio</label>
                                            @error('model.domicilio')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>
                            
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="telefono" wire:model.defer="model.telefono"
                                                        class="form-control @error('model.telefono') is-invalid @enderror" placeholder="telefono">
                                                    <label class="form-label" for="telefono">Telefono</label>
                                                    @error('model.telefono')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                @if ($file)
                                                <img wire:loading.remove wire:target="file" src="{{ $file->temporaryUrl() }}" width="100%"
                                                    height="auto">
                                                @endif
                                                <div class="text-center" wire:loading wire:target="file" style="display:none">
                                                    <span class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </span>
                                                    Cargando...
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="file" name="foto" wire:model.defer="file"
                                                        class="form-control @error('file') is-invalid @enderror" placeholder="Foto">
                                                    <label class="form-label" for="foto">Foto</label>
                                                    @error('file')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="fecha_nacimiento" wire:model.defer="model.fecha_nacimiento"
                                                        class="form-control @error('model.fecha_nacimiento') is-invalid @enderror" placeholder="Fecha nacimiento">
                                                    <label class="form-label" for="fecha_nacimiento">Fecha nacimiento</label>
                                                    @error('model.fecha_nacimiento')
                                                    <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                                    <button class="btn btn-primary" type="button" onclick="goToStep(2)">
                                        <i class="bi bi-chevron-right"></i>
                                        Siguiente
                                    </button>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-step2" role="tabpanel" aria-labelledby="pills-step2-tab">
                                <div class="row justify-content-center">
                                    <div class="col-xs-12 col-sm-9 col-md-9">
                                        <ul class="list-group mb-3">
                                            @foreach ($requisitos as $item)
                                                <li class="list-group-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input-create" type="checkbox" name="seleccionados[]" wire:model.defer="misRequisitos.{{$item->id}}" value="{{$item->id}}" id="afiliado-create-requisitos-{{$item->id}}">
                                                        <label class="form-check-label" for="afiliado-create-requisitos-{{$item->id}}">
                                                            {{$item->numero}} .-
                                                            {{$item->requisito}}
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                                    <button class="btn btn-link" onclick="selectAllRequisitos()" type="button">
                                        <i class="bi bi-check-all"></i>
                                        Seleccionar todo
                                    </button>
                                    <button class="btn btn-secondary" type="button" onclick="goToStep(1)">
                                        <i class="bi bi-chevron-left"></i>
                                        Atras
                                    </button>
                                    <button class="btn btn-primary" type="button" onclick="goToStep(3)">
                                        <i class="bi bi-chevron-right"></i>
                                        Siguiente
                                    </button>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-step3" role="tabpanel" aria-labelledby="pills-step3-tab">
                                <div class="row mb-1">
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <h5>Matricula</h5>
                                        {{-- costo de matricula model afiliado --}}
                                        <div class="form-floating mb-3">
                                            <input type="number" name="costo_matricula" wire:model.defer="model.costo_matricula"
                                                class="form-control @error('model.costo_matricula') is-invalid @enderror" placeholder="costo_matricula">
                                            <label class="form-label" for="costo_matricula">{{__('Costo de matricula')}}</label>
                                            @error('model.costo_matricula')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-9" style="border-left:0.5px solid #a6a6a6">
                                        <h5>Aportes</h5>
                                        {{-- costo de aporte model aporte --}}
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="monto" wire:model.defer="aporte.monto" id="aporte-monto"
                                                        class="form-control @error('monto') is-invalid @enderror" placeholder="Monto" required>
                                                    <label class="form-label" for="monto">Costo por mes</label>
                                                    @error('monto')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-8">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-md-3">
                                                                Total matricula: <br>
                                                                <h4>
                                                                    <span id="afiliado-total-matricula">0</span>
                                                                    Bs.
                                                                </h4>
                                                            </div>
                                                            <div class="col-xs-12 col-md-1 text-center align-middle">
                                                                <i class="bi bi-plus-lg"></i>
                                                            </div>
                                                            <div class="col-xs-12 col-md-3">
                                                                Total Aportes: 
                                                                <h4>
                                                                    <span id="afiliado-total-aportes">0</span>
                                                                    Bs.
                                                                </h4>
                                                            </div>
                                                            <div class="col-xs-12 col-md-1 text-center align-middle">
                                                                =
                                                            </div>
                                                            <div class="col-xs-12 col-md-4">
                                                                Total: <br>
                                                                <h4>
                                                                    <span id="afiliado-total">0</span>
                                                                    Bs.
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Aportes --}}
                                        <nav class="mb-3">
                                            <input class="visually-hidden" type="checkbox" id="checkbox-years-modo" wire:model.defer="yearsModo" value="1">
                                            <div class="nav nav-tabs" id="afiliado-aporte-nav-tab" role="tablist">
                                                <button class="nav-link {{!$yearsModo?'active':''}}" id="afiliado-aporte-months-tab" data-bs-toggle="tab" data-bs-target="#afiliado-aporte-nav-months" type="button"
                                                    role="tab" aria-controls="afiliado-aporte-nav-months" aria-selected="true">
                                                    {{__('Por meses')}}
                                                </button>
                                                <button class="nav-link {{$yearsModo?'active':''}}" id="afiliado-aporte-years-tab" data-bs-toggle="tab" data-bs-target="#afiliado-aporte-nav-years" type="button"
                                                    role="tab" aria-controls="afiliado-aporte-nav-years" aria-selected="false">
                                                    {{__('Por años')}}
                                                </button>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade  {{!$yearsModo?'show active':''}}" id="afiliado-aporte-nav-months" role="tabpanel" aria-labelledby="afiliado-aporte-months-tab">
                                                <ul class="nav nav-pills nav-fill mb-3" id="afiliado-aportes-pills-tab" role="tablist">
                                                    @foreach ($years as $item)
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link {{$item == $actualYear?'active':''}}" id="afiliado-aportes-pills-tab-{{$item}}"
                                                                data-bs-toggle="pill" data-bs-target="#afiliado-aportes-pills-year-{{$item}}" type="button" role="tab"
                                                                aria-controls="pills-step1" aria-selected="true">
                                                                <span class="span-text-year-{{$item}}">
                                                                    {{$item}}
                                                                    <i class="bi bi-check2-square icon-year-checked-{{$item}}" style="display:none"></i>
                                                                </span>
                                                            </button>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="tab-content" id="pills-tabContent">
                                                    @foreach ($years as $item)
                                                        <div class="tab-pane fade show {{$item == $actualYear?'active':''}}" id="afiliado-aportes-pills-year-{{$item}}" role="tabpanel" aria-labelledby="afiliado-aportes-pills-tab-{{$item}}">
                                                            <div class="row">
                                                                @for ($i = 1; $i <= 12; $i++) 
                                                                    <div class="col-xs-2 col-md-2 mb-3">
                                                                        <div class="form-check text-center">
                                                                            <label class="form-check-label calendar-aporte label-month" data-year="{{$item}}" data-value="{{$item.$i}}"
                                                                                for="afiliado-create-requisitos-{{$item.$i}}">
                                                                                <b class="text-capitalize">
                                                                                    {{\Carbon\Carbon::create()->month($i)->locale('es_ES')->monthName}}
                                                                                </b> <br>
                                                                                <input class="form-check-input-create aporte-month" data-year="{{$item}}" data-month="{{$i}}" style="visibility: hidden" name="monthsselected-{{$item}}[]" type="checkbox"
                                                                                    wire:model.defer="misAportes.{{$item.$i}}" value="{{$item.'-'.$i}}"
                                                                                    id="afiliado-create-requisitos-{{$item.$i}}">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endfor
                                                            </div>
                                                            <div class="text-center mb-2">
                                                                <button class="btn btn-outline-secondary" onclick="checkAllMonths({{$item}}, true)" type="button">
                                                                    <i class="bi bi-x"></i>
                                                                    Ningun mes
                                                                </button>
                                                                <button class="btn btn-outline-success" onclick="checkAllMonths({{$item}})" type="button">
                                                                    <i class="bi bi-check-all"></i>
                                                                    Todos los meses
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="tab-pane fade {{$yearsModo?'show active':''}}" id="afiliado-aporte-nav-years" role="tabpanel" aria-labelledby="afiliado-aporte-years-tab">
                                                <div class="text-center">
                                                    <h4>{{__("Pagar por un rango de años")}}</h4>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-xs-12 col-md-4">
                                                        <div class="form-floating mb-3">
                                                            <input type="number" name="yearStart" wire:model.defer="yearStart" min="1000" step="1" max="3000"
                                                                class="form-control @error('yearStart') is-invalid @enderror" placeholder="{{__("Desde")}}">
                                                            <label class="form-label" for="yearStart">{{__("Desde")}}</label>
                                                            @error('yearStart')
                                                            <div class="invalid-feedback"> {{ $message }} </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-md-4">
                                                        <div class="form-floating mb-3">
                                                            <input type="number" name="yearEnd" wire:model.defer="yearEnd" min="1000" step="1" max="3000"
                                                                class="form-control @error('yearEnd') is-invalid @enderror" placeholder="{{__("Hasta")}}">
                                                            <label class="form-label" for="yearEnd">{{__("Hasta")}}</label>
                                                            @error('yearEnd')
                                                            <div class="invalid-feedback"> {{ $message }} </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                                    <button class="btn btn-secondary" type="button" onclick="goToStep(2)">
                                        <i class="bi bi-chevron-left"></i>
                                        Atras
                                    </button>
                                    <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:target="file">
                                        <i class="bi bi-plus"></i>
                                        {{ __('Registrar') }}
                                    </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-step4" role="tabpanel" aria-labelledby="pills-step4-tab">
                                @if($model->id)
                                    recibo
                                @endif
                                
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function goToStep(step) {
            $(`#pills-step${step}-tab`).trigger("click");
        }
        function selectAllRequisitos() {
            $("input[name='seleccionados[]']").each(function() {
                if (!$(this).is(':checked')) {
                    this.click();
                }
            }).get();
        }
        function checkAllMonths(year, unchecked = false) {
            $(`input[name='monthsselected-${year}[]']`).each(function() {
                if ($(this).is(':checked') == unchecked) {
                    this.click();
                }
            });
            isAllSelectedMonths(year);
        }

        function isAllSelectedMonths(year) {
            let count = 0;
            $(`input[name='monthsselected-${year}[]']`).each(function() {
                if ($(this).is(':checked')) {
                    count++;
                }
            });
            if (count > 0) {
                $(`.icon-year-checked-${year}`).attr('style', 'display:inline');
                $(`.span-text-year-${year}`).addClass('text-success');
                $(`.span-text-year-${year}`).addClass('fw-bold');
            } else {
                $(`.icon-year-checked-${year}`).attr('style', 'display:none');
                $(`.span-text-year-${year}`).removeClass('text-success');
                $(`.span-text-year-${year}`).removeClass('fw-bold');
            }
        }

        function calculateTotales() {
            let totalMatricula = 0;
            let totalAportes = 0;
            $(`.aporte-month`).each(function() {
                if ($(this).is(':checked')) {
                    // let year = $(this).attr('data-year');
                    // let month = $(this).attr('data-month');
                    let monto = parseFloat($('#aporte-monto').val());
                    // console.trace(year, month);
                    totalAportes += monto;
                }
            });
            let total = totalMatricula + totalAportes;
            $('#afiliado-total-aportes').html("");
            $('#afiliado-total-aportes').append(totalAportes);
            $('#afiliado-total').html("");
            $('#afiliado-total').append(total);
        }
        document.addEventListener("DOMContentLoaded", function () {
            $(".label-month").on('click', function() {
                let yearMonth = $(this).attr('data-value');
                let year = $(this).attr('data-year');
                if ($('#afiliado-create-requisitos-'+yearMonth).is(':checked')) {
                    $(this).addClass('calendar-aporte-checked');
                }else {
                    $(this).removeClass('calendar-aporte-checked');
                }
                
                isAllSelectedMonths(year);
                calculateTotales();
            });
            $("#afiliado-aporte-months-tab").on('click', function() {
                if ($("#checkbox-years-modo").is(':checked')) {
                    $("#checkbox-years-modo").click();
                }
            });
            $("#afiliado-aporte-years-tab").on('click', function() {
                if (!$("#checkbox-years-modo").is(':checked')) {
                    $("#checkbox-years-modo").click();
                }
            });

            $('#aporte-monto').on('input', function() {
                calculateTotales();
            } );
        });
    </script>
@endpush