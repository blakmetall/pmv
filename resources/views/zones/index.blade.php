@extends('layouts.horizontal-master')
@section('page-css')

@endsection
@section('main-content')

<div class="row">
    <h1> Listado de Zonas </h1>
</div>

<div class="row">
    <a href="{{ route('zones-create') }}" style="padding: 20px; background: lightblue; border-radius: 10px; margin-top: 50px;" > Create New Zones</a>
</div>

@endsection

@section('page-js')

@endsection


