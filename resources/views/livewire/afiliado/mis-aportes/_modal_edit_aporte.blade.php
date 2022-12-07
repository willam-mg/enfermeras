<div wire:ignore.self class="modal bg-modal-over" id="modal-misaportes-{{$itemAporte->id}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aporte {{$itemAporte->mes_name.' '.$itemAporte->gestion}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="updateAporte({{$itemAporte->id}})">
                    {{-- <input type="hidden" wire:model="miAporteSelected_id"> --}}
                    <div class="form-floating mb-3">
                        <input wire:model.defer="miAporteMonto" type="number" class="form-control"
                            value="{{$itemAporte->monto}}" id="miAporteMonto" placeholder="miAporteMonto">
                        <label class="form-label" for="miAporteMonto">{{__("Monto")}}</label>
                        @error('miAporteMonto')
                        <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="text-end">
                        {{-- wire:click.prevent="cancel()" --}}
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
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