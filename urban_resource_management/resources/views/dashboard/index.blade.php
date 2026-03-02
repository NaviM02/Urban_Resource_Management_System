@extends('layouts.app')

@section('content')

    <h2>Dashboard</h2>

    <p>Bienvenido {{ auth()->user()->name }}</p>

@endsection
