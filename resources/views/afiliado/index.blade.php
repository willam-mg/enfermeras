@extends('layouts.app')

@section('title', 'Afiliados')

@section('content')
    {{ Breadcrumbs::render('afiliados') }}

    @include('afiliado._search')
    <div class="text-end">
        <a href="{{url('/afiliados/create')}}" class="btn btn-success">
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
                    <th scope="col">Ci</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$item->nombre_completo}}</td>
                        <td>{{$item->ci}}</td>
                        <td>{{$item->telefono}}</td>
                        <td>{{$item->celular}}</td>
                        <td>{{$item->direccion}}</td>
                        <td>
                            <a href="{{ route('afiliados.edit', $item->id) }}" class="d-inline btn btn-outline-secondary">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form class="d-inline" action="{{ route('afiliados.destroy',$item->id) }}" method="POST" data-confirm="Esta seguro de eliminar este elemnto">
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
