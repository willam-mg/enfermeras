<div wire:ignore.self class="modal bg-modal-over" id="modal-misaportes-edit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize">Aporte {{$selected_id}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-capitalize text-center">
                        <h4>
                            Mes: {{$attrMes}}
                        </h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center">
                        <h4>
                            {{__('Año')}}: {{$attrGestion}}
                        </h4>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2 text-center align-middle">
                        @if ($attrEstado == \App\Models\Aporte::PENDIENTE)
                            <span class="badge rounded-pill bg-danger">
                                Pendiente
                            </span>
                        @else
                            <span class="badge rounded-pill bg-success">
                                Pagado
                            </span>
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-center align-middle">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="$('#modal-misaportes-verpagos').modal('show')">
                            <i class="bi bi-cash"></i>
                            Ver pago
                        </button>
                        @include('livewire.afiliado.mis-aportes._modal_ver_pagos')
                    </div>
                </div>
                
                <form wire:submit.prevent="update()">
                    <div class="form-floating mb-3">
                        <input wire:model.defer="attrMonto" type="number" class="form-control" placeholder="attrMonto">
                        <label class="form-label" for="attrMonto">{{__("Monto")}}</label>
                        @error('attrMonto')
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