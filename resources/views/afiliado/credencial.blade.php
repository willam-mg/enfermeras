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
        font-size: 10px;
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
    </style>

    <table class="table page-break full-width" border="1">
      <tbody>
        <tr>
            <td colspan="3">
                
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-center">
                <b class="text-center">
                    {{$model->nombre_completo}}
                </b>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                ID: {{$model->id}}
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>
                CI: {{$model->ci}}
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>
                Telefono: {{$model->telefono}}
            </td>
            <td></td>
        </tr>
      </tbody>
    </table>
  </body>
</html>