@extends('layouts.master')

@section('title')
    Galon
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success btn-xs" onclick="addForm('{{ route('galon.store') }}')">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Pengembalian Galon
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
                                <th>id_penjualan</th>
                                <th>qty_galon_pinjam</th>
                                <th>qty_galon_kembali</th>
                                <th>qty_galon_sisa</th>
                                <th>tgl_kembali</th>
                                <th>nama_pengembali</th>
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
    @include('galon.form')
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
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": [
                    // "copy",
                    // "csv",
                    "excel",
                    // "pdf",
                    // "print",
                    // "colvis"
                ],
                "ajax": {
                    url: '{{ route('galon.data') }}',
                },
                "columns": [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    shrotable: false
                }, {
                    data: 'id_penjualan'
                }, {
                    data: 'qty_galon_pinjam'
                }, {
                    data: 'qty_galon_kembali'
                }, {
                    data: 'qty_galon_sisa'
                }, {
                    data: 'tgl_kembali'
                }, {
                    data: 'nama_pengembali'
                }, {
                    data: 'tgl_buat'
                }, {
                    data: 'aksi',
                    searchable: false,
                    shrotable: false
                }]
            });

            validate();

            $('body').on('change', '#id_penjualan', function() {
                data_galon()
            });
            $('body').on('change', '#qty_galon_kembali', function() {
                $('#qty_galon_sisa').val($('#qty_galon_pinjam').val() - $('#qty_galon_kembali').val());
            });

        });

        function data_galon() {
            var id_penjualan = $('#id_penjualan').val();
            var url = '{{ route('galon.get_by_pejualan', ':id') }}'
            url = url.replace(':id', id_penjualan)
            $.get(url)
                .done((response) => {
                    $('#qty_galon_pinjam').val(response.qty_galon_pinjam);
                })
                .fail((errors) => {
                    alert('Gagal menampilkan data galon!')
                })
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

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Galon');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Galon');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('PUT');

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=id_penjualan]').val(response.id_penjualan);
                    $('#modal-form [name=qty_galon_pinjam]').val(response.qty_galon_pinjam);
                    $('#modal-form [name=qty_galon_kembali]').val(response.qty_galon_kembali);
                    $('#modal-form [name=qty_galon_sisa]').val(response.qty_galon_sisa);
                    $('#modal-form [name=tgl_kembali]').val(response.tgl_kembali);
                    $('#modal-form [name=nama_pengembali]').val(response.nama_pengembali);
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
