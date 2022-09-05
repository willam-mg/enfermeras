@extends('layouts.app')

@section('title', 'Afiliados')

@section('content')
    {{ Breadcrumbs::render('afiliados') }}

    <div class="mb-3 text-end">
        <a href="{{url('/afiliados/create')}}" class="btn btn-success">
            <i class="bi bi-plus"></i>
            Nuevo afiliado
        </a>
    </div>
    @include('afiliado._search')
    <div class="table-responsive mb-3">
        <table class="table align-middle table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class="text-nowrap">{{__("Foto")}}</th>
                    <th scope="col" class="text-nowrap">{{__("N° afiliado")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Cargo")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Nombre completo")}}</th>
                    <th scope="col" class="text-nowrap">{{__("N° matricula")}}</th>
                    <th scope="col" class="text-nowrap">{{__("CI.")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Fecha nacimiento")}}</th>
                    <th scope="col" class="text-nowrap">{{__("G. Sangueneo")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Egreso")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Domicilio")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Telefono")}}</th>
                    <th scope="col" class="text-nowrap">{{__("Fecha registro")}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr data-href="{{ route('afiliados.show', $item->id) }}">
                        <td>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownActions" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownActions">
                                    <li>
                                        <a href="{{ route('afiliados.show', $item->id) }}" class="dropdown-item" type="button">
                                            <i class="bi bi-eye"></i> Ver
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('afiliados.edit', $item->id) }}" class="dropdown-item" type="button">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        <form class="d-inline" action="{{ route('afiliados.destroy',$item->id) }}" method="POST" data-confirm="Esta seguro de eliminar este elemnto">
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
                        <td>
                            @if ($item->foto)
                                <img src="{{$item->foto_thumbnail_sm}}" alt="foto" width="50">
                            @else
                                <img src="/img/no-image-user.png" alt="foto" width="50">
                            @endif
                        </td>
                        <td>{{$item->numero_afiliado}}</td>
                        <td>{{$item->cargo}}</td>
                        <td>{{$item->nombre_completo}}</td>
                        <td>{{$item->numero_matricula}}</td>
                        <td>{{$item->ci}}</td>
                        <td>{{$item->fecha_nacimiento}}</td>
                        <td>{{$item->grupo_sanguineo}}</td>
                        <td>{{$item->egreso}}</td>
                        <td>{!! Str::limit($item->domicilio, 10, ' ...') !!}</td>
                        <td>{{$item->telefono}}</td>
                        <td>{{$item->fecha_registro}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row mb-3">
        <div class="col-xs-12 col-md-6">
            <div>Mostrando {{($data->currentpage()-1)*$data->perpage()+1}} al {{$data->currentpage()*$data->perpage()}}
                de  {{$data->total()}} registros
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="btn-group float-end">
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection