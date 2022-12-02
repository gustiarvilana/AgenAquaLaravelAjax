<!DOCTYPE html>
<html>

<head>
    <title>RAM Water | Cetak PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 11pt;
        }
    </style>

    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
        <div class="card">
            <div class="card-header p-4">
                <a class="pt-2 d-inline-block" href="index.html" data-abc="true">
                    <h2>Ram Water</h2>
                </a>
                <div class="float-right">
                    <h3 class="mb-0">Laporan #001</h3>
                    Periode: {{ $laporan['periode'] }}
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        {{-- // --}}
                    </div>
                    <div class="col-sm-6 ">
                        {{-- // --}}
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th width="15%">Tanggal</th>
                                <th>Deskripsi</th>
                                <th class="right" width="20%">Pemasukan</th>
                                <th class="center" width="20%">Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($laporan['header'] as $key => $item)
                                <tr>
                                    <td class="center">{{ $i++ }}</td>
                                    <td class="left">#</td>
                                    <td class="left">{{ substr($key, 2) }}</td>
                                    <td class="right"> {{ substr($key, 0, 1) == 'P' ? $item : '-' }} </td>
                                    <td class="center">{{ substr($key, 0, 1) == 'B' ? $item : '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tr>
                            <th class="center">#</th>
                            <th>Tanggal</th>
                            <th>Deskripsi Pengeluaran</th>
                            <th class="right" width="20%">Pemasukan</th>
                            <th class="center" width="20%">Pengeluaran</th>
                        </tr>

                        @foreach ($laporan['pengeluaran_bulanan'] as $key => $item)
                            <tr>
                                <td class="center">{{ $key + 1 }}</td>
                                <td class="left">{{ $item['tgl_pengeluaran'] }}</td>
                                <td class="left">{{ $item['nama_pengeluaran'] }}</td>
                                <td class="right">
                                    {{ $item['jenis'] == 'P' ? 'Rp. ' . format_uang($item['nominal_pengeluaran']) : '-' }}
                                </td>
                                <td class="center">
                                    {{ $item['jenis'] == 'B' ? 'Rp. ' . format_uang($item['nominal_pengeluaran']) : '-' }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                        {{-- <h5 class="mb-3"></h5>
                        <h3 class="text-dark mb-1">RAM Water</h3>
                        <div>Jl.Merdeka</div>
                        <div>Sikeston,New Delhi 110034</div>
                        <div>Email: contact@bbbootstrap.com</div>
                        <div>Phone: +91 9897 989 989</div> --}}
                    </div>
                    <div class="col-lg-6 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Total Pendapatan</strong>
                                    </td>
                                    <td class="right">{{ 'Rp. ' . format_uang($laporan['total_pendapatan']) }}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Total Pengeluaran</strong>
                                    </td>
                                    <td class="right">{{ 'Rp. ' . format_uang($laporan['total_pengeluaran']) }}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Laba</strong>
                                    </td>
                                    <td class="right">
                                        {{ 'Rp. ' . format_uang($laporan['total_pendapatan'] - $laporan['total_pengeluaran']) }}
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td class="left">
                                        <strong class="text-dark">Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong class="text-dark">$20,744,00</strong>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p class="mb-0">IT for Ram Water, Kota Sukabumi. {{ date('F Y') }}</p>
            </div>
        </div>
    </div>

</body>

</html>
