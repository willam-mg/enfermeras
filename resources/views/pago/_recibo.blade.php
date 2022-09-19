<table class="table table-light">
    <tbody>
        <tr>
            <td>
                <img src="{{asset('img/logo.png')}}" alt="foto" width="70" height="auto">
            </td>
            <td colspan="2">
                <h3>
                    RECIBO <br>
                    Afiliaciones
                </h3>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>Recibido de: </td>
            <td colspan="3">
                @foreach ($model->detalle as $item)
                    {{$item->acreditacion->afiliado->nombre_completo}}
                @endforeach
            </td>
        </tr>
        <tr>
            <td>La suma de: </td>
            <td colspan="3">
                @foreach ($model->detalle as $item)
                    {{$item->monto}}
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Por concepto de : </td>
            <td colspan="3">
                @foreach ($model->detalle as $item)
                    {{$item->acreditacion->gestion}} - 
                    {{$item->acreditacion->mes}}
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
            <td colspan="2">Entregue conforme</td>
            <td colspan="2">Recibi conforme</td>
        </tr>
    </tbody>
</table>