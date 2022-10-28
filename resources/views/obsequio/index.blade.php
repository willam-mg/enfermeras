@extends('layouts.app')

@section('title', 'Obsequios')

@section('content')
{{ Breadcrumbs::render('obsequios') }}
<livewire:obsequio.index />
@endsection