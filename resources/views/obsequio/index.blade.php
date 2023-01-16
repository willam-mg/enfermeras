@extends('layouts.main')

@section('title', 'Obsequios')

@section('content')
@section('breadcrumbs', Breadcrumbs::render('obsequios') )
<livewire:obsequio.index />
@endsection