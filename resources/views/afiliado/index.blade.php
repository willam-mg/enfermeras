@extends('layouts.app')

@section('title', 'Afiliados')

@section('content')
    {{ Breadcrumbs::render('afiliados') }}
    <livewire:afiliado.list-component />
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            document.addEventListener('livewire:load', function () {
                Livewire.on('afiliadoAdded', pagoId => {
                    console.log('pago id', pagoId);
                    $("#modal-create .btn-close").click();
                    // window.location.href = 'pagos/recibopdf/'+pagoId;
                    // window.location.replace('pagos/recibopdf/'+pagoId);
                    var win = window.open('pagos/recibopdf/'+pagoId, '_blank');
                    if (win) {
                        //Browser has allowed it to be opened
                        win.focus();
                    } else {
                        //Browser has blocked it
                        alert('Please allow popups for this website');
                    }

                    // goToStep(4);
                })
            });
        });
    </script>
@endsection