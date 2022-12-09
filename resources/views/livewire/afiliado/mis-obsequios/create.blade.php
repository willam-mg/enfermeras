<div wire:ignore.self class="modal fade bg-modal-over" id="modal-misobsequios-entrega-create" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Entrega de obsequio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="entregar()">
                <div class="modal-body">
                    <input type="hidden" wire:model="selected_id">
                    <div class="row mb-3">
                        <div class="col-xs-12 col-sm-6 col-mg-6">
                            <div class="form-floating mb-3">
                                <input wire:model.defer="fecha_entrega" type="date" class="form-control" id="fecha_entrega"
                                    placeholder="fecha_entrega">
                                <label class="form-label" for="fecha_entrega">{{__("Fecha entrega")}}</label>
                                @error('fecha_entrega')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-mg-6">
                            <div class="form-floating mb-3">
                                <input wire:model.defer="hora_entrega" type="time" class="form-control" id="hora_entrega" placeholder="hora_entrega">
                                <label class="form-label" for="hora_entrega">{{__("Hora entrega")}}</label>
                                @error('hora_entrega')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea wire:model.defer="observacion" class="form-control" id="observacion" placeholder="observacion">
                        </textarea>
                        <label class="form-label" for="observacion">{{__("Observacion")}}</label>
                        @error('observacion')
                        <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x"></i>
                        Cerrar
                    </button>
                    <button class="btn btn-success" onclick="misObsequiosEntregar()" wire:loading.attr="disabled" type="submit">
                        <i class="bi bi-plus"></i>
                        Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>