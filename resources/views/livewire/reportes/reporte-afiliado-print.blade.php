<h1>Reporte de afiliados</h1>
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
            <tr>
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