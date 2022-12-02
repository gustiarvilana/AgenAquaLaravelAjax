@extends('layouts.master')

@section('title')
    Transaksi Penjualan
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if (Session::has('success_message'))
                    <div class="alert alert-success">
                        {{ Session::get('success_message') }}
                    </div>
                @endif
                @if (Session::has('error_message'))
                    <div class="alert alert-error">
                        {{ Session::get('error_message') }}
                    </div>
                @endif
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <div class="input-group">
                                <label for="">Pilih Produk </label>
                                <input class="form-control ml-4 nama_produk" name="nama_produk" type="text">
                                <form id="form-supplier">
                                    <input class="form-control ml-4 id_produk" name="id_produk" type="hidden">
                                </form>
                                <div class="input-group-append">
                                    <button class="btn btn-success btn-xs"
                                        onclick="addForm('{{ route('penjualandetail.store') }}')">
                                        <i class="fas fa-search"></i>
                                        Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table table-striped table-bordered  text-center" id="table">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>id_penjualan</th>
                                        <th>kode_produk</th>
                                        <th width="15%">jml_barang</th>
                                        <th width="15%">harga</th>
                                        <th width="15%">total_harga</th>
                                        <th width="15%"><i class="fa fa-cogs" aria-hidden="true"></i></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <form class="form-horizontal" id="form_simpan"
                        action="{{ route('penjualan.update', session('id_penjualan')) }}" method="post">
                        <div class="row mt-4">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group row">
                                        <div class="col-md-3 ml-5">
                                            <label>Jumlah Galon Pinjam</label>
                                        </div>
                                        <div class="col-md-">
                                            <input type="number" name="qty_galon_pinjam" id="master_qty_galon_pinjam"
                                                class="form-control" required>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                    <label>
                                        <h2>Total Harga</h2>
                                    </label>
                                    <table>
                                        <tr>
                                            <th>
                                                <h2 class="txt_total_harga">Rp. 0</h2>
                                            </th>
                                        </tr>
                                    </table>
                                    <input type="hidden" class="form-control" name="total_harga" id="master_total_harga"
                                        required>
                                    <input type="hidden" class="form-control" name="total_item" id="master_total_item"
                                        required>
                                    <input type="hidden" name="bayar" id="master_bayar" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3 ml-5">
                                        <label>tgl Transaksi</label>
                                    </div>
                                    <div class="col-md-">
                                        <input type="date" name="tgl_trs" id="tgl_trs" class="form-control" required>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 ml-5">
                                        <label>Bayar</label>
                                    </div>
                                    <div class="col-md-">
                                        <input type="number" name="nominal" id="master_nominal" class="form-control"
                                            required>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ session('id_penjualan') }}" id="master_id_penjualan">
                                <button
                                    onclick="if ($('#master_total_harga').val() > $('#master_nominal').val()) {
                                        alert('Pembayaran tidak sesuai! akan disimpan sebagai pembayaran Tempo.')
                                        }"
                                    class="btn btn-success float-right mt-3">Simpan
                                    Pembayaran</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('transaksi_penjualan.form')
@endsection
@push('js')
    <script>
        let table;
        let id_penjualan = $('#master_id_penjualan').val();
        var URL = '{{ route('penjualandetail.data', ':id') }}'
        URL = URL.replace(':id', id_penjualan);

        $(document).ready(function() {
            table = $("#table").DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json",
                    "sEmptyTable": "Tidads"
                },
                "info": false,
                "processing": false,
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "ordering": false,
                "paging": false,
                "ajax": {
                    url: URL,
                },
                "columns": [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    shrotable: false
                }, {
                    data: 'id_penjualan'
                }, {
                    data: 'kode_produk'
                }, {
                    data: 'jml_barang'
                }, {
                    data: 'harga'
                }, {
                    data: 'total_harga'
                }, {
                    data: 'aksi',
                    searchable: false,
                    shrotable: false
                }]
            });

            $('body').on('change', '#input_id_produk', function() {
                filter_harga();
            })
            $('body').on('change', '#input_jml_barang', function() {
                change_qty();
            })
            $('body').on('click', '#btn_form_simpan', function() {
                master_total();
            })
            $('body').on('change', '#master_qty_galon_pinjam', function() {
                var cek_input = $('#master_total_item').val() - $('#master_qty_galon_pinjam').val()
                if (cek_input < 0 || $('#master_qty_galon_pinjam').val() < 0) {
                    $('#master_qty_galon_pinjam').val($('#master_total_item').val())
                    alert('Jumlah input tidak sesuai!');
                }
            })
            $('body').on('click', function() {
                master_total();
            })
            validate();
        });

        function filter_harga() {
            cek_stock();
            var tipe_pelanggan = $('#input_tipe_pelanggan').val();
            var id_produk = $('#input_id_produk').find(":selected").val();

            var URL = '{{ route('hargajenis.get_harga') }}'

            $.get(URL, {
                    'id_tipe': tipe_pelanggan,
                    'kode_produk': id_produk,
                })
                .done((response) => {
                    $('#input_harga').val(response.harga);
                })
                .fail((errors) => {
                    alert('Gagal Menampilkan Data');
                    return;
                })
        }

        function change_qty() {
            var qty_produk = $('#input_jml_barang').val()
            var harga = $('#input_harga').val()
            var cek_input = $('#input_stock').val() - $('#input_jml_barang').val()
            if (qty_produk <= 0) {
                $('#input_jml_barang').val('0')
                $('#input_total_harga').val('0')
                alert('tidak boleh kurang/sama dengan 0');
            }
            if (cek_input < 0) {
                alert('qty terlalu banyak')
                $('#input_jml_barang').val($('#input_stock').val())
            } else {
                $('#input_total_harga').val(harga * qty_produk);
            }
        }

        function master_total() {
            //format rupiah
            const formatRupiah = (money) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(money);
            }
            var id_penjualan = $('#master_id_penjualan').val();
            var URL = '{{ route('penjualandetail.total_detail', ':id') }}';
            URL = URL.replace(':id', id_penjualan)
            $.get(URL)
                .done((response) => {
                    $('.txt_total_harga').text(formatRupiah(response.total_harga));
                    $('#master_total_harga').val(response.total_harga);
                    $('#master_total_item').val(response.total_item);
                    $('#master_bayar').val(response.total_harga);
                })
                .fail((errors) => {
                    alert('Total harga gagal')
                })
        }

        function cek_stock() {
            var id_produk = $('#input_id_produk').find(":selected").val();
            var URL = "{{ route('produk.produk_by_kode', ':id') }}"
            URL = URL.replace(':id', id_produk)
            console.log(URL);
            $.get(URL)
                .done((response) => {
                    $('#input_stock').val(response.qty)
                })
                .fail((errors) => {})
        };

        // ==================================================

        function validate() {
            $('#modal-form').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        type: "POST",
                        url: $('#modal-form form').attr('action'),
                        data: $('#modal-form form').serialize(),
                        success: function(result) {
                            if (result.errors) {
                                $('.alert-danger').html('');

                                $.each(result.errors, function(key, value) {
                                    $('.alert-danger').show();
                                    $('.alert-danger').append('<li>' + value + '</li>');
                                });
                            } else {
                                $('#modal-form').modal('hide');
                                $('#table').DataTable().ajax.reload()

                            }
                        },
                        error: function(jqXHR, exception) {
                            var msg = ''
                            if (jqXHR.status === 0) {
                                msg = 'Not connect.\n Verify Network.';
                            } else if (jqXHR.status == 404) {
                                msg = 'Requested page not found. [404]';
                            } else if (jqXHR.status == 500) {
                                msg = 'Internal Server Error [500].';
                            } else if (exception === 'parsererror') {
                                msg = 'Requested JSON parse failed.';
                            } else if (exception === 'timeout') {
                                msg = 'Time out error.';
                            } else if (exception === 'abort') {
                                msg = 'Ajax request aborted.';
                            } else {
                                msg = 'Uncaught Error.\n' + jqXHR.responseText;
                            }
                            $('.alert-danger').html(msg);
                        },
                    })
                }
            })
        };

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Produk');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Produk');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('PUT');

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=id_penjualan]').val(response.id_penjualan);
                    $('#modal-form [name=id_produk]').val(response.id_produk);
                    $('#modal-form [name=jml_barang]').val(response.jml_barang);
                    $('#modal-form [name=harga]').val(response.harga);
                    $('#modal-form [name=total_harga]').val(response.total_harga);
                })
                .fail((errors) => {
                    alert('Gagal Menampilkan Data');
                    return;
                })
        }

        function deleteData(url) {
            if (confirm('Yakin akan menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        $('#table').DataTable().ajax.reload()
                    })
                    .fail((errors) => {
                        alert('Gagal Hapus data!');
                        return;
                    })
            }
        }
    </script>
@endpush
