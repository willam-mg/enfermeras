<div>
    <x-page.loading />
    <div  wire:ignore.self  class="modal fade" id="modal-afiliado-show" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Afiliado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-xs-12 col-md-3 mb-3">
                            @if ($model->foto)
                                <img src="{{$model->foto_thumbnail}}" alt="foto" width="100%">
                            @else
                                <img src="{{asset('images/no-image-user.png')}}" alt="foto" width="100%">
                            @endif
                            <h4 class="mt-3 text-uppercase text-center">{{$model->nombre_completo}}</h4>
                            <div class="d-grid gap-2 mb-3">
                                <button wire:click="$emitTo('afiliado.edit', 'display-edit', {{$model->id}})" class="btn btn-warning" type="button">
                                    <i class="bi bi-pencil"></i> Editar
                                </button>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-9">
                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item">
                                    <button wire:ignore.self class="nav-link active" data-bs-toggle="pill" data-bs-target="#pills-info-afiliado" type="button" role="tab"  aria-selected="true">
                                        Datos personales
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button wire:ignore.self class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-requisitos" type="button" role="tab" aria-selected="false">
                                        Requisitos
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button wire:ignore.self class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-credencial" type="button" role="tab"  aria-selected="false">
                                        Credencial
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button wire:ignore.self class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-matricula" type="button" role="tab"  aria-selected="false">
                                        Matricula
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button wire:ignore.self class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-aportes" type="button" role="tab"  aria-selected="false">
                                        Aportes
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button wire:ignore.self class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-mis-pagos" type="button"
                                        role="tab" aria-selected="false">
                                        Pagos
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button wire:ignore.self class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-mis-obsequios" type="button"
                                        role="tab" aria-selected="false">
                                        Obsequios
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent-afiliado">
                                <div wire:ignore.self class="tab-pane fade show active" id="pills-info-afiliado" role="tabpanel" aria-labelledby="pills-info-afiliado-tab">
                                    @include('afiliado._datos')
                                </div>
                                <div wire:ignore.self class="tab-pane fade" id="pills-requisitos" role="tabpanel" aria-labelledby="pills-requisitos-tab">
                                    <div>
                                        @include('afiliado._requisitos')
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane fade" id="pills-credencial" role="tabpanel" aria-labelledby="pills-credencial-tab">
                                    <livewire:credencial.index wire:key="credencial-index" />
                                    <livewire:credencial.create wire:key="credencial-create" />
                                    <livewire:credencial.edit wire:key="credencial-edit" />
                                    <livewire:credencial.show wire:key="credencial-show" />
                                </div>
                                <div wire:ignore.self class="tab-pane fade" id="pills-aportes" role="tabpanel" aria-labelledby="pills-aportes-tab">
                                    <livewire:afiliado.mis-aportes key="afiliado-misaportes" />
                                </div>
                                <div wire:ignore.self class="tab-pane fade" id="pills-matricula" role="tabpanel" aria-labelledby="pills-matricula-tab">
                                    <livewire:pago-matriculas />
                                </div>
                                <div wire:ignore.self class="tab-pane fade" id="pills-mis-pagos" role="tabpanel" aria-labelledby="pills-mis-pagos-tab">
                                    <livewire:afiliado.mis-pagos  key="afiliado-mispagos" />
                                </div>
                                <div wire:ignore.self class="tab-pane fade" id="pills-mis-obsequios" role="tabpanel" aria-labelledby="pills-mis-pagos-tab">
                                    <livewire:afiliado.mis-obsequios  key="afiliado-misobsequios" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            var allChecked = false;
            $("#btnSelectAll").on("click", function() {
                $('.form-check-input').prop('checked', true);
            });
            $('#btnPreparar').on('click', function(e) {
                e.preventDefault();
                if ( confirm("Pagar estas mensualidades ?") ) {
                    let myArray = [];
                    $('input[name^="aportes"]').each(function() {
                        if ($(this).prop("checked") === true) {
                            let id = $(this).val();
                            myArray.push(id);
                        }
                    });
                    var arrStr = encodeURIComponent(JSON.stringify(myArray));
                    window.location.href = '/pagos/create?seleccionados=' + arrStr;
                }
            });

            function checkAll() {
                $('input[name^="aportes"]').prop("checked", true);
            }
            $('#select_meses').on('click', function() {
                if (!allChecked) {
                    checkAll();
                    allChecked = true;
                } else {
                    $('input[name^="aportes"]').prop("checked", false);
                    allChecked = false;
                }
            });
        });
    </script>
@endpush