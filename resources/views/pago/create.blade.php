@extends('layouts.app')

@section('title', 'Nuevo pago')

@section('content')
    {{ Breadcrumbs::render('pagos.create') }}

    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-5">
            <form action="{{ route('pagos.store') }}" method="POST" class="needs-validation disabled-onsubmit" novalidate>
                @csrf
                @method('POST')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <input type="hidden" value="{{$afiliado->id}}">
                        <h4>
                            <i class="bi bi-person"></i> 
                            {{$afiliado->nombre_completo}}
                        </h4>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <table class="table table-light">
                            <thead>
                                <tr>
                                    <th>Gestion</th>
                                    <th>Mes</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($acreditaciones as $item)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="seleccionados[]" value="{{$item->id}}">
                                            {{$item->gestion}}
                                        </td>
                                        <td>
                                            {{$item->mes}}
                                        </td>
                                        <td>
                                            {{$item->monto}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end">
                                        <h4>
                                            Total: {{$total}}
                                        </h4>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
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
