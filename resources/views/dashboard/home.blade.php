@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row">
        {{-- card kiri --}}
        <div class="col-lg-">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        {{-- <p class="d-flex flex-column">
                            <span class="text-bold text-lg">820</span>
                            <span>Visitors Over Time</span>
                        </p> --}}
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                                <a href="#" onclick="show()">Cetak Laporan Bulanan</a>
                            </span>
                        </p>
                    </div>

                    <div class="position-relative mb-4">
                        <canvas id="mixed-chart" width="600" height="350"></canvas>
                    </div>

                    {{-- <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> This Week
                        </span>

                        <span>
                            <i class="fas fa-square text-gray"></i> Last Week
                        </span>
                    </div> --}}
                </div>
            </div>
        </div>
        {{-- card kanan --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"> <i class="fas fa-truck-loading"></i> </i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pembelian bulan ini</span>
                            <span class="info-box-number" id="txt_new_pembelian"></span>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"> <i class="fas fa-money-bill-wave"></i> </i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pendapatan bulan ini</span>
                            <span class="info-box-number" id="txt_new_pendapatan"></span>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> </i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pengeluaran bulan ini</span>
                            <span class="info-box-number" id="txt_new_pengeluaran"></span>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"> <i class="fa fa-users" aria-hidden="true"></i> </i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pelanggan bulan ini</span>
                            <span class="info-box-number" id="txt_new_pelanggan"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.form')
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets') }}/plugins/chart.js/Chart.min.js"></script>
    <script src="{{ asset('assets') }}/dist/js/pages/dashboard3.js"></script>

    <script>
        $(document).ready(function() {
            // setTimeout(function() {
            //     location.reload();
            // }, 10000);

            var URL = '{{ route('dashboard.get_penjualan') }}'
            $.get(URL, function(data) {
                var ctx = document.getElementById('mixed-chart'); // node
                var ctx = document.getElementById('mixed-chart').getContext('2d'); // 2d context
                var ctx = $("#mixed-chart");
                var ctx = 'mixed-chart'; // element id

                var data = {
                    labels: data.Penjualan_label,
                    datasets: [{
                        label: "Europe",
                        type: "line",
                        borderColor: "#8e5ea2",
                        data: data.Penjualan_nominal,
                        fill: false
                    }, {
                        label: "Europe",
                        type: "bar",
                        backgroundColor: "rgba(0,0,0,0.2)",
                        data: data.Penjualan_nominal,
                    }]
                };
                var options = {
                    title: {
                        display: true,
                        position: "top",
                        text: 'Penjualan Galon tahun 2022',
                        fontSize: 18,
                        fontColor: "#111"
                    },
                    legend: {
                        display: false,
                        position: "bottom",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    }
                };
                //create Pie Chart class object
                var chart1 = new Chart(ctx, {
                    type: "bar",
                    data: data,
                    options: options
                });
            });

            data_card_kanan();
        });

        function data_card_kanan() {
            //format rupiah
            const formatRupiah = (money) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(money);
            }
            var url = '{{ route('dashboard.get_penjualan') }}'
            $.get(url)
                .done((response) => {
                    // card kanan
                    $('#txt_new_pembelian').text(formatRupiah(response.pembelian_bulan_ini))
                    $('#txt_new_pendapatan').text(formatRupiah(response.pendapatan_bulan_ini))
                    $('#txt_new_pengeluaran').text(formatRupiah(response.pengeluaran_bulan_ini))
                    $('#txt_new_pelanggan').text(response.pelanggan_bulan_ini + ' Pelanggan')
                })
                .fail((errors) => {
                    alert('Gagal menampilkan data card kanan!')
                })
        };

        function show() {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Buat Laporan');

            // $('#modal-form form')[0].reset();
            // $('#modal-form form').attr('action', url);
            // $('#modal-form [name=_method]').val('post');
        }
    </script>
@endpush
