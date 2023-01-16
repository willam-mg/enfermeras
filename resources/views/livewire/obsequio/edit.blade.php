<div>
    <div wire:ignore.self class="modal" id="modal-obsequio-edit" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Obsequio {{$selected_id}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update()">
                        <div class="form-floating mb-3">
                            <input wire:model.defer="gestion" type="number" disabled class="form-control"
                                placeholder="Gestion">
                            <label class="form-label" for="gestion">{{__("Gestion")}}</label>
                            @error('gestion')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input wire:model.defer="fecha_entrega" type="date" class="form-control" placeholder="Fecha">
                            <label class="form-label" for="fecha_entrega">{{__("Fecha")}}</label>
                            @error('fecha_entrega')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input wire:model.defer="hora_entrega" type="time" min="09:00" class="form-control" placeholder="Hora">
                            <label class="form-label" for="hora_entrega">{{__("Hora")}}</label>
                            @error('hora_entrega')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <textarea wire:model.defer="observacion" class="form-control" placeholder="Observacion">
                            </textarea>
                            <label class="form-label" for="observacion">{{__("Observacion")}}</label>
                            @error('observacion')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <select wire:model.defer="estado" class="form-control" placeholder="Estado">
                                <option value="{{\App\Models\Obsequio::PENDIENTE}}">Pendiente</option>
                                <option value="{{\App\Models\Obsequio::ENTREGADO}}">Entregado</option>
                            </select>
                            <label class="form-label" for="estado">{{__("Estado")}}</label>
                            @error('estado')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="button" wire:click.prevent="$set('selected_id', false)" class="btn btn-outline-secondary" data-bs-dismiss="modal">
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