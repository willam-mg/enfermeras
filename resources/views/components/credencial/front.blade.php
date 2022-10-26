<table class="table table-light full-width">
    <tbody>
        <tr>
            <td colspan="3" class="text-center" style="padding:2px">
                <strong class="text-uppercase" style="font-size: 8pt">{{$model->nombre_completo}}</strong>
            </td>
        </tr>
        <tr>
            <td class="text-center bg-gray-2" style="width: 150px">
                <b class="text-purple text-uppercase">
                    {{$model->cargo}}
                </b>
            </td>
            <td rowspan="7" class="text-center foto-container">
                @if ($model->foto)
                    <img src="{{storage_path('app/public/uploads/'.$model->src_foto)}}" alt="Foto" >
                @else
                    <img src="{{public_path('img/img_user_none.png')}}" alt="foto">
                @endif
            </td>
            <td rowspan="7" style="width: 18px;">
                <div class="aside">
                    {{__('ENFERMERÍA')}}
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-end">{{__('Fecha de registro ')}}</td>
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
                {{__('Número de matrícula ')}}
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
                {{__('C.I. ')}}
            </td>
        </tr>
        <tr>
            <td class="text-end bg-gray-2  text-purple">
                <b>
                    {{$model->ci.' '.$model->expedido}}
                </b>
            </td>
        </tr>
        
    </tbody>
</table>

<div class="content-box">
    <table>
        <tbody>
            <tr>
                <td rowspan="2" class="text-center text-uppercase" style="width: 150px">
                    <img src="{{public_path('img/isotipo.svg')}}" alt="foto" width="45" height="auto">
                    <br>
                    <b>
                        {{__('A.D.E.A. CBBA.')}}
                    </b>
                    <div style="font-size: 4pt; letter-spacing: 0; word-spacing: 0; line-height : 6px; font-stretch: extra-condensed;">
                        {{__('Asociación Departamental de Enfermeras(os)')}} <br>
                        {{__('Auxiliares de Cochabamba')}}
                    </div>
                </td>
                <td class="text-center" style="line-height : 6px; height: 10px;">
                    <p style="margin-top:5px; font-size: 11pt; font-weight: bold;">
                        {{$model->numero_afiliado}}
                    </p>
                    <small style="font-size:5pt;">
                        {{__('Número de afiliado ')}}
                    </small>
                </td>
            </tr>
            <tr>
                <td class="text-center" style="padding:5px 2px 0 0;font-size:5pt;">
                    {{__('Personería jurídica Nro 204770 - Resolución Prefectural Nro 135 / 05')}}
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="box-left"></div>
<div class="border-styled">
    <div class="border-styled-white"></div>
</div>
<div class="marca-agua-front">
    <img src="{{public_path('img/isotipo-marcaagua.png')}}" alt="foto" width="255" height="auto">
</div>