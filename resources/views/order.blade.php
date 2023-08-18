@extends('layouts.mainlayout')

@section('title', 'Order')

@section('content')


    <h1 class="h3 mb-2 text-gray-800">Form Order</h1>


    @if (Session::has('status'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif


    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Menu List</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-container">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menu as $item)
                                    <tr style="cursor:pointer;">
                                        <td>{{ $loop->iteration }}</td>
                                        <td hidden>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('table tr').click(function() {
                    var rowData = $(this).children('td').map(function() {
                        return $(this).text();
                    }).get();

                    document.getElementById('add').disabled = false;

                    // Menampilkan data dari tabel ke input teks
                    $('#no').val(rowData[0]);
                    $('#id').val(rowData[1]);
                    $('#name').val(rowData[2]);
                    $('#price').val(rowData[3]);

                    var id = rowData[1];
                    $.get("{{ url('show') }}/" + id, {}, function(data, status) {
                        $("#page").html(data);
                    });
                });

            });

            let data = []; // Untuk menyimpan data sementara

            function addRow() {
                // Mendapatkan nilai input teks
                var id = document.getElementById('id').value;
                var name = document.getElementById('name').value;
                var qty = parseInt(document.getElementById('qty').value);
                var price = document.getElementById('price').value;
                var jmlh = 0;

                // Tambahkan data ke array sementara
                data.push([id, name]);
                // data.push(name);

                // Mendapatkan tabel
                var table = document.getElementById('Order');
                var rows = table.getElementsByTagName("tbody");

                for (var i = 1; i < rows.length; i++) {
                    var row = rows[i];
                    var nama = row.cells[0].innerHTML;
                    var qty1 = parseInt(row.cells[1].innerHTML);

                    if (nama === name) {
                        row.cells[1].innerHTML = qty + qty1;
                        jmlh = (qty + qty1) * price;
                        row.cells[3].innerHTML = jmlh;
                        updateTotalHarga();
                        return;
                    }

                }

                // Menambahkan baris baru ke tabel
                var row = table.insertRow(table.rows.length);
                // Menambahkan sel baru ke baris
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);

                jmlh = qty * price;

                // Buat elemen td tersembunyi
                // var hiddenElement = document.createElement("input");
                // var cellHidden = row.insertCell(2);
                // cell5.appendChild(cell5);
                cell5.hidden = true;
                cell5.innerHTML = id;

                // Menambahkan nilai input teks ke dalam sel baru
                cell1.innerHTML = name;
                cell2.innerHTML = qty;
                cell3.innerHTML = price;
                cell4.innerHTML = jmlh;
                cell6.innerHTML = '<button onclick="hapusBaris(this)" class="btn btn-danger">Cancel</button>';

                updateTotalHarga();


                document.getElementById('add').disabled = true;
                document.getElementById('id').value = "";
                document.getElementById('name').value = "";
                document.getElementById('qty').value = "";
                document.getElementById('price').value = "";
                document.getElementById('img').remove();
            }


            function hapusBaris(button) {
                var baris = button.parentNode.parentNode;
                var tabel = baris.parentNode;
                tabel.removeChild(baris);

                updateTotalHarga();
            }

            function updateTotalHarga() {
                var table = document.getElementById("Table-Order");
                var rows = table.getElementsByTagName("tr");
                var totalHarga = 0;

                for (var i = 1; i < rows.length; i++) {
                    var harga = parseInt(rows[i].cells[3].innerHTML);
                    if (!isNaN(harga)) {
                        totalHarga += harga;
                    }
                }

                document.getElementById("totalHarga").innerHTML = totalHarga;
            }
        </script>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">View Menu</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div id="page"></div>
                        </div>
                        <div class="col-8">
                            <form action="" id="form-data">
                                <div class="form-group">
                                    <input type="text" id="id" hidden>
                                    <input type="text" id="id_table" hidden value="{{ $data->id }}">
                                    <label>Menu Name</label>
                                    <input type="text" class="form-control" name="name" id="name" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input type="number" class="form-control" name="qty" id="qty">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" name="price" id="price" readonly>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" onclick="addRow()" disabled
                                        id="add">Add</button>
                                    {{-- <button type="submit" class="btn btn-primary" disabled id="add">Add</button> --}}
                                    {{-- <button type="button" class="btn btn-danger" disabled id="delete">Delete</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Now Order</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-container">
                        <!-- Tambahkan meta tag untuk CSRF token -->
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="Table-Order">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="Order">
                            </tbody>
                        </table>
                    </div>

                    <button class="btn btn-primary" onclick="saveData()">Order</button>
                    <div class="d-flex justify-content-end">
                        <h6 class="m-0 font-weight-bold">Total : <span id="totalHarga"></span></h6>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // simpan dengan js
            function saveData() {

                // Mengambil CSRF token dari meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var data = [];

                $('#Table-Order tr').each(function(index, row) {
                    if (index !== 0) {
                        var menu = $(row).find('td:eq(0)').text();
                        var qty = $(row).find('td:eq(1)').text();
                        var price = $(row).find('td:eq(2)').text();
                        var id = $(row).find('td:eq(4)').text();
                        data.push({
                            menu: menu,
                            qty: qty,
                            price: price,
                            table_id: "{{ $data->id }}",
                            menu_id: id
                        });
                    }
                });
                // console.log(data);

                $.ajax({
                    url: "{{ url('/pesan') }}", // Ganti dengan URL yang sesuai dengan route Laravel Anda
                    type: "POST",
                    data: {
                        _token: csrfToken, // Tambahkan CSRF token
                        data: data
                    },
                    success: function(response) {
                        Swal.fire(
                            'Pesanan Berhasil!',
                            'Silahkan Tunggu!',
                            'success'
                        )
                        read();
                        var table = document.getElementById("Table-Order").getElementsByTagName('tbody')[0];
                        table.innerHTML = ""; // Menghapus semua isi tbody
                        document.getElementById("totalHarga").innerHTML = "";
                        // Aksi setelah sukses menyimpan data
                        // console.log('All data saved successfully');
                    },
                    error: function(xhr) {
                        // Aksi jika terjadi error
                        console.log('Error saving all data');
                        console.log('Server Error:', xhr.responseText);
                    }
                });
            }
        </script>



        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List Order</h6>
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
                                    <th>Status</th>
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
        </div>
    </div>


    <script>
        $(document).ready(function name(params) {
            read();
        });
        // Read Database
        function read() {
            // $.get("{{ url('read') }}", {}, function(data, status) {
            //     $("#table_order").html(data);
            //     console.log(status);
            // });

            var user_id = 1; // Ganti dengan user_id yang sesuai
            var table_id = 2; // Ganti dengan table_id yang sesuai

            $.ajax({
                url: "{{ url('read') }}",
                type: "GET",
                data: {
                    user_id: user_id,
                    table_id: table_id
                },
                success: function(response) {
                    $('#table_order').html(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });

            // function updatetotal() {
            // }
        }
    </script>


@endsection
