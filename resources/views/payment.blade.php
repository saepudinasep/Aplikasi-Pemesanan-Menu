@extends('layouts.mainlayout')

@section('title', 'Payment')

@section('content')

    <h1 class="h3 mb-2 text-gray-800">Form Payment</h1>
    {{-- <h1>Ini Halaman Payment</h1> --}}
    {{-- <h2>Selamat datang, {{ Auth::user()->name }}. Anda adalah {{ Auth::user()->role->name }}</h2> --}}

    <div class="container mt-3">
        <form action="{{ route('payment') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="selectTabel">Choose Table</label>
                <select class="form-control" id="selectTabel">
                    <option value="">-- Choose Table --</option>
                    @foreach ($data as $item)
                        <option value="{{ $item->max_id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive table-container">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>SubTotal</th>
                        </tr>
                    </thead>
                    <tbody id="table_order">
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <h6 class="m-0 font-weight-bold">Total : <span id="total"></span></h6>
            </div>
        </div>
    </div>

    <div class="card shadow mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form class="form-material" action="" id="paymentForm">
                        @csrf
                        <div class="form-group">
                            <label>Total</label>
                            <input type="number" class="form-control" name="total1" id="total1" min="0"
                                placeholder="0" disabled>
                        </div>
                        <div class="form-group">
                            <label>Uang</label>
                            <input type="number" class="form-control" name="uang" id="uang" min="0"
                                placeholder="0">
                        </div>
                        <div class="form-group">
                            <label>Kembalian</label>
                            <input type="number" class="form-control" name="kembalian" id="kembalian" min="0"
                                placeholder="0">
                            <p id="changeText"></p>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="bayar">Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#selectTabel').change(() => {
                let id = $("#selectTabel").val();
                // console.log('Table id :' + id);

                $.ajax({
                    url: "{{ url('show-payment') }}/" + id,
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $('#table_order').html(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            })
        });


        // transaksi
        const total1Input = document.getElementById('total1');
        const uangInput = document.getElementById('uang');
        const changeText = document.getElementById('changeText');
        const bayar = document.getElementById('bayar');

        total1Input.addEventListener('input', calculateChange);
        uangInput.addEventListener('input', calculateChange);

        function calculateChange() {
            const total1 = parseFloat(total1Input.value);
            const uang = parseFloat(uangInput.value);

            if (isNaN(total1) || isNaN(uang)) {
                changeText.textContent = "";
                $("#kembalian").val("");
                return;
            }

            if (uang < total1) {
                changeText.textContent = "Uang yang dibayarkan kurang dari total pembayaran.";
            } else {
                const change = uang - total1;
                $("#kembalian").val(change);
            }

        }


        // button transaksi
        bayar.addEventListener('click', performTransaction);

        function performTransaction() {
            const total1 = parseFloat(total1Input.value);
            const uang = parseFloat(uangInput.value);

            if (isNaN(total1) || isNaN(uang)) {
                // swal("Pembayaran Kurang", "Jumlah uang yang dibayarkan kurang dari total pembayaran.", "error");
                return;
            }

            if (uang < total1) {
                // Menggunakan SweetAlert untuk memberikan informasi jika uang pembayaran kurang
                Swal.fire("Pembayaran Kurang", "Jumlah uang yang dibayarkan kurang dari total pembayaran.", "error");
            } else {
                // Mengambil CSRF token dari meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                let id = $("#selectTabel").val();
                // Kirim data transaksi ke backend menggunakan Fetch API
                $.ajax({
                    type: 'POST',
                    url: "{{ url('store') }}",
                    data: {
                        _token: csrfToken, // Tambahkan CSRF token
                        id: id,
                        total1: total1,
                        uang: uang
                    },
                    success: function(data) {
                        // console.log(response);
                        // Tampilkan respons dari backend menggunakan SweetAlert
                        Swal.fire("Transaksi Berhasil", data.message, "success").then(() => {
                            // Reload halaman setelah menekan tombol "OK" pada SweetAlert
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }
    </script>

@endsection
