@extends('layouts.app')

@section('title', 'Nuevo usuario')

@section('content')
    {{ Breadcrumbs::render('users.create') }}

    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-5">
            <form action="{{ route('users.store') }}" method="POST" class="needs-validation disabled-onsubmit" novalidate>
                @csrf
                @method('POST')
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre" required>
                    <label class="form-label" for="name">Nombre completo</label>
                    @error('name')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
                    <label class="form-label" for="email">Email</label>
                    @error('email')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{__('Contraseña')}}" required>
                    <label class="form-label" for="password">{{__('Contraseña')}}</label>
                    @error('password')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{__('Repetir contraseña')}}" required>
                    <label class="form-label" for="password">{{__('Repetir contraseña')}}</label>
                    @error('password_confirmation')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                
                <div class="form-floating  mb-3">
                    <select class="form-select @error('rol') is-invalid @enderror" id="rol" name="rol" aria-label="Rol">
                        <option selected>{{__('Seleccione el rol')}}</option>
                        <option value="{{App\Models\User::ROL_ADMIN}}">{{__('Administrador')}}</option>
                        <option value="{{App\Models\User::ROL_ASISTENTE}}">{{__('Asistente')}}</option>
                    </select>
                    <label for="rol">Rol</label>
                    @error('rol')
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
@endsection
