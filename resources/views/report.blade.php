@extends('layouts.mainlayout')

@section('title', 'Report')

@section('content')

    <h1 class="h3 mb-2 text-gray-800">Form Report</h1>


    <div class="card shadow mb-4">
        <div class="card-header">
            <form id="reportForm">
                @csrf
                <div class="form-group">
                    <label>From : </label>
                    <input type="date" class="form-control" name="fromDate" id="fromDate" required>
                </div>
                <div class="form-group">
                    <label>To : </label>
                    <input type="date" class="form-control" name="toDate" id="toDate" required>
                </div>
                <button type="submit" class="btn btn-success">Generate</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive table-container">
                <!-- Tambahkan meta tag untuk CSRF token -->
                {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
                <table class="table table-bordered" width="100%" cellspacing="0" id="Table-Order">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Income</th>
                        </tr>
                    </thead>
                    <tbody id="reportData">
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <h2 class="m-auto">Report Chart</h2>
        <canvas id="reportChart"></canvas> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header m-auto">
            <h6 class="font-weight-bold text-primary">Report Chart</h6>
        </div>
        <div class="card-body">
            <canvas id="reportChart"></canvas>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#reportForm').submit(function(event) {
                event.preventDefault();
                generateReport();
            });

            function formatDate(dateString) {
                const date = new Date(dateString);
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }


            function generateReport() {
                const fromDate = $('#fromDate').val();
                const toDate = $('#toDate').val();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: "POST",
                    url: "{{ url('/generate-report') }}",
                    data: {
                        _token: csrfToken,
                        fromDate: fromDate,
                        toDate: toDate
                    },
                    success: function(data) {
                        // console.log(data);
                        // Update table
                        const reportDataElement = $('#reportData');
                        reportDataElement.empty();
                        $.each(data, function(index, item) {
                            const formattedDate = formatDate(item.updated_date);
                            const row = `
                        <tr>
                            <td>${index+1}</td>
                            <td>${formattedDate}</td>
                            <td>${item.total}</td>
                        </tr>
                    `;
                            reportDataElement.append(row);
                        });

                        // Update chart
                        const reportChart = new Chart(document.getElementById("reportChart"), {
                            type: "line",
                            data: {
                                labels: data.map(item => formatDate(item.updated_date)),
                                datasets: [{
                                    label: "Report Data",
                                    data: data.map(item => item.total),
                                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                                    borderColor: "rgba(75, 192, 192, 1)",
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

        });
    </script>

@endsection
