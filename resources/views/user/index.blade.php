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
                    <th scope="col"></th>
                    <th scope="col">#</th>
                    <th scope="col">Nombre completo</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownActions" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownActions">
                                    <li>
                                        <a href="{{ route('users.show', $item->id) }}" class="dropdown-item" type="button">
                                            <i class="bi bi-eye"></i> Ver
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users.edit', $item->id) }}" class="dropdown-item" type="button">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        <form class="d-inline" action="{{ route('users.destroy',$item->id) }}" method="POST" data-confirm="Esta seguro de eliminar este elemnto">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </li>
                                    
                                </ul>
                            </div>
                        </td>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->rol_name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
