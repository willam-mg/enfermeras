<div wire:ignore.self class="modal fade bg-modal-over" id="modal-pagomatricula-create">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Nuevo pago matricula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form wire:submit.prevent="store()">
                    <div class="form-floating mb-3">
                        <input wire:model="total" type="text" class="form-control" id="total" placeholder="total">
                        <label class="form-label" for="total">{{__("Costo Matricula")}}</label>
                        @error('total') 
                            <div class="invalid-feedback"> {{ $message }} </div> 
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-floating mb-3">
                                <input wire:model="apagar" type="text" class="form-control" id="apagar" placeholder="apagar" disabled>
                                <label class="form-label" for="apagar">{{__("A pagar")}}</label>
                                @error('apagar') 
                                    <div class="invalid-feedback"> {{ $message }} </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-floating mb-3">
                                <input wire:model="monto" type="text" class="form-control @error('monto') is-invalid @enderror" id="monto" placeholder="Monto">
                                <label class="form-label" for="monto">{{__("Monto")}}</label>
                                @error('monto') 
                                    <div class="invalid-feedback"> {{ $message }} </div> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-floating mb-3">
                                <input wire:model="saldo" type="text" class="form-control" id="saldo" placeholder="Monto" disabled>
                                <label class="form-label" for="saldo">{{__("Saldo")}}</label>
                                @error('saldo') 
                                    <div class="invalid-feedback"> {{ $message }} </div> 
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-secondary close-btn" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i>
                            Cerrar
                        </button>
                        <button type="submit" class="btn btn-success close-modal">
                            <i class="bi bi-plus"></i>
                            Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
