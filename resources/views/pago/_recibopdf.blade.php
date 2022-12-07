@extends('layouts.print')

@section('title', 'Recibo')

@section('content')
    @push('styles')
        <style>
            * {
                margin: 0;
            }
        
            .wrapper-print {
                /* width: 210mm; */
                width: 215.9mm;
                /* height: 420.94488pt; */
                /* height: 148.5mm; */
                height: 139.7mm;
                margin: 0;
                padding: 5mm;
                position: absolute;
        
                background-image: url( {{ asset('images/isotipo-marcaagua.png')}} );
                /* background-image: url( {{ public_path('images/isotipo-marcaagua.png') }} ); */
                background-size:100%;
                background-repeat: repeat-x;
            }
        
            table {
                /* width: 100%; */
                width: 200mm;
                /* height: 100%; */
                height: 138.5mm;
                /* height: 420.94488pt; */
            }
        
            td {
                padding: 2mm;
            }
        
            .full-width {
                width: 100%;
            }
        
            .text-center {
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
                /* background-image: url( {{ asset('images/isotipo-marcaagua.png') }} ); */
                /* background-image: url( {{ public_path('images/isotipo-marcaagua.png') }} ); */
                /* background-size:100%;
                    background-repeat: repeat-x; */
                /* background-position: left; */
            }
        </style>
    @endpush


    <div class="wrapper-print">
        <table class="table table-light">
            <tbody>
                <tr>
                    <td class="text-center" style="width:50mm;">
                        {{-- <img src="{{public_path('images/logo-landscape.png')}}" alt="foto" width="150" height="auto"> --}}
                        <img src="{{asset('images/logo-landscape.png')}}" alt="foto" width="150" height="auto">
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
                        {{$model->detalle[0]->aporte->afiliado->nombre_completo}}
                    </td>
                </tr>
                <tr>
                    <td>La suma de: </td>
                    <td colspan="3" style="font-weight: bold;">
                        {{$model->total}}
                    </td>
                </tr>
                <tr>
                    <td>Por concepto de : </td>
                    <td colspan="3" style="font-weight: bold;">
                        @if ($model->pagoMatricula)
                            Pago matricula por: {{$model->pagoMatricula->monto}} Bs. <br>
                        @endif
                        @if (count($model->detalle) > 0)
                            Por pago de aportes:
                            @foreach ($model->detalle as $item)
                                {{$item->aporte->mes}}  
                                {{$item->aporte->gestion}}, 
                            @endforeach
                        @endif 
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
    {{-- @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                console.log('DOM fully loaded and parsed');
                w.print();
                w.close();
            });
        </script>
    @endpush --}}
@endsection