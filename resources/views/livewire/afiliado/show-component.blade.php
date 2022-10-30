<div>
    <x-page.loading />
    <div  wire:ignore.self  class="modal fade" id="modal-afiliado-show" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <img src="/img/no-image-user.png" alt="foto" width="100%">
                            @endif
                            <h4 class="mt-3">{{$model->nombre_completo}}</h4>
                            <div class="d-grid gap-2 mb-3">
                                <a href="{{ url('afiliados/'.$model->id.'/edit') }}" class="btn btn-warning" type="button">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
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
                                    <button wire:ignore.self class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-acreditaciones" type="button" role="tab"  aria-selected="false">
                                        Acreditaciones
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
                                <div wire:ignore.self class="tab-pane fade" id="pills-acreditaciones" role="tabpanel" aria-labelledby="pills-acreditaciones-tab">
                                    <div class="text-end">
                                        <button class="btn btn-primary" type="button" id="btnPreparar">
                                            <i class="bi bi-cash"></i>
                                            Pagar
                                        </button>
                                    </div>
                                    <form action="{{ url('afiliados', $model->id) }}" method="POST" class="needs-validation disabled-onsubmit" novalidate>
                                        @csrf
                                        @method('GET')
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-3">
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="gestion" value="{{$acreditacionMd->gestion}}" list="list_gestiones" class="form-control @error('gestion') is-invalid @enderror" placeholder="gestion">
                                                    <label class="form-label" for="gestion">Gestion</label>
                                                    @include('acreditacion._list_gestiones')
                                                    @error('gestion')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-3 pt-2">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-search"></i>
                                                    {{ __('Buscar') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    @include('acreditacion._grid_acreditaciones')
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
                    $('input[name^="acreditaciones"]').each(function() {
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
                $('input[name^="acreditaciones"]').prop("checked", true);
            }
            $('#select_meses').on('click', function() {
                if (!allChecked) {
                    checkAll();
                    allChecked = true;
                } else {
                    $('input[name^="acreditaciones"]').prop("checked", false);
                    allChecked = false;
                }
            });
        });
    </script>
@endpush