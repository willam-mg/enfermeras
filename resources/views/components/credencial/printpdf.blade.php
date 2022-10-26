
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
        width: 84.9322916667mm;
        height: 53.9322916667mm;
        position: relative;
        z-index: 3;
        background: white;
    }
    .wrapper-card-top {
        position: absolute;
        top: 10.6mm;
        left: 32.2mm;
    }
    .wrapper-card-bottom {
        position: absolute;
        top: 71.3322916667mm;
        left: 32.2mm;
    }
    .wrapper-card  table {
        z-index: 3;
    }
    .aside{
        position: absolute;
        top: 70px;
        right: -64px;
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
        color: #015980;
    }
    .space-top {
        margin-top: 5.8mm;
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
        left: 0;
        width: 100%;
        height: 60px;
        background-color: #0abde3;
        z-index: 0;
    }
    .marca-agua {
        display: block;
        position: absolute;
        bottom: 0;
        width: 100%;
        z-index: 2;
        padding-left: 150px;
        padding-bottom: 62px;
    }
    .marca-agua-front {
        display: block;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: 0;
        padding-top: 2px;
        padding-left: 45px;
    }
    .foto-container {
        height: 28.5mm; 
    }
    .foto-container img {
        position: absolute;
        top: 8mm;
        right: 9mm;
        width: 30mm;
        height: 30mm;
        border:0.8px solid black;
        margin: 0 auto;
    }


    /* content blue color bottom */
    .box-left {
        position: absolute;
        width:151px;
        height:60px;
        bottom: 10px;
        left: 0;
        background-color:  #0abde3;
        z-index: 1;
    }
    .content-box {
        width: 84.9322916667mm;
        height: 60px;
        position: absolute;
        bottom: 0;
        z-index: 3;
    }
</style>

{{-- front card --}}

<div class="wrapper-card wrapper-card-top">
    @if($side == 'front')
        <x-credencial.front :model="$model"/>
        {{-- @include('afiliado.credencial._front') --}}
    @else
        <x-credencial.back :model="$model" :fechaInicio="$fechaInicio" :fechaFin="$fechaFin"/>
        {{-- @include('afiliado.credencial._back') --}}
    @endif
</div>

{{-- back card --}}
<div class="wrapper-card wrapper-card-bottom">
    {{-- @include('afiliado.credencial._front') --}}
    {{-- @include('afiliado.credencial._back') --}}
</div>