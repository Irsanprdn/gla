@extends('template') <!-- Menggunakan layout app.blade.php -->

@section('title', 'Dashboard')

@section('content')
<section class="row">
    <div class="col-12 col-lg-12">
        <!-- Card untuk Pemasukan -->
        <div class="row">
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon green mb-2">
                                    <i class="iconly-boldAdd-User"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pemasukan</h6>
                                <h6 class="font-extrabold mb-0">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card untuk Pengeluaran -->
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon red mb-2">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pengeluaran</h6>
                                <h6 class="font-extrabold mb-0">Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card untuk Modal Awal -->
            <div class="col-6 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon blue mb-2">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Modal Awal</h6>
                                <h6 class="font-extrabold mb-0">Rp {{ number_format($modalAwal ?? 0, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Pemasukan & Pengeluaran -->
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Pemasukan & Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-pemasukan-pengeluaran"></div> <!-- Chart.js atau library lainnya -->
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Saldo Tersisa</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="font-extrabold mb-0">Rp {{ number_format($saldoTersisa ?? 0, 0, ',', '.') }}</h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Grafik Pembagian Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-pembagian-pengeluaran"></div> <!-- Grafik jenis pie atau donut -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Transaksi -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Transaksi Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jenis Transaksi</th>
                                        <th>Nominal</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if( $transaksiTerbaru ?? '' )
                                    @foreach($transaksiTerbaru as $transaksi)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}</td>
                                        <td>{{ $transaksi->jenis }}</td>
                                        <td>Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}</td>
                                        <td>{{ $transaksi->deskripsi }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
@section('js')
<script src="/assets/static/js/pages/dashboard.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {        
        // Pemasukan & Pengeluaran Bar Chart
        var totalPemasukan = "{{$totalPemasukan}}";
        var totalPengeluaran = "{{$totalPengeluaran}}";
        var biayaOp = "{{$totalPengeluaran }}" * 0.6;
        var biayaLain = "{{$totalPengeluaran }}" * 0.4;
        var optionsPemasukanPengeluaran = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Jumlah (Rp)',
                data: [totalPemasukan, totalPengeluaran] // Your dummy data
            }],
            xaxis: {
                categories: ['Pemasukan', 'Pengeluaran']
            },
            colors: ['#28a745', '#dc3545'],
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return 'Rp ' + value.toLocaleString();
                    }
                }
            },
            title: {
                text: 'Pemasukan & Pengeluaran',
                align: 'center'
            }
        };
        var chartPemasukanPengeluaran = new ApexCharts(document.querySelector("#chart-pemasukan-pengeluaran"), optionsPemasukanPengeluaran);
        chartPemasukanPengeluaran.render();

        // Pembagian Pengeluaran Pie Chart
        var optionsPembagianPengeluaran = {
            chart: {
                type: 'pie',
                height: 350
            },
            series: [biayaOp, biayaLain], // Example expense categories
            labels: ['Biaya Operasional', 'Biaya Lainnya'], // Expense categories
            colors: ['#17a2b8', '#ffc107'],
            title: {
                text: 'Pembagian Pengeluaran',
                align: 'center'
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return 'Rp ' + value.toLocaleString();
                    }
                }
            }
        };
        var chartPembagianPengeluaran = new ApexCharts(document.querySelector("#chart-pembagian-pengeluaran"), optionsPembagianPengeluaran);
        chartPembagianPengeluaran.render();
    });
</script>
@endsection