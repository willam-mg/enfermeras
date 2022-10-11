@extends('layouts.app')

@section('title', 'Afiliados')

@section('content')
    {{ Breadcrumbs::render('afiliados') }}
    <livewire:afiliado.list-component />
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            document.addEventListener('livewire:load', function () {
                Livewire.on('afiliadoAdded', postId => {
                    $("#modal-create .btn-close").click()
                })
            });
        });
    </script>
@endsection