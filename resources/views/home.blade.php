@extends('layouts.app')

@section('content')
<div class="heading">
    <div class="row">
        <div class="col-sm-6">
            <h3>Dashboard</h3>
        </div>
        <div class="col-sm-6">
            <nav class="navigation-heading" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-xl-3 col-lg-6">
        <div class="card l-bg-cherry">
            <div class="card-statistic-3 p-4">
                <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                <div class="mb-4">
                    <h5 class="card-title mb-0">Produk Terjual</h5>
                </div>
                <div class="row align-items-center mb-2 d-flex">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            <span class="count">{{ App\Http\Controllers\HomeController::produk('terjual') }}</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card l-bg-blue-dark">
            <div class="card-statistic-3 p-4">
                <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                <div class="mb-4">
                    <h5 class="card-title mb-0">Jumlah Pegawai</h5>
                </div>
                <div class="row align-items-center mb-2 d-flex">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            <span class="count">{{ count($user)-1 }}</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card l-bg-green-dark">
            <div class="card-statistic-3 p-4">
                <div class="card-icon card-icon-large"><i class="fas fa-heart"></i></div>
                <div class="mb-4">
                    <h5 class="card-title mb-0">Jumlah Pelanggan</h5>
                </div>
                <div class="row align-items-center mb-2 d-flex">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            <span class="count">{{ count($toko) }}</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card l-bg-orange-dark">
            <div class="card-statistic-3 p-4">
                <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                <div class="mb-4">
                    <h5 class="card-title mb-0">Total Keuntungan</h5>
                </div>
                <div class="row align-items-center mb-2 d-flex">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0">
                            Rp
                            <span>
                                @php
                                    $a = 0;
                                @endphp
                                @if (count($keuntungan) > 0)
                                    @foreach ($keuntungan as $benefits)
                                        @foreach ($kategori as $cat)
                                            @if ($benefits->kategori_id == $cat->id)
                                                @php
                                                    $a = $a + $benefits->total*$cat->keuntungan;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                    {{ $a }}
                                @else
                                    {{ $a }}
                                @endif
                            </span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 chart-row card">
        <div class="heading">
            <div class="row">
                <div class="col">
                    <h5>Grafik Penjualan Tahunan</h5>
                </div>
            </div>
        </div>
        <div>
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="col-sm-5 chart-row card" style="margin-right: 10px; height: 300px;">
        <div class="heading">
            <div class="row">
                <div class="col">
                    <h5>Grafik Keseluruhan Produk</h5>
                </div>
            </div>
        </div>
        <div>
            <div id="pieChart"></div>
        </div>
    </div>
    <div class="col-sm-6 chart-row card">
        <div class="heading">
            <div class="row">
                <div class="col">
                    <h5>Grafik Stok Produk Setiap Pabrik</h5>
                </div>
            </div>
        </div>
        <div>
            <div id="barChart"></div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    @php
        $year = date("Y");
    @endphp
    <script type="text/javascript">
        const labels = [
            'Januari',
            'Febuari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        const data = {
            labels: labels,
            datasets: [{
                label: 'Penjualan tahun {{ $year }}',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [{{ App\Http\Controllers\HomeController::penjualan($year, '01') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '02') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '03') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '04') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '05') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '06') }}, 
                {{ App\Http\Controllers\HomeController::penjualan($year, '07') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '08') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '09') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '10') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '11') }}, {{ App\Http\Controllers\HomeController::penjualan($year, '12') }}],
            }]
        };

        const config = {
            type: 'line',
            data,
            options: {}
        };
        // === include 'setup' then 'config' above ===

        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <script type="text/javascript">
        var options = {
            series: [{{ App\Http\Controllers\HomeController::produk('gudang') }}, {{ App\Http\Controllers\HomeController::produk('dijual') }}, {{ App\Http\Controllers\HomeController::produk('terjual') }}, {{ App\Http\Controllers\HomeController::produk('dikembalikan') }}],
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Di Gudang', 'di Toko', 'Terjual', 'Dikembalikan'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var pieChart = new ApexCharts(document.querySelector("#pieChart"), options);
        pieChart.render();
    </script>
    <script type="text/javascript">
        var options = {
            series: [
                @php
                    $jumlahProduct = count($kategori);
                    $jumlahPabrik = count($pabrik);
                @endphp
                @for ($a = 0; $a < $jumlahProduct; $a++)
                    @if ($a+1 == $jumlahProduct)
                    {
                        name: '{{ $kategori[$a]->nama_kategori }}',
                        data: [
                            @for ($b = 0;$b < $jumlahPabrik; $b++)
                                {{ App\Http\Controllers\HomeController::hitungProdukPabrik(($b+1), $kategori[$a]->id) }},
                            @endfor
                        ]
                    }
                    @else
                    {
                        name: '{{ $kategori[$a]->nama_kategori }}',
                        data: [
                            @for ($b = 0;$b < $jumlahPabrik; $b++)
                                {{ App\Http\Controllers\HomeController::hitungProdukPabrik($b+1, $kategori[$a]->id) }},
                            @endfor
                        ]
                    },
                    @endif
                @endfor
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: [
                    @for ($namaPabrik = 0; $namaPabrik < $jumlahPabrik; $namaPabrik++)
                        '{{ $pabrik[$namaPabrik]->nama_pabrik }}',
                    @endfor
                ],
            },
            yaxis: {
                title: {
                    text: 'Produk'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return ": " + val + " Produk"
                    }
                }
            }
        };

        var barChart = new ApexCharts(document.querySelector("#barChart"), options);
        barChart.render();
    </script>
@endsection