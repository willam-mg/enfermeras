@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    {{ Breadcrumbs::render('users') }}
    <div class="text-end">
        <a href="{{url('/users/create')}}" class="btn btn-success">
            <i class="bi bi-plus"></i>
            Nuevo
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre completo</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->rol_name}}</td>
                        <td>
                            <a href="{{ route('users.edit', $item->id) }}" class="d-inline btn btn-outline-secondary">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form class="d-inline" action="{{ route('users.destroy',$item->id) }}" method="POST" data-confirm="Esta seguro de eliminar este elemnto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-3 btn btn-outline-secondary">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
