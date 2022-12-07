<div wire:ignore.self class="modal bg-modal-over" id="modal-misaportes-add-gestion" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Agregar Años')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="addGestion()">
                    <div class="form-floating mb-3">
                        <input wire:model.defer="montoToAddGestion" type="number" class="form-control" id="montoToAddGestion"
                            placeholder="montoToAddGestion">
                        <label class="form-label" for="montoToAddGestion">{{__("Monto")}}</label>
                        @error('montoToAddGestion')
                        <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input wire:model.defer="gestionToAdd" type="number" class="form-control" id="gestionToAdd"
                            placeholder="gestionToAdd">
                        <label class="form-label" for="gestionToAdd">{{__("Año")}}</label>
                        @error('gestionToAdd')
                        <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i>
                            Cerrar
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-plus"></i>
                            Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>