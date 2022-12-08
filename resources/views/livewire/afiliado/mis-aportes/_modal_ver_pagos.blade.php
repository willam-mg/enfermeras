<div wire:ignore.self class="modal bg-modal-over" id="modal-misaportes-verpagos" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pagos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive mb-3">
                    <table class="table align-middle table-bordered table-hover table-row-pointer">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Registrado por</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Monto</th>
                                <th>Con matricula</th>
                                <th>Total (Bs.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($attrPagos) > 0)
                            @foreach($attrPagos as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>
                                    @if ($row->pago)
                                    @if ($row->pago->user)
                                    {{$row->pago->user->name}}
                                    @else
                                    <x-page.noexists :value="$row->pago->user_id" />
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($row->pago)
                                    {{ $row->pago->fecha }}
                                    @else
                                    <x-page.noexists :value="$row->pago_id" />
                                    @endif
                                </td>
                                <td>
                                    @if ($row->pago)
                                    {{ $row->pago->hora }}
                                    @else
                                    <x-page.noexists :value="$row->pago_id" />
                                    @endif
                                </td>
                                <td>
                                    {{$row->monto}}
                                </td>
                                <td>
                                    @if ($row->pago)
                                    @if($row->pago->pagoMatricula)
                                    {{ $row->pago->pagoMatricula->monto }}
                                    @else
                                    <span class="badge bg-secondary">No</span>
                                    @endif
                                    @else
                                    <x-page.noexists :value="$row->pago_id" />
                                    @endif
                                </td>
                                <td>
                                    <b>
                                        @if ($row->pago)
                                        {{$row->pago->total}}
                                        @else
                                        <x-page.noexists :value="$row->pago_id" />
                                        @endif
                                    </b>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="text-center">
                                    No hay resultados
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>