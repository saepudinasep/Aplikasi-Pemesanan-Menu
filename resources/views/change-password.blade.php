@extends('layouts.mainlayout')

@section('title', 'Change Password')

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

        @if (Session::has('status'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h4 class="card-title font-weight-bold">Change Password</h4>
                <div class="row">
                    <div class="col-12">
                        <form class="form-material" method="POST" action="change-password">
                            @csrf
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" class="form-control" name="old_password">
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="new_password">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="new_password_confirmation">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="/home" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
