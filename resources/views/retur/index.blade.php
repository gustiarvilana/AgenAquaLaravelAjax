@extends('layouts.master')

@section('title')
    Retur
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success btn-xs" onclick="addForm('{{ route('retur.store') }}')">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Tambah
                    </button>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-wrench"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a href="#" class="dropdown-item">Action</a>
                                <a href="#" class="dropdown-item">Another action</a>
                                <a href="#" class="dropdown-item">Something else here</a>
                                <a class="dropdown-divider"></a>
                                <a href="#" class="dropdown-item">Separated link</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-inverse  text-center" id="table">
                        <thead class="thead-inverse">
                            <tr>
                                <th width="5%">No</th>
                                <th>id_supplier</th>
                                <th>id_pembelian</th>
                                <th>kode_produk</th>
                                <th>tgl_retur</th>
                                <th>tgl_trs</th>
                                <th>qty</th>
                                <th>harga_beli_satuan</th>
                                <th>harga_beli_total</th>
                                <th>ket</th>
                                <th>Tanggal Buat</th>
                                <th width="15%"><i class="fa fa-cogs" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('retur.form')
@endsection
@push('js')
    <script>
        let table;

        $(document).ready(function() {
            table = $("#table").DataTable({
                "dom": 'Bfrtip',
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json",
                    "sEmptyTable": "Tidads"
                },
                "info": true,
                "processing": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "searching": true,
                "ordering": false,
                "buttons": [
                    // "copy",
                    // "csv",
                    "excel",
                    // "pdf",
                    // "print",
                    // "colvis"
                ],
                "ajax": {
                    url: '{{ route('retur.data') }}',
                },
                "columns": [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    shrotable: false
                }, {
                    data: 'id_supplier'
                }, {
                    data: 'id_pembelian'
                }, {
                    data: 'kode_produk'
                }, {
                    data: 'tgl_retur'
                }, {
                    data: 'tgl_trs'
                }, {
                    data: 'qty'
                }, {
                    data: 'harga_beli_satuan'
                }, {
                    data: 'harga_beli_total'
                }, {
                    data: 'ket'
                }, {
                    data: 'tgl_buat'
                }, {
                    data: 'aksi',
                    searchable: false,
                    shrotable: false
                }]
            });

            validate();
            pilihSupplier();
            harga_total_retur();

        });

        function pilihSupplier() {
            $('#pilih_id_pembelian').on('change', function() {
                var id_pembelian = $('#pilih_id_pembelian').val();
                console.log(id_pembelian);
                URL = '{{ route('pembelian.show', ':id') }}';
                URL = URL.replace(':id', id_pembelian)
                $.get(URL)
                    .done((response) => {
                        $('#input_id_supplier').val(response.id_supplier);
                        $('#input_kode_produk').val(response.kode_produk);
                        $('#input_tgl_trs').val(response.tgl_trs);
                        $('#input_harga_beli_satuan').val(response.harga_satuan);
                        $('#select_id_supplier').val(response.nama);
                        $('#select_kode_produk').val(response.nama_produk);
                    })
                    .fail((errors) => {
                        alert('Gagal Select Supplier')
                    });
            })
        };

        function harga_total_retur() {
            $('#select_qty').on('change', function() {
                var satuan = $('#input_harga_beli_satuan').val();
                var qty = $('#select_qty').val();
                $('#input_harga_beli_total').val(qty * satuan);
            });
        };

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

        // ini ajax default crud
        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Retur');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            console.log(url);
        };

        // function editForm(url) {
        //     $('#modal-form').modal('show');
        //     $('#modal-form .modal-title').text('Edit Retur');

        //     $('#modal-form form')[0].reset();
        //     $('#modal-form form').attr('action', url);
        //     $('#modal-form [name=_method]').val('PUT');

        //     $.get(url)
        //         .done((response) => {
        //             $('#modal-form [name=nama_retur]').val(response.nama_retur);
        //             $('#modal-form [name=harga_beli]').val(response.harga_beli);
        //             $('#modal-form [name=harga_jual]').val(response.harga_jual);
        //             $('#modal-form [name=qty]').val(response.qty);
        //         })
        //         .fail((errors) => {
        //             alert('Gagal Menampilkan Data');
        //             return;
        //         })
        // };

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
        };
    </script>
@endpush
