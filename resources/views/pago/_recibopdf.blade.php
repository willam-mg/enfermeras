<style>
    .full-width {
        width: 100%;
    }
    .text-center{
        text-align: center !important;
    }
    .text-end {
        text-align: right !important;
    }
    .text-uppercase {
        text-transform: uppercase;
    }
    .pt-5 {
        padding-top: 70pt;
    }
</style>
<table class="table table-light full-width">
    <tbody>
        <tr>
            <td class="text-center">
                <img src="{{public_path('img/logo.png')}}" alt="foto" width="70" height="auto">
            </td>
            <td colspan="2" class="text-center">
                <h3>
                    RECIBO <br>
                    Afiliaciones
                </h3>
            </td>
            <td class="text-center">
                <small>
                    Telf.:  4567476 <br>
                    Direccion: Av. <br>
                    principal entre C. junin
                </small>
            </td>
        </tr>
        <tr>
            <td>Recibido de: </td>
            <td colspan="3">
                {{$model->detalle[0]->acreditacion->afiliado->nombre_completo}}
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
                    {{$item->acreditacion->gestion}}
                    {{$item->acreditacion->mes}}, 
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
    </tbody>
</table>