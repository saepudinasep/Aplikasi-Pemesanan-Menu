@extends('layouts.mainlayout')

@section('title', 'Delete Member')

@section('content')


<div class="mt-5">
    <h2>Are you sure to delete data : {{ $member->name }}</h2>
    <form style="display:inline-block;" action="/member-destroy/{{ $member->id }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="/member" class="btn btn-primary">Cancel</a>
</div>


@endsection
