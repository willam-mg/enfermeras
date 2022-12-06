<div>
    <x-page.loading />
    <div wire:ignore.self class="modal bg-modal-over" id="modal-credencial-create" tabindex="3">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Credencial Nueva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="save">
                        <div class="form-floating mb-3">
                            <input type="date" name="fecha_emision" wire:model.defer="model.fecha_emision"  class="form-control" data-date-format="DD MMMM YYYY">
                            <label class="form-label" for="fecha_nacimiento">Fecha emision</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" name="fecha_vensimiento" wire:model.defer="model.fecha_vencimiento" class="form-control" data-date-format="DD MMMM YYYY">
                            <label class="form-label" for="fecha_nacimiento">Fecha vencimiento</label>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-floating  mb-3">
                                    <select wire:model.defer="model.renovacion" id="renovacion" class="form-select @error('model.renovacion') is-invalid @enderror" name="renovacion" aria-label="Renovacion">
                                        <option value="{{\App\Models\Credencial::RENOVACION_NO}}" title="No"> No </option>
                                        <option value="{{\App\Models\Credencial::RENOVACION_SI}}" title="Si"> Si </option>
                                    </select>
                                    <label for="renovacion">Renovacion</label>
                                    @error('model.renovacion')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-floating  mb-3">
                                    <select wire:model.defer="model.estado" id="estado"
                                        class="form-select @error('model.estado') is-invalid @enderror" name="estado" aria-label="Estado">
                                        <option value="{{\App\Models\Credencial::ESTADO_PENDIENTE}}" title="Pendiente"> Pendiente </option>
                                        <option value="{{\App\Models\Credencial::ESTADO_ENTREGADO}}" title="Entregado"> Entregado </option>
                                    </select>
                                    <label for="estado">Estado</label>
                                    @error('model.estado')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="costo_renovacion" wire:model.defer="model.costo_renovacion" class="form-control" >
                            <label class="form-label" for="costo_renovacion">{{__("Costo de renovacion")}}</label>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x"></i>
                                Cerrar
                            </button>
                            <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                                <i class="bi bi-plus"></i>
                                {{ __('Registrar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
