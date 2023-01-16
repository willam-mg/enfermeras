<div>
    <div wire:ignore.self class="modal" id="modal-aporte-edit" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aporte {{$selected_id}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update()">
                        <div class="form-floating mb-3">
                            <input wire:model.defer="attrMonto" type="number" class="form-control" placeholder="attrMonto">
                            <label class="form-label" for="attrMonto">{{__("Monto")}}</label>
                            @error('attrMonto')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    
                        <div class="text-end">
                            <button type="button" wire:click.prevent="$set('selected_id', false)" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">
                                <i class="bi bi-x"></i>
                                Cerrar
                            </button>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-pencil"></i>
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-page.loading />
</div>