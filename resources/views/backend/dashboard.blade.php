@extends('backend/template/app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li> --}}
                            {{-- <li class="breadcrumb-item"><a href="#">Layout</a></li> --}}
                            {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Total vs Penjualan by SKU</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="totalPenjualanVsTargetChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-7">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Total Penjualan by SKU</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="totalPenjualanChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

    </div>
    <script src="{{ asset('backend/js/Chart.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var ctx = $('#totalPenjualanVsTargetChart')[0].getContext('2d');
            var data = @json($totalvsTarget);

            var labels = data.map(function(item) {
                return item.sku_keterangan;
            });

            var totalPenjualan = data.map(function(item) {
                return item.total_penjualan;
            });

            var targetPenjualan = data.map(function(item) {
                return item.target_penjualan;
            });

            var chart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Penjualan',
                        data: totalPenjualan,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Target Penjualan',
                        data: targetPenjualan,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Extract data from PHP array passed from controller
            const labels = {!! json_encode($totalbySku->pluck('nama_sku')) !!};
            const values = {!! json_encode($totalbySku->pluck('total_penjualan')) !!};

            // Render Chart
            const ctx = document.getElementById('totalPenjualanChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Penjualan by SKU',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)', // Adjust color as needed
                        borderColor: 'rgba(54, 162, 235, 1)', // Adjust color as needed
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

        });
    </script>
@endsection
