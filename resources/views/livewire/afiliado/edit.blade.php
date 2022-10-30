<div>
    <div wire:ignore.self class="modal" id="modal-afiliado-edit" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Afiliado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update" enctype="multipart/form-data">
                        
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="numero_afiliado" value="{{$model->numer_afiliado}}" wire:model.defer="model.numero_afiliado"
                                        class="form-control @error('model.numero_afiliado') is-invalid @enderror" placeholder="{{__(" N°
                                        afiliado")}}">
                                    <label class="form-label" for="numero_afiliado">{{__("N°
                                        afiliado")}}</label>
                                    @error('model.numero_afiliado')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="cargo" value="{{$model->cargo}}" wire:model.defer="model.cargo"
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
                                    <input type="text" name="nombre_completo" value="{{$model->nombre_completo}}" wire:model.defer="model.nombre_completo"
                                        class="form-control @error('model.nombre_completo') is-invalid @enderror" placeholder="Nombre">
                                    <label class="form-label" for="nombre_completo">Nombre
                                        completo</label>
                                    @error('model.nombre_completo')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" name="numero_matricula" value="{{$model->numero_matricula}}" wire:model.defer="model.numero_matricula"
                                        class="form-control @error('model.numero_matricula') is-invalid @enderror" placeholder="{{__("
                                        N° matricula")}}">
                                    <label class="form-label" for="numero_matricula">{{__("N°
                                        matricula")}}</label>
                                    @error('model.numero_matricula')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="number" name="ci" value="{{$model->ci}}" wire:model.defer="model.ci"
                                        class="form-control @error('model.ci') is-invalid @enderror" placeholder="CI">
                                    <label class="form-label" for="ci">CI</label>
                                    @error('model.ci')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <div class="form-floating  mb-3">
                                    <select wire:model.defer="model.expedido" value="{{$model->expedido}}"
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
                                    <input type="date" name="fecha_nacimiento" value="{{$model->fecha_nacimiento}}" wire:model.defer="model.fecha_nacimiento"
                                        class="form-control @error('model.fecha_nacimiento') is-invalid @enderror"
                                        placeholder="Fecha nacimiento">
                                    <label class="form-label" for="fecha_nacimiento">Fecha
                                        nacimiento</label>
                                    @error('model.fecha_nacimiento')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                
                        <div class="row">
                            <div class="col-xs-12 col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" name="grupo_sanguineo" value="{{$model->grupo_sanguineo}}" wire:model.defer="model.grupo_sanguineo"
                                        list="list_grupo_sanguineo"
                                        class="form-control @error('model.grupo_sanguineo') is-invalid @enderror" placeholder="{{__(" G.
                                        sanguineo")}}">
                                    <label class="form-label" for="grupo_sanguineo">{{__("G.
                                        sanguineo")}}</label>
                                    @include('afiliado._list_grupo_sanguineo')
                                    @error('model.grupo_sanguineo')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <div class="form-floating mb-3">
                                    <input type="text" name="egreso" value="{{$model->egreso}}" wire:model.defer="model.egreso"
                                        class="form-control @error('model.egreso') is-invalid @enderror" placeholder="Egreso">
                                    <label class="form-label" for="egreso">Egreso</label>
                                    @error('model.egreso')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                
                        <div class="form-floating mb-3">
                            <textarea name="domicilio" value="{{$model->domicilio}}" wire:model.defer="model.domicilio"
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
                                    <input type="number" name="telefono" value="{{$model->telefono}}" wire:model.defer="model.telefono"
                                        class="form-control @error('model.telefono') is-invalid @enderror" placeholder="telefono">
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
                                    <input type="number" name="anos_servicio" value="{{$model->anos_servicio}}" wire:model.defer="model.anos_servicio"
                                    class="form-control @error('model.anos_servicio') is-invalid @enderror"
                                    placeholder="anos_servicio">
                                    <label class="form-label" for="anos_servicio">{{__('Años de
                                        servicio')}}</label>
                                    @error('model.anos_servicio')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" name="costo_matricula" wire:model.defer="model.costo_matricula"
                                        class="form-control @error('model.costo_matricula') is-invalid @enderror" placeholder="costo_matricula">
                                    <label class="form-label" for="costo_matricula">{{__('Costo de matricula')}}</label>
                                    @error('model.costo_matricula')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                            <button type="submit" class="btn btn-warning" wire:loading.attr="disabled" wire:target="file">
                                <i class="bi bi-plus"></i>
                                {{ __('Guardar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>