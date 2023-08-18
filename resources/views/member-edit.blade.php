@extends('layouts.mainlayout')

@section('title', 'Edit Member')

@section('content')



    <div class="col-12 m-auto">


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Member</h4>
                <div class="row">
                    <div class="col-12">
                        <form class="form-material" method="POST" action="/member/{{ $member->id }}">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $member->name }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $member->email }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="handphone" value="{{ $member->handphone }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <a href="/member" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
