<div>
    <div wire:ignore.self class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-create"
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
                                    <small>Matricula y aporte mensual</small>
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
                                                        class="form-select @error('model.expedido') is-invalid @enderror" id="mes" name="mes"
                                                        aria-label="Afiliado">
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
                                                    <input type="date" name="fecha_nacimiento" wire:model.defer="model.fecha_nacimiento"
                                                        class="form-control @error('model.fecha_nacimiento') is-invalid @enderror"
                                                        placeholder="Fecha nacimiento">
                                                    <label class="form-label" for="fecha_nacimiento">Fecha nacimiento</label>
                                                    @error('model.fecha_nacimiento')
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
                                                    <input type="number" name="anos_servicio" wire:model.defer="model.anos_servicio"
                                                        class="form-control @error('model.anos_servicio') is-invalid @enderror"
                                                        placeholder="anos_servicio">
                                                    <label class="form-label" for="anos_servicio">{{__('Años de servicio')}}</label>
                                                    @error('model.anos_servicio')
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
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
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
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        {{-- costo de acreditacion model acreditacion --}}
                                        <h5>Mensualidad</h5>
                                        <div class="form-floating mb-3">
                                            <input type="number" name="gestion" list="list_gestiones" wire:model.defer="acreditacion.gestion"
                                                class="form-control @error('gestion') is-invalid @enderror" placeholder="Gestion" required>
                                            <label class="form-label" for="gestion">Gestion</label>
                                            <datalist id="list_gestiones">
                                                <option value="2020">
                                                <option value="2021">
                                                <option value="2022">
                                                <option value="2023">
                                                <option value="2024">
                                                <option value="2025">
                                                <option value="2026">
                                                <option value="2027">
                                                <option value="2028">
                                                <option value="2029">
                                                <option value="2030">
                                                <option value="2031">
                                                <option value="2032">
                                                <option value="2033">
                                                <option value="2034">
                                                <option value="2035">
                                                <option value="2036">
                                                <option value="2037">
                                                <option value="2038">
                                                <option value="2039">
                                                <option value="2040">
                                                <option value="2041">
                                                <option value="2042">
                                                <option value="2043">
                                                <option value="2044">
                                                <option value="2045">
                                            </datalist>
                                            @error('gestion')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating  mb-3">
                                            <select class="form-select @error('mesSeleccionado') is-invalid @enderror" wire:model.defer="mesSeleccionado" id="mes"
                                                name="mes" aria-label="Afiliado">
                                                <option>{{__('Seleccione el Mes')}}</option>
                                                <option value="1" {{strtolower($mesActual) == 'enero'?'selected':''}}> {{__('Enero')}} </option>
                                                <option value="2" {{strtolower($mesActual) == 'febrero'?'selected':''}}> {{__('Febreo')}} </option>
                                                <option value="3" {{strtolower($mesActual) == 'marzo'?'selected':''}}> {{__('Marzo')}} </option>
                                                <option value="4" {{strtolower($mesActual) == 'abril'?'selected':''}}> {{__('Abril')}} </option>
                                                <option value="5" {{strtolower($mesActual) == 'mayo'?'selected':''}}> {{__('Mayo')}} </option>
                                                <option value="6" {{strtolower($mesActual) == 'junio'?'selected':''}}> {{__('Junio')}} </option>
                                                <option value="7" {{strtolower($mesActual) == 'julio'?'selected':''}}> {{__('Julio')}} </option>
                                                <option value="8" {{strtolower($mesActual) == 'agosto'?'selected':''}}> {{__('Agosto')}} </option>
                                                <option value="9" {{strtolower($mesActual) == 'septiembre'?'selected':''}}> {{__('Septiembre')}} </option>
                                                <option value="10" {{strtolower($mesActual) == 'octubre'?'selected':''}}> {{__('Octubre')}} </option>
                                                <option value="11" {{strtolower($mesActual) == 'noviembre'?'selected':''}}> {{__('Noviembre')}} </option>
                                                <option value="12" {{strtolower($mesActual) == 'diciembre'?'selected':''}}> {{__('Diciembre')}} </option>
                                            </select>
                                            <label for="mes">Mes</label>
                                            @error('mesSeleccionado')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="number" name="monto" wire:model.defer="acreditacion.monto"
                                                class="form-control @error('monto') is-invalid @enderror" placeholder="Monto" required>
                                            <label class="form-label" for="monto">Monto</label>
                                            @error('monto')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
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
                this.click();
            }).get();
        }
    </script>
@endpush