@extends('layouts.main')

@section('title', 'Pagos')

@section('content')
    {{ Breadcrumbs::render('pagos') }}
    <div class="text-end">
        <a href="{{url('/pagos/create')}}" class="btn btn-success">
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
                    <th scope="col">Usuario</th>
                    <th scope="col">Fecha</th>
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
                                        <a href="{{ route('pagos.show', $item->id) }}" class="dropdown-item" type="button">
                                            <i class="bi bi-eye"></i> Ver
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="{{ route('pagos.edit', $item->id) }}" class="dropdown-item" type="button">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                    </li> --}}
                                    <li>
                                        <form class="d-inline" action="{{ route('pagos.destroy',$item->id) }}" method="POST" data-confirm="Esta seguro de eliminar este elemnto">
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
                        <td>{{$item->user}}</td>
                        <td>{{$item->fecha}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
