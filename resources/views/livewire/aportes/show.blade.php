<div>
    <div wire:ignore.self class="modal" id="modal-aporte-show" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aporte {{$selected_id}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Gestion :
                                    <b>
                                        {{$attrGestion}}
                                    </b>
                                </li>
                                <li class="list-group-item">
                                    Mes :
                                    <b>
                                        {{$attrMes}}
                                    </b>
                                </li>
                                <li class="list-group-item">
                                    Monto :
                                    <b>
                                        {{$attrMonto}} Bs.
                                    </b>
                                </li>
                                <li class="list-group-item">
                                    Estado :
                                    @if ($attrEstado == \App\Models\Aporte::PENDIENTE)
                                        <span class="badge rounded-pill bg-danger">
                                            Pendiente
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-success">
                                            Pagado
                                        </span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-page.loading />
</div>