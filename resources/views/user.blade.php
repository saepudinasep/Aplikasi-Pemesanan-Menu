@extends('layouts.mainlayout')

@section('title', 'Employee')

@section('content')

{{-- {{ dd($user) }} --}}

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Employee</h1>
    <a href="/employee-add" class="btn btn-primary mb-4">
        <i class="fas fa-plus-circle"></i>
        Add Data
    </a>

    <div class="d-flex justify-content-end">
        <form action="" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="keyword" placeholder="Search....">
                <div class="input-group-append">
                    <button class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>


    @if (Session::has('status'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('message') }}
    </div>
    @endif


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Employee</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Handphone</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->role->name }}</td>
                                <td>
                                    @if ($data->id == Auth::user()->id || $data->role_id == Auth::user()->role_id)
                                        -

                                    @else
                                    <a href="/employee-edit/{{ $data->id }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/employee-delete/{{ $data->id }}" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="my-3">
                    {{ $user->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
