<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-mispagos-show" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="misPagosShowModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="misPagosShowModalLabel">
                    Pago
                    {{$model->id}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        Registrado por: 
                        <b> {{$model->user?$model->user->name:''}} </b> <br>
                        Fecha: 
                        <b> {{$model->fecha}} </b> <br>
                        Hora: 
                        <b> {{$model->hora}} </b> 
                    </div>
                    <div class="col-xs-12 col-md-6 align-middle">
                        <h3>Total: {{$model->total}} Bs. </h3>
                    </div>
                </div>
                
                <hr>

                <div class="mb-3">
                    <b>Detalle</b>
                </div>

                <div class="table-responsive mb-3">
                    <table class="table align-middle table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Monto (Bs.)</th>
                                <th>Gestion</th>
                                <th>Mes</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model->detalle as $row)
                            <tr title="Seleccionar Pago">
                                <td>{{ $row->id }}</td>
                                <td>
                                    <b>
                                        {{ $row->monto }}
                                    </b>
                                </td>
                                <td>
                                    @if ($row->aporte)
                                        {{$row->aporte->gestion}}
                                    @else
                                        <x-page.noexists :value="$row->aporte_id" />
                                    @endif
                                </td>
                                <td class="text-capitalize">
                                    @if ($row->aporte)
                                        {{$row->aporte->mes_name}}
                                    @else
                                        <x-page.noexists :value="$row->aporte_id" />
                                    @endif
                                </td>
                                <td>
                                    @if ($row->aporte)
                                        @if ($row->aporte->estado == \App\Models\Aporte::PENDIENTE)
                                            <span class="badge rounded-pill bg-danger">Pendiente</span>
                                        @else
                                            <span class="badge rounded-pill bg-success">Pagado</span>
                                        @endif
                                    @else
                                        <x-page.noexists :value="$row->aporte_id" />
                                    @endif
                                </td>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
       </div>
    </div>
</div>
