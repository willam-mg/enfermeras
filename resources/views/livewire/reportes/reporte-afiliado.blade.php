<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="input-group mb-3">
            <input type="text" class="form-control" wire:model="nombreCompleto" placeholder="{{__(" Nombre completo")}}" aria-label="Nombre completo" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>
    <div class="col-xs-12 col-md-8 text-end">
        <button class="btn btn-dark" onclick="printInWindow('{{url('api/reportes/print/afiliados')}}')">
            <i class="bi bi-printer"></i>
            Imprimir
        </button>
    </div>
</div>

<div class="table-responsive mb-3">
    <table class="table table-sm align-middle table-bordered table-hover table-row-pointer">
        <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col" class="text-nowrap">{{__("N° afiliado")}}</th>
                <th scope="col" class="text-nowrap">{{__("Cargo")}}</th>
                <th scope="col" class="text-nowrap">{{__("Nombre completo")}}</th>
                <th scope="col" class="text-nowrap">{{__("N° matricula")}}</th>
                <th scope="col" class="text-nowrap">{{__("CI.")}}</th>
                <th scope="col" class="text-nowrap">{{__("Fecha nacimiento")}}</th>
                <th scope="col" class="text-nowrap">{{__("Egreso")}}</th>
                <th scope="col" class="text-nowrap">{{__("Telefono")}}</th>
                <th scope="col" class="text-nowrap">{{__("Fecha registro")}}</th>
                <th scope="col" class="text-nowrap">{{__("Años servicio")}}</th>
                <th scope="col" class="text-nowrap">{{__("Costo matricula")}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
            <tr onclick="onSelectAfiliado({{$item->id}}, this, event)" title="Seleccionar Afiliado">
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->numero_afiliado}}</td>
                <td>{{$item->cargo}}</td>
                <td>{{$item->nombre_completo}}</td>
                <td>{{$item->numero_matricula}}</td>
                <td>{{$item->ci}}</td>
                <td>{{$item->fecha_nacimiento}}</td>
                <td>{!! Str::limit($item->egreso, 5, ' ...') !!}</td>
                <td>{{$item->telefono}}</td>
                <td>{{$item->fecha_registro}}</td>
                <td>{{$item->anos_servicio}}</td>
                <td>{{$item->costo_matricula}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="row mb-3">
    <div class="col-xs-12 col-md-6">
        <div>Mostrando {{($data->currentpage()-1)*$data->perpage()+1}} al {{$data->currentpage()*$data->perpage()}}
            de {{$data->total()}} registros
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="btn-group float-end">
            {{$data->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<x-page.loading />
