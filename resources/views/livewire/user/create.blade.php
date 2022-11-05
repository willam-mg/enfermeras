<div>
    <x-page.loading />
    <div wire:ignore.self class="modal" id="modal-user-create" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        @csrf
                        @method('POST')
                        <div class="form-floating mb-3">
                            <input type="text" name="name" wire:model.defer="model.name" class="form-control @error('model.name') is-invalid @enderror"
                                placeholder="Nombre" required>
                            <label class="form-label" for="name">Nombre completo</label>
                            @error('model.name')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" wire:model.defer="model.email" class="form-control @error('model.email') is-invalid @enderror"
                                placeholder="Email" required>
                            <label class="form-label" for="email">Email</label>
                            @error('model.email')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" wire:model.defer="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{__('Contraseña')}}" required>
                            <label class="form-label" for="password">{{__('Contraseña')}}</label>
                            @error('password')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password_confirmation" wire:model.defer="passwordConfirmation"
                                class="form-control @error('passwordConfirmation') is-invalid @enderror"
                                placeholder="{{__('Repetir contraseña')}}" required>
                            <label class="form-label" for="password">{{__('Repetir contraseña')}}</label>
                            @error('passwordConfirmation')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
            
                        <div class="form-floating  mb-3">
                            <select class="form-select @error('model.rol') is-invalid @enderror" id="rol" name="rol" wire:model.defer="model.rol" aria-label="Rol">
                                <option selected>{{__('Seleccione el rol')}}</option>
                                <option value="{{App\Models\User::ROL_ADMIN}}">{{__('Administrador')}}</option>
                                <option value="{{App\Models\User::ROL_ASISTENTE}}">{{__('Asistente')}}</option>
                            </select>
                            <label for="rol">Rol</label>
                            @error('model.rol')
                            <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
            
                        <div class="col-xs-12 col-sm-12 col-md-12 text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-plus"></i>
                                {{ __('Registrar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
