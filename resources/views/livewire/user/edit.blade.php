@section('title', 'Editar '.$model->name)
<div>
    <div wire:ignore.self class="modal" id="modal-user-edit" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Usuario {{$model->id}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-3">                            <input type="text" name="name" wire:model.defer="model.name" class="form-control @error('model.name') is-invalid @enderror" placeholder="Nombre"
                                value="{{ $model->name }}" required>
                            <label class="form-label" for="name">Nombre completo</label>
                            @error('model.name')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" wire:model.defer="model.email" class="form-control @error('model.email') is-invalid @enderror" placeholder="Email"
                                value="{{ $model->email }}" required>
                            <label class="form-label" for="email">Email</label>
                            @error('model.email')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    
                        <div class="form-floating  mb-3">
                            <select class="form-select @error('model.rol') is-invalid @enderror" wire:model.defer="model.rol" id="rol" name="rol" aria-label="Rol">
                                <option value="{{App\Models\User::ROL_ADMIN}}" @if($model->rol == App\Models\User::ROL_ADMIN)
                                    selected="selected" @endif>Adminsitrador</option>
                                <option value="{{App\Models\User::ROL_ASISTENTE}}" @if($model->rol == App\Models\User::ROL_ASISTENTE)
                                    selected="selected" @endif>Asistente</option>
                            </select>
                            <label for="rol">Rol</label>
                            @error('model.rol')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    
                        <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-plus"></i>
                                {{ __('Modificar') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
