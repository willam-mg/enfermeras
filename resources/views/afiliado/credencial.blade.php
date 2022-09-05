<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>

  <body>

    <style>
    .page-break {
        page-break-after: always;
    }
    td{
        font-size: 11px;
    }
    *{
        padding: 0;
        margin:0;
    }
    body{
        padding:5px;
    }
    .text-cetner{
        text-align: center !important;
    }
    .full-width {
        width: 100%;
    }
    td {
        text-align: center;
    }
    .text-uppercase {
        text-transform: uppercase;
    }
    .mt-5 {
        margin-top: 10px;
    }
    .mt-10 {
        margin-top: 20px;
    }
    .pt-5 {
        padding-top: 10px;
    }
    .mb-5 {
        margin-bottom: 10px;
    }
    .img-profile {
        border-radius: 50%;
    }

    </style>

    <table class="table full-width mt-10">
      <tbody>
        <tr>
            <td colspan="3">
                <img src="{{public_path('img/logo.png')}}" alt="foto" width="100" height="auto">
            </td>
        </tr>
        <tr>
            <td colspan="3">
                @if ($model->foto)
                    <img src="{{public_path('uploads/thumbnail/'.$model->src_foto)}}" class="img-profile" alt="foto" width="110" height="110">
                @else
                    <img src="{{public_path('img/img_user_none.png')}}" alt="foto" width="110" height="110">
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-center pt-5">
                <b class="text-center text-uppercase pt-5">
                    {{$model->nombre_completo}}
                </b> <br>
                <small>
                    {{$model->cargo}}
                </small>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-center pt-5">
                {{__("N° afiliado: ")}} {{$model->numero_afiliado}}
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-center">
                {{__("CI: ")}} {{$model->ci}}
            </td>
        </tr>
      </tbody>
    </table>

    <div class=""></div>

    {{-- back credential --}}
    <table class="table full-width mt-10">
      <tbody>
        <tr>
            <td colspan="3">
                <img src="{{public_path('img/qr.png')}}" alt="foto" width="120" height="auto">
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-center pt-5">
                <b class="text-center text-uppercase pt-5">
                    Expira: 04/03/2026
                </b> 
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-center pt-5">
                Telefono: 4564564
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-center">
                salud@salud.com
            </td>
        </tr>
      </tbody>
    </table>

  </body>
</html>