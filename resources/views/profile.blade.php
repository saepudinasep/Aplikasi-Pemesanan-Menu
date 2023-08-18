@extends('layouts.mainlayout')

@section('title', 'Profile')

@section('content')

    <h1 class="h3 mb-2 text-gray-800">Profile</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">View Profile</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td>:</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>:</td>
                    <td>{{ $data->role->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>:</td>
                    <td>{{ $data->email }}</td>
                </tr>
                <tr>
                    <th>Handphone</th>
                    <td>:</td>
                    <td>{{ $data->phone }}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection
