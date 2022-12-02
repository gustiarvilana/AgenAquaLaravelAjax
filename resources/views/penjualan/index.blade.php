@extends('layouts.master')

@section('title')
    Penjualan
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success btn-xs" onclick="addForm('{{ route('penjualan.store') }}')">
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
                                <th>id_pelanggan</th>
                                <th>kode_penjualan</th>
                                <th>tgl_trs</th>
                                <th>qty</th>
                                <th>harga_total</th>
                                <th>bayar</th>
                                <th>status_bayar</th>
                                <th>sisa_bayar</th>
                                <th>cicil_ke</th>
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
    @include('penjualan.konsumen')
    @include('penjualan.form')
@endsection
@push('js')
    <script>
        let table;
        let table2;

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
                    url: '{{ route('penjualan.data') }}',
                },
                "columns": [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    shrotable: false
                }, {
                    data: 'id_pelanggan'
                }, {
                    data: 'kode_penjualan'
                }, {
                    data: 'tgl_trs'
                }, {
                    data: 'qty'
                }, {
                    data: 'harga_total'
                }, {
                    data: 'bayar'
                }, {
                    data: 'status_bayar'
                }, {
                    data: 'sisa_bayar'
                }, {
                    data: 'cicil_ke'
                }, {
                    data: 'tgl_buat'
                }, {
                    data: 'aksi',
                    searchable: false,
                    shrotable: false
                }]
            });

            table2 = $("#modal_table").DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json",
                    "sEmptyTable": "Tidads"
                },
                "ordering": false,
            });

            validate();

        });

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
            $('#modal-konsumen').modal('show');
            $('#modal-konsumen .modal-title').text('Tambah Penjualan');

            $('#modal-konsumen form')[0].reset();
            $('#modal-konsumen form').attr('action', url);
            $('#modal-konsumen [name=_method]').val('post');
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Penjualan');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('PUT');

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=id_transaksi]').val(response.id_transaksi);
                    $('#modal-form [name=nama_penjualan]').val(response.nama_penjualan);
                    $('#modal-form [name=tipe_penjualan]').val(response.tipe_penjualan);
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
