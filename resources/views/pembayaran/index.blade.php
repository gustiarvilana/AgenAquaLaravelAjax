@extends('layouts.master')

@section('title')
    Pembayaran
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success btn-xs" onclick="addForm('{{ route('pembayaran.store') }}')">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Transaksi Pembayaran
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
                                <th>no_sp</th>
                                <th>tgl_bayar</th>
                                <th>angsuran_ke</th>
                                <th>nominal</th>
                                <th>sisa</th>
                                <th width="15%"><i class="fa fa-cogs" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('pembayaran.form')
@endsection
@push('js')
    <script>
        let table;

        $(document).ready(function() {
            // setTimeout(function() {
            //     location.reload();
            // }, 5000);
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
                    url: '{{ route('pembayaran.data') }}',
                },
                "columns": [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    shrotable: false
                }, {
                    data: 'no_sp'
                }, {
                    data: 'tgl_bayar'
                }, {
                    data: 'angsuran_ke'
                }, {
                    data: 'nominal'
                }, {
                    data: 'sisa'
                }, {
                    data: 'aksi',
                    searchable: false,
                    shrotable: false
                }]
            });

            validate();

            $('body').on('change', '#no_sp', function() {
                angsuran();
            });
        });

        function angsuran() {
            var id_penjualan = $('#no_sp').val();
            var url = "{{ route('penjualan.penjualan_by_pelanggan', ':id') }}"
            url = url.replace(':id', id_penjualan)
            $.get(url)
                .done((response) => {
                    $('#angsuran_ke').val(response.cicil_ke)
                    $('#sisa').val(response.sisa_bayar)
                })
                .fail((errors) => {
                    alert('Gagal menampilkan cicilan')
                })
        };

        // ini crud
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
            $('#modal-form .modal-title').text('Tambah Pembayaran');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Pembayaran');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('PUT');

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama]').val(response.nama);
                    $('#modal-form [name=nik]').val(response.nik);
                    $('#modal-form [name=no_ktp]').val(response.no_ktp);
                    $('#modal-form [name=jabatan]').val(response.jabatan);
                    $('#modal-form [name=alamat]').val(response.alamat);
                    $('#modal-form [name=no_hp]').val(response.no_hp);
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
