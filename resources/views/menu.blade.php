@extends('layouts.mainlayout')

@section('title', 'Menu')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Menu</h1>
    <a href="/menu-add" class="btn btn-primary">
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
            <h6 class="m-0 font-weight-bold text-primary">DataTables Menu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = ($menu->currentPage() - 1) * $menu->perPage() + 1;
                        @endphp
                        @if ($menu->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Data kosong <a href="/menu"
                                        class="btn btn-success"><i class="fas fa-sync-alt"></i></a></td>
                            </tr>
                        @else
                            @foreach ($menu as $data)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td><img src="{{ asset('storage/image/' . $data->image) }}" alt=""
                                            width="200"></td>
                                    <td>
                                        <a href="/menu-edit/{{ $data->id }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger delete-btn-menu" data-id="{{ $data->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <div class="my-3">
                    {{ $menu->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn-menu');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Set CSRF Token
                            const csrfToken = document.head.querySelector(
                                'meta[name="csrf-token"]').content;
                            // Delete user via Fetch API
                            fetch(`/menu/${userId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken
                                    }
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Failed to delete user.');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.status === 'success') {
                                        Swal.fire('Deleted!', data.message, 'success');
                                        // Reload page or update UI as needed
                                        window.location.reload(); // Reload page
                                    } else {
                                        Swal.fire('Error!', 'Failed to delete user.',
                                            'error');
                                    }
                                })
                                .catch(error => {
                                    Swal.fire('Error!', error.message, 'error');
                                });
                        }
                    });
                });
            });
        });
    </script>

@endsection
