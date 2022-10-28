<style>
    * {
        margin: 0;
    }
    .wrapper-print {
        width: 210mm;
        /* height: 420.94488pt; */
        height: 148.5mm;
        margin:0;
        padding: 5mm;
        position: absolute;
    }
    table{
        /* width: 100%; */
        width: 200mm;
        /* height: 100%; */
        height: 138.5mm;
        /* height: 420.94488pt; */
    }
    td {
        padding:2mm;
    }
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
        padding-top: 40mm;
    }
    td {
        font-family: Arial, Helvetica, sans-serif;
        /* border: 1px solid black; */
    }
    body {
        margin: 0;
        background-image: url( {{ public_path('img/isotipo-marcaagua.png') }} );
        background-size:100%;
        background-repeat: repeat-x;
        /* background-position: left; */
    }
</style>

<div class="wrapper-print">
    <table class="table table-light">
        <tbody>
            <tr>
                <td class="text-center" style="width:50mm;">
                    <img src="{{public_path('img/logo-landscape.png')}}" alt="foto" width="150" height="auto">
                </td>
                <td colspan="2" class="text-center">
                    <h1>
                        RECIBO <br>
                    </h1>
                </td>
                <td class="text-center" style="width:50mm;">
                    <small>
                        {{__('Teléfonos: 4317867 - 4525971')}} <br>
                        {{__('Dirección: C. Colombia entre C. 16 de julio y Av. Oquendo Edificio Rochavel Bloque 1 Piso 1 Oficina 6')}} <br>
                    </small>
                </td>
            </tr>
            <tr>
                <td>Recibido de: </td>
                <td colspan="3" style="font-weight: bold;">
                    {{$model->detalle[0]->acreditacion->afiliado->nombre_completo}}
                </td>
            </tr>
            <tr>
                <td>La suma de: </td>
                <td colspan="3" style="font-weight: bold;">
                    {{$model->total + $model->detalle[0]->acreditacion->afiliado->costo_matricula}}
                </td>
            </tr>
            <tr>
                <td>Por concepto de : </td>
                <td colspan="3" style="font-weight: bold;">
                    @foreach ($model->detalle as $item)
                        {{$item->acreditacion->mes}}  
                        {{$item->acreditacion->gestion}}, 
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Hora</td>
                <td style="font-weight: bold;">{{$model->hora}}</td>
                <td>Fecha</td>
                <td style="font-weight: bold;">{{$model->fecha}}</td>
            </tr>
            <tr>
                <td colspan="2" class="pt-5 text-center">
                _________________________ <br/>
                    Entregue conforme
                </td>
                <td colspan="2" class="pt-5 text-center">
                _________________________ <br/>
                    Recibi conforme
                </td>
            </tr>
            <tr>
                <td colspan="4" class="text-center" style="padding-top:5mm;">
                    {{__('Asociación Departamental de Enfermeras(os) Auxiliares de Cochabamba')}} <br>
                </td>
            </tr>
        </tbody>
    </table>
</div>