<table class="table table-light">
    <tbody>
        <tr>
            <td class="text-center">
                <img src="{{asset('img/logo.png')}}" alt="foto" width="70" height="auto">
            </td>
            <td colspan="2" class="text-center">
                <h3>
                    RECIBO <br>
                    Afiliaciones
                </h3>
            </td>
            <td class="text-center">
                <small>
                    {{__('Teléfono: 4317867 - 4525971')}} <br>
                    {{__('Dirección: C. Colombia entre C. 16 de julio y Av. Oquendo Edificio')}} <br>
                    {{__('Rochavel Bloque 1 Piso 1 Oficina 6 ')}}
                </small>
            </td>
        </tr>
        <tr>
            <td>Recibido de: </td>
            <td colspan="3">
                {{$model->detalle[0]->aporte->afiliado->nombre_completo}}
            </td>
        </tr>
        <tr>
            <td>La suma de: </td>
            <td colspan="3">
                {{$model->total}}
            </td>
        </tr>
        <tr>
            <td>Por concepto de : </td>
            <td colspan="3">
                @foreach ($model->detalle as $item)
                    {{$item->aporte->gestion}}
                    {{$item->aporte->mes}}, 
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Hora</td>
            <td>{{$model->hora}}</td>
            <td>Fecha</td>
            <td>{{$model->fecha}}</td>
        </tr>
        <tr>
            <td colspan="2" class="pt-5 text-center">
                Entregue conforme
            </td>
            <td colspan="2" class="pt-5 text-center">Recibi conforme</td>
        </tr>
        <tr>
            <td colspan="4" class="text-center">
                {{__('Asociación Departamental de Enfermeras(os) Auxiliares de Cochabamba')}} <br>
            </td>
        </tr>
    </tbody>
</table>