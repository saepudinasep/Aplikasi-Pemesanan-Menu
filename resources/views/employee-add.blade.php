@extends('layouts.mainlayout')

@section('title', 'Add Employee')

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
                <h4 class="card-title">Add Employee</h4>
                <div class="row">
                    <div class="col-12">
                        <form class="form-material" method="POST" action="employee">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <select class="form-control" name="role_id">
                                    <option value="">Select Position</option>
                                    @foreach ($role as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="/employee" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
