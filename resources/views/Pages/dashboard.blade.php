@extends('layouts.mainLayouts', ['page' => 'Dashboard'])

@section('cssLinks')
<link rel="stylesheet" href="{{ asset('assets/main/css/style.css') }}">
@endsection

@section('body')
@session('success')
<x-alert type="success" message="{{ session('success') }}" />
@endsession
<div class="container">
    HEllo OWredfb
</div>
@endsection
