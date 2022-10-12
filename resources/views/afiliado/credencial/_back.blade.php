<table class="table table-light" style="width: 83.9322916667mm; height: 52.9322916667mm; margin: 1mm;">
        <tbody>
            <tr>
                <td colspan="3">
                    {{__('Emisión: ')}}
                    <b>
                        {{$fecha_inicio}}
                    </b>
                    {{__('Vencimiento: ')}}
                    <b>
                        {{$fecha_fin}}
                    </b>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="height: 24px !important">
                    Egreso:
                    <b class="text-uppercase">
                        {{$model->egreso}}
                    </b>
                </td>
            </tr>
            <tr>
                <td>
                    {{__('Años de servicio: ')}}
                    <b>
                        {{$model->anos_servicio}}
                    </b>
                </td>
                <td colspan="2">
                    {{__('Grupo sanguíneo: ')}}
                    <b>
                        {{$model->grupo_sanguineo}}
                    </b>
                </td>
            </tr>
            <tr>
                <td rowspan="2" style="padding: 2px 0 5px 10px ">
                    <?=DNS2D::getBarcodeHTML($model->numero_afiliado, 'QRCODE', 3.5, 3.5)?>
                </td>
                <td colspan="2" rowspan="2">
                </td>
            </tr>
            <tr>
                <td>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 5pt;  line-height : 8px;">
                    {{__('Asociación Departamental de Enfermeras(os) Auxiliares de Cochabamba')}} <br>
                    {{__('Teléfono: 4317867 - 4525971')}} <br>
                    {{__('Dirección: C. Colombia entre C. 16 de julio y Av. Oquendo Edificio')}} <br>
                    {{__('Rochavel Bloque 1 Piso 1 Oficina 6 ')}}
                </td>
                <td class="text-center" style="width: 80px">
                    <img src="{{public_path('img/logo-v2.svg')}}" alt="foto" width="70" height="auto">
                </td>
            </tr>
        </tbody>
    </table>
    <div class="border-styled-back">
    </div>
    <div class="marca-agua">
        <img src="{{public_path('img/logo-redondo-marcaagua.png')}}" alt="foto" width="120" height="auto">
    </div>