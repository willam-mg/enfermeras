@extends('layouts.app')

@section('title', 'Afiliados')

@section('content')
    {{ Breadcrumbs::render('afiliados') }}
    <livewire:afiliado.list-component />
@endsection