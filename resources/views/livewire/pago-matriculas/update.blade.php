<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-pagomatricula-edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="PagoMatriculaEditUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PagoMatriculaEditUpdateModalLabel">Editar Pago matricula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update()">
					<input type="hidden" wire:model="selected_id">
                    <div class="form-floating mb-3">
                        <input wire:model="monto" type="number" class="form-control" id="monto" placeholder="monto">
                        <label class="form-label" for="monto">{{__("Monto")}}</label>
                        @error('monto')
                        <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-warning">Guardar</button>
                    </div>
                </form>
            </div>
       </div>
    </div>
</div>
