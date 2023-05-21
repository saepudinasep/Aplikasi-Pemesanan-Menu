@extends('layouts.mainlayout')

@section('title', 'Employee')

@section('content')


<div class="mt-5">
    <h2>Are you sure to delete data : {{ $user->name }}, email : {{ $user->email }}</h2>
    <form style="display:inline-block;" action="/employee-destroy/{{ $user->id }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="/employee" class="btn btn-primary">Cancel</a>
</div>


@endsection
