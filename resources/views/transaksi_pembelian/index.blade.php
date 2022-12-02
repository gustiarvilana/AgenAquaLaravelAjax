@extends('layouts.master')

@section('title')
    Transaksi Pembelian
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('error_message'))
                echo sdfwef
            @endif
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
                                    <input class="form-control ml-4 kode_produk" name="kode_produk" type="hidden">
                                </form>
                                <div class="input-group-append">
                                    <button class="btn btn-success btn-xs"
                                        onclick="addForm('{{ route('pembeliandetail.store') }}')">
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
                                        <th>id_pembelian</th>
                                        <th>kode_produk</th>
                                        <th width="15%">harga</th>
                                        <th width="15%">jml_barang</th>
                                        <th width="15%">total_harga</th>
                                        <th width="15%"><i class="fa fa-cogs" aria-hidden="true"></i></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <form class="form-horizontal" method="post"
                        action="{{ route('pembelian.update', session('id_pembelian')) }}">
                        <div class="row mt-4">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
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
                        </div>
                        <div class="col-md-6 ml-auto align-middle">
                            <div class="form-group row">
                                <div class="col-md-3 ml-5">
                                    <label>Tanggal Pembelian</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="date" name="tgl_pembelian" id="tgl_pembelian" class="form-control"
                                        required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3 ml-5">
                                    <label for="nominal">Bayar</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" name="nominal" id="master_nominal" class="form-control" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <input type="hidden" value="{{ session('id_pembelian') }}" id="master_id_pembelian">
                            <button class="btn btn-success float-right mt-3">Simpan Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('transaksi_pembelian.form')
@endsection
@push('js')
    <script>
        let table;
        let id_pembelian = $('._id_pembelian').text();
        var URL = '{{ route('pembeliandetail.data', ':id') }}'
        URL = URL.replace(':id', id_pembelian);

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
                    data: 'id_pembelian'
                }, {
                    data: 'id_produk'
                }, {
                    data: 'harga'
                }, {
                    data: 'jml_barang'
                }, {
                    data: 'total_harga'
                }, {
                    data: 'aksi',
                    searchable: false,
                    shrotable: false
                }]
            });

            $('body').on('change', '#input_kode_produk', function() {
                filter_harga();
            })
            $('body').on('change', '#input_jml_barang', function() {
                change_qty();
            })
            $('body').on('click', '#btn_form_simpan', function() {
                master_total();
            })
            $('body').on('click', function() {
                master_total();
            })
            validate();
        });

        function filter_harga() {
            var kode_produk = $('#input_kode_produk').val()
            var URL = '{{ route('produk.produk_by_kode', ':id') }}'
            URL = URL.replace(':id', kode_produk);

            $.get(URL, function(data) {
                    $('#txt_sisa_galon').text(data.qty_galon_sisa + ' pcs');
                })
                .done((response) => {
                    $('#input_harga').val(response.harga_beli);
                })
                .fail((errors) => {
                    alert('Gagal Menampilkan Data');
                    return;
                })
        }

        function change_qty() {
            var qty_produk = $('#input_jml_barang').val()
            var harga = $('#input_harga').val()
            if (qty_produk <= 0) {
                $('#input_jml_barang').val('0')
                $('#input_total_harga').val('0')
                alert('tidak boleh kurang dari 0');
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
            var id_pembelian = $('#master_id_pembelian').val();
            var URL = '{{ route('pembeliandetail.total_detail', ':id') }}';
            URL = URL.replace(':id', id_pembelian)
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
                    $('#modal-form [name=id_pembelian]').val(response.id_pembelian);
                    $('#modal-form [name=kode_produk]').val(response.kode_produk);
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
