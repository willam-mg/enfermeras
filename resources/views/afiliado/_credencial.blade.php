
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
        background: #2ae585;
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
        color: #006691;
    }
    .p-5 {
        padding: 10px;
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
        
        width: 321.25984266666666px;
        /* height: 200.31496px; */
        background-position: center;
        /* background-color: rgb(1, 2, 1, 0.3); */
        /* border: 1px solid black; */
        z-index: 2;
        /* padding-top: 75px; */
        text-align: center;
        padding-bottom: 70px;
    }

    /* @page { 
        margin: 120px 50px 35px 50px; 
    } */
</style>

{{-- front card --}}
<div class="border-styled">
    <div class="border-styled-white"></div>
</div>
<div class="wrapper-card">
    <table class="table table-light full-width" height="200.31496" border="1">
        <tbody>
            <tr>
                <td colspan="3" class="text-center" style="padding:5px">
                    <strong class="text-uppercase">{{$model->nombre_completo}}</strong>
                </td>
            </tr>
            <tr>
                <td class="text-center bg-gray-2" style="width: 150px">
                    <b class="text-purple">
                        {{$model->cargo}}
                    </b>
                </td>
                <td rowspan="7" class="text-center">
                    @if ($model->foto)
                        <img src="{{public_path('uploads/thumbnail/'.$model->src_foto)}}" class="" alt="foto" width="100" height="100">
                    @else
                        <img src="{{public_path('img/img_user_none.png')}}" alt="foto" width="110" height="110">
                    @endif
                </td>
                <td rowspan="8" style="width: 18px">
                    <div class="aside">
                        {{__('ENFERMERÍA')}}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-end">C.I.:</td>
            </tr>
            <tr>
                <td class="text-end bg-gray-1 text-purple"> 
                    {{$model->ci}} 
                </td>
            </tr>
            <tr>
                <td class="text-end">
                    {{__('Numero de matricula: ')}}
                </td>
            </tr>
            <tr>
                <td class="text-end bg-gray-1 text-purple">
                    {{$model->numero_matricula}}
                </td>
            </tr>
            <tr>
                <td class="text-end">
                    {{__('Numero de afiliado: ')}}
                </td>
            </tr>
            <tr>
                <td class="text-end bg-gray-2  text-purple">
                    {{$model->numero_afiliado}}
                </td>
            </tr>
            <tr>
                <td rowspan="2" class="text-center text-white">
                    <img src="{{public_path('img/logo-landscape.png')}}" alt="foto" width="70" height="auto">
                    <p style="font-size: 5pt">
                        {{__('Asociacion Departamental de Enfermeras(os) Auxiliares A.D.E.A. - Cochabamba')}}
                    </p>
                </td>
                <td class="text-center" style="height: 25px; padding-left: 24px">
                    <?=DNS1D::getBarcodeHTML($model->ci, 'EAN13',1,20)?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center text-white" style="padding:13px 2px 0 0;font-size:5pt">
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
                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,
                </td>
            </tr>
            <tr>
                <td rowspan="2" style="padding: 10px 0 10px 25px ">
                    <?=DNS2D::getBarcodeHTML($model->numero_afiliado, 'QRCODE', 3, 3)?>
                    
                </td>
                <td colspan="2" rowspan="2">
                    <p>
                        {{__('En caso de extravio de esta identificacion llamar al: ')}}
                    </p>
                    {{__('45645655 - 5675767 Asociacion Departamental de Enfermeras(os) Auxiliares')}}
                </td>
            </tr>
            <tr>
                <td>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    {{__('Asociacion Departamental de Enfermeras(os) Auxiliares Tlf: 45645655 - 5675767 Direccion: av quillas nro23')}}
                </td>
                <td>
                    <img src="{{public_path('img/logo-landscape.png')}}" alt="foto" width="70" height="auto">
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="border-styled-back">
</div>
<div class="marca-agua">
    <img src="{{public_path('img/logo-marca-agua.png')}}" alt="foto" width="100" height="auto">
</div>