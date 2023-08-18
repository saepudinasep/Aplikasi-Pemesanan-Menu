@extends('layouts.mainlayout')

@section('title', 'Member')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Member</h1>
    <a href="/member-add" class="btn btn-primary">
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
            <h6 class="m-0 font-weight-bold text-primary">DataTables Member</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Handphone</th>
                            <th>Join Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->handphone }}</td>
                                <td>{{ $item->joinDate }}</td>
                                <td>
                                    <a href="/member-edit/{{ $item->id }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/member-delete/{{ $item->id }}" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <div class="my-3">
                    {{ $data->withQueryString()->links() }}
                </div>

            </div>
        </div>
    </div>








@endsection
