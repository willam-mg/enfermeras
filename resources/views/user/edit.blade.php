@extends('layouts.main')

@section('title', 'Editar '.$model->name)

@section('content')
    {{ Breadcrumbs::render('users.edit', $model) }}

    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-5">
            <form action="{{ route('users.update', $model->id) }}" method="POST" class="needs-validation disabled-onsubmit" novalidate>
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre" value="{{ $model->name }}" required>
                    <label class="form-label" for="name">Nombre completo</label>
                    @error('name')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ $model->email }}" required>
                    <label class="form-label" for="email">Email</label>
                    @error('email')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                
                <div class="form-floating  mb-3">
                    <select class="form-select @error('rol') is-invalid @enderror" id="rol" name="rol" aria-label="Rol">
                        <option value="{{App\Models\User::ROL_ADMIN}}" @if($model->rol == App\Models\User::ROL_ADMIN) selected="selected" @endif>Adminsitrador</option>
                        <option value="{{App\Models\User::ROL_ASISTENTE}}" @if($model->rol == App\Models\User::ROL_ASISTENTE) selected="selected" @endif>Asistente</option>
                    </select>
                    <label for="rol">Rol</label>
                    @error('rol')
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
@endsection
