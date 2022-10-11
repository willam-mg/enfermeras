<div>

    <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                Paso 1
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link position-relative" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                Paso 2
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-credicial-tab" data-bs-toggle="pill" data-bs-target="#pills-credencial" type="button" role="tab" aria-controls="pills-credencial" aria-selected="false">
                Paso 3
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-acredtiaciones-tab" data-bs-toggle="pill" data-bs-target="#pills-acreditaciones" type="button" role="tab" aria-controls="pills-credencial" aria-selected="false">
                Paso 4
            </button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="numero_afiliado" wire:model="model.numero_afiliado" class="form-control @error('model.numero_afiliado') is-invalid @enderror" placeholder="{{__("N° afiliado")}}" >
                            <label class="form-label" for="numero_afiliado">{{__("N° afiliado")}}</label>
                            @error('model.numero_afiliado')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="cargo" wire:model="model.cargo" class="form-control @error('model.cargo') is-invalid @enderror" placeholder="Cargo" >
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
                            <input type="text" name="nombre_completo" wire:model="model.nombre_completo" class="form-control @error('model.nombre_completo') is-invalid @enderror" placeholder="Nombre" >
                            <label class="form-label" for="nombre_completo">Nombre completo</label>
                            @error('model.nombre_completo')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text" name="numero_matricula" wire:model="model.numero_matricula" class="form-control @error('model.numero_matricula') is-invalid @enderror" placeholder="{{__("N° matricula")}}" >
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
                            <input type="number" name="ci" wire:model="model.ci" class="form-control @error('model.ci') is-invalid @enderror" placeholder="CI" >
                            <label class="form-label" for="ci">CI</label>
                            @error('model.ci')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-2">
                        <div class="form-floating  mb-3">
                            <select  wire:model="model.expedido" class="form-select @error('model.expedido') is-invalid @enderror" id="mes" name="mes" aria-label="Afiliado">
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
                    <div class="col-xs-12 col-md-7">
                        <div class="form-floating mb-3">
                            <input type="date" name="fecha_nacimiento" wire:model="model.fecha_nacimiento" class="form-control @error('model.fecha_nacimiento') is-invalid @enderror" placeholder="Fecha nacimiento" >
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
                            <input type="text" name="grupo_sanguineo" wire:model="model.grupo_sanguineo" list="list_grupo_sanguineo" class="form-control @error('model.grupo_sanguineo') is-invalid @enderror" placeholder="{{__("G. sanguineo")}}" >
                            <label class="form-label" for="grupo_sanguineo">{{__("G. sanguineo")}}</label>
                            @include('afiliado._list_grupo_sanguineo')
                            @error('model.grupo_sanguineo')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <div class="form-floating mb-3">
                            <input type="text" name="egreso" wire:model="model.egreso" class="form-control @error('model.egreso') is-invalid @enderror" placeholder="Egreso" >
                            <label class="form-label" for="egreso">Egreso</label>
                            @error('model.egreso')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <textarea name="domicilio" wire:model="model.domicilio" class="form-control @error('model.domicilio') is-invalid @enderror" placeholder="Domicilio" rows="5" ></textarea>
                    <label class="form-label" for="domicilio">Domicilio</label>
                    @error('model.domicilio')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" name="telefono" wire:model="model.telefono" class="form-control @error('model.telefono') is-invalid @enderror" placeholder="telefono" >
                            <label class="form-label" for="telefono">Telefono</label>
                            @error('model.telefono')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        @if ($file)
                            <img wire:loading.remove wire:target="file" src="{{ $file->temporaryUrl() }}" width="100%" height="auto">
                        @endif
                        <div class="text-center" wire:loading wire:target="file" style="display:none">
                            <span class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </span>
                            Cargando...
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" name="foto" wire:model="file" class="form-control @error('file') is-invalid @enderror" placeholder="Foto" >
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
                            <input type="number" name="anos_servicio" wire:model="model.anos_servicio" class="form-control @error('model.anos_servicio') is-invalid @enderror" placeholder="anos_servicio" >
                            <label class="form-label" for="anos_servicio">{{__('Años de servicio')}}</label>
                            @error('model.anos_servicio')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                    <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:target="file">
                        <i class="bi bi-plus"></i>
                        {{ __('Registrar') }}
                    </button>
                    <button class="btn btn-primary" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                        Siguiente
                    </button>
                </div>
            </form>




        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            {{-- @include('afiliado._requisitos') --}}
            paso 2
        </div>
        <div class="tab-pane fade" id="pills-credencial" role="tabpanel" aria-labelledby="pills-credencial-tab">
            paso 3
        </div>
        <div class="tab-pane fade" id="pills-acreditaciones" role="tabpanel" aria-labelledby="pills-acreditaciones-tab">
            paso 4
        </div>
    </div>




    
</div>
