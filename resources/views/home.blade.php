@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('content')


    @if (Session::has('status'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <h1>Ini Halaman Home</h1>
    <h2>Selamat datang, {{ Auth::user()->name }}. Anda adalah {{ Auth::user()->role->name }}</h2>

@endsection
