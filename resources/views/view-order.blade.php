@extends('layouts.mainlayout')

@section('title', 'View Order')

@section('content')

    <h1 class="h3 mb-2 text-gray-800">View Order</h1>
    {{-- <h1>Ini Halaman Payment</h1> --}}
    {{-- <h2>Selamat datang, {{ Auth::user()->name }}. Anda adalah {{ Auth::user()->role->name }}</h2> --}}

    {{-- <div class="container mt-3">
        <form action="{{ route('payment') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlSelect1">Choose Table</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option value="">-- Choose Table --</option>
                    @foreach ($data as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div> --}}

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">View Order</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive table-container">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Qty</th>
                            <th>Table</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->menu }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <select name="status" id="status" class="form-control status"
                                        data-id="{{ $item->id }}">
                                        <option value="Pending" {{ $item->status == 'Pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="Cooking" {{ $item->status == 'Cooking' ? 'selected' : '' }}>Cooking
                                        </option>
                                        <option value="Deliver" {{ $item->status == 'Deliver' ? 'selected' : '' }}>Deliver
                                        </option>
                                        {{-- @foreach (['Pending', 'Deliver', 'Cooking'] as $status)
                                            <option value="{{ $status }}"
                                                @if ($item->status == $status) selected @endif>
                                                {{ $status }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <script>
        var statusComboboxes = document.querySelectorAll(".status");
        statusComboboxes.forEach(function(statusCombobox) {
            statusCombobox.addEventListener("change", function() {
                var status = statusCombobox.value;
                var id = statusCombobox.getAttribute("data-id");

                // console.log(id);
                // console.log(status);

                // Lakukan perubahan status pada database menggunakan AJAX atau request ke server
                $.ajax({
                    url: "{{ url('/updateOrder') }}", // Ganti dengan URL yang sesuai dengan route Laravel Anda
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}', // Tambahkan CSRF token
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        // Swal.fire(
                        //     'Pesanan Berhasil di ' + status + '!',
                        //     'Silahkan Tunggu!',
                        //     'success'
                        // )
                        // location.reload(); // Refresh halaman

                    },
                    error: function(xhr) {
                        // Aksi jika terjadi error
                        console.log('Error saving all data');
                    }
                });
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $(".status").change(function() {
                var selectedStatus = $(this).val();
                var id = $(this).data("id");

                Swal.fire({
                    title: "Ubah Status Pesanan?",
                    text: "Anda yakin ingin mengubah status pesanan ini?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Ya",
                    cancelButtonText: "Tidak",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ url('/updateOrder') }}",
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id,
                                status: selectedStatus
                            },
                            success: function(response) {
                                Swal.fire("Sukses", "Status berhasil diperbarui.",
                                    "success").then((result) => {
                                    location
                                        .reload(); // Refresh halaman jika "OK" atau "Tidak" diklik
                                });
                            },
                            error: function(error) {
                                Swal.fire("Error", "Gagal memperbarui status.",
                                    "error");
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        location.reload(); // Refresh halaman jika "Tidak" diklik
                    }
                });
            });
        });
    </script>

@endsection
