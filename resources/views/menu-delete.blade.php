@extends('layouts.mainlayout')

@section('title', 'Delete Menu')

@section('content')


<div class="mt-5">
    <h2>Are you sure to delete data : {{ $menu->name }} <img src="{{ $menu->image }}" alt="" srcset=""></h2>
    <form style="display:inline-block;" action="/menu-destroy/{{ $menu->id }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="/menu" class="btn btn-primary">Cancel</a>
</div>


@endsection
