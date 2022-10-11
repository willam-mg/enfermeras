
<style>
    *{ padding: 0; margin:0; font-size: 9px; font-family: Cambria;
        border: 0;
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
    .bg-gray-1 {
        background-color: rgb(214, 214, 214);
    }
    .bg-gray-2 {
        background-color: rgb(189, 189, 189);
    }
    .wrapper-card {
        /* width: 321.25984266666666px; */
        /* width: 100%; */
        height: 200.31496px;
        position: relative;
        z-index: 3;
        /* border: 0.5px solid black; */
    }
    .aside{
        position: absolute;
        top: 70px;
        right: -63px;
        letter-spacing: 3px;
        text-transform: uppercase;
        background: #137a45;
        color: #fff;
        padding: 5px 12px 5px 12px;
        transform: rotate(90deg);
        border-radius: 0 0 5px 5px;
        z-index: 4;
    }
    .text-white {
        color: white;
    }
    .text-purple {
        /* color: #006691; */
        color: #015980;
    }
    .p-5 {
        padding: 5px;
    }





    .img-profile {
        border-radius: 50%;
    }
    .page-break {
        page-break-after: always;
    }
    .border-styled {
        display: block;
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px;
        /* background-color: #40cfff; */
        /* background-color: #0979b0; */
        /* background-color: #48dbfb; */
        background-color: #0abde3;
        z-index: 0;
    }

    .border-styled-white {
        display: block;
        position: absolute;
        bottom: 25px;
        right: 15px;
        width: 155px;
        height: 60px;
        background-color:white;
        border-radius: 0 0 10px 10px ;
        z-index: 1;
    }

    .border-styled-back {
        display: block;
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px;
        /* background-color: #40cfff; */
        /* background-color: #0979b0; */
        /* background-color: #48dbfb; */
        background-color: #0abde3;
        z-index: 0;
    }
    .marca-agua {
        display: block;
        position: absolute;
        bottom: 0;
        
        /* width: 321.25984266666666px; */
        width: 100%;
        /* height: 200.31496px; */
        /* background-position: center; */
        /* background-color: rgb(1, 2, 1, 0.3); */
        /* border: 1px solid black; */
        z-index: 2;
        /* padding-top: 75px; */
        text-align: center;
        padding-bottom: 50px;
    }
    .marca-agua-front {
        display: block;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: 2;
        padding-top: 2px;
        /* padding-left: 15px; */
        padding-left: 45px;
        /* text-align: center; */
        /* padding-left: 10px; */
    }

    /* @page { 
        margin: 120px 50px 35px 50px; 
    } */
</style>

{{-- front card --}}
<div class="border-styled">
    <div class="border-styled-white"></div>
</div>
<div class="marca-agua-front">
    <img src="{{public_path('img/isotipo-marcaagua.png')}}" alt="foto" width="265" height="auto">
</div>
<div class="wrapper-card">
    <table class="table table-light full-width" height="200.31496" border="1">
        <tbody>
            <tr>
                <td colspan="3" class="text-center" style="padding:5px">
                    <strong class="text-uppercase" style="font-size: 8pt">{{$model->nombre_completo}}</strong>
                </td>
            </tr>
            <tr>
                <td class="text-center bg-gray-2" style="width: 150px">
                    <b class="text-purple text-uppercase">
                        {{$model->cargo}}
                    </b>
                </td>
                <td rowspan="7" class="text-center">
                    @if ($model->foto)
                        <img src="{{storage_path('app/public/uploads/'.$model->src_foto)}}" alt="Foto" width="100" height="100" style="border:0.8px solid black">
                    @else
                        <img src="{{public_path('img/img_user_none.png')}}" alt="foto" width="100" height="100" style="border:0.8px solid black">
                    @endif
                </td>
                <td rowspan="8" style="width: 18px;">
                    <div class="aside">
                        {{__('ENFERMERÍA')}}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-end">{{__('Fecha de registro: ')}}</td>
            </tr>
            <tr>
                <td class="text-end bg-gray-1 text-purple"> 
                    <b>
                        {{$model->fecha_registro}} 
                    </b>
                </td>
            </tr>
            <tr>
                <td class="text-end">
                    {{__('Numero de matricula: ')}}
                </td>
            </tr>
            <tr>
                <td class="text-end bg-gray-1 text-purple">
                    <b>
                        {{$model->numero_matricula}}
                    </b>
                </td>
            </tr>
            <tr>
                <td class="text-end">
                    {{__('C.I.: ')}}
                </td>
            </tr>
            <tr>
                <td class="text-end bg-gray-2  text-purple">
                    <b>
                        {{$model->ci}}
                    </b>
                </td>
            </tr>
            <tr>
                <td rowspan="2" class="text-center text-uppercase">
                    <img src="{{public_path('img/isotipo.svg')}}" alt="foto" width="45" height="auto">
                    <br>
                    <b>
                        {{__('A.D.E.A. CBBA')}}
                    </b>
                    <div style="font-size: 4pt; letter-spacing: 0; word-spacing: 0; line-height : 6px; font-stretch: extra-condensed;">
                        {{__('Asociación Departamental de Enfermeras(os)')}} <br>
                        {{__('Auxiliares de Cochabamba')}}
                    </div>
                </td>
                <td class="text-center" style="padding: 0; height: 20px; font-size: 11pt; font-weight: bold; line-height : 7px">
                    {{$model->numero_afiliado}}
                    <br>
                    <span style="font-size: 4pt; font-weight: normal">{{__('Número de afiliado')}}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center" style="padding:5px 2px 0 0;font-size:5pt">
                    {{__('Personeria juridica Nro 204770 - Resolucion Prefectural Nro 135/05')}}
                </td>
            </tr>
        </tbody>
    </table>
</div>

{{-- back card --}}
<div class="wrapper-card p-5">
    <table class="table table-light full-width" height="200.31496" border="1">
        <tbody>
            <tr>
                <td colspan="3">
                    Fecha de vigencia:
                    <b>
                        {{$model->fecha_registro}} - 
                        {{$model->fecha_registro}}
                    </b>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="height: 20px;">
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
                    {{__('Grupo sanguineo: ')}}
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
                <td colspan="2" style="font-size: 5pt">
                    {{__('Asociacion Departamental de Enfermeras(os) Auxiliares ')}} <br>
                    {{__('Teléfono: 4317867 - 4525971')}} <br>
                    {{__('Direccion: C. Colombia entre C. 16 de julio y Av Oquendo Edif. Rochavel Piso 1 Of. 6 ')}}
                </td>
                <td class="text-center">
                    <img src="{{public_path('img/logo-v2.svg')}}" alt="foto" width="70" height="auto">
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="border-styled-back">
</div>
<div class="marca-agua">
    <img src="{{public_path('img/logo-redondo-marcaagua.png')}}" alt="foto" width="120" height="auto">
</div>