@extends('layouts.master')

@section('title')
    Pembelian
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
                            <div class="row">
                                <div class="col">
                                </div>
                            </div>
                            <div class="input-group">
                                <input class="form-control ml-4 nama_supplier" name="nama_supplier" type="hidden">
                                <form id="form-supplier">
                                    <input class="form-control ml-4 id_supplier" name="id_supplier" type="hidden">
                                </form>
                                <div class="input-group-append mx-auto">
                                    <button class="btn btn-success" onclick="addForm('{{ route('pembelian.store') }}')">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        Tambah Pembelian</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-inverse  text-center" id="table">
                        <thead class="thead-inverse">
                            <tr>
                                <th width="5%">No</th>
                                <th>id_supplier</th>
                                <th>total_item</th>
                                <th>total_harga</th>
                                <th>bayar</th>
                                <th>nominal</th>
                                <th>Tgl Beli</th>
                                <th width="15%"><i class="fa fa-cogs" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('pembelian.supplier')
@endsection
@push('js')
    <script>
        let table;
        let modal_table;

        $(document).ready(function() {
            table = $("#table").DataTable({
                // "dom": 'Bfrtip',
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
                "autoWidth": false,
                "responsive": true,
                "buttons": [
                    // "copy",
                    // "csv",
                    // "excel",
                    // "pdf",
                    // "print",
                    // "colvis"
                ],
                "ajax": {
                    url: '{{ route('pembelian.data') }}',
                },
                "columns": [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    shrotable: false
                }, {
                    data: 'id_supplier'
                }, {
                    data: 'total_item'
                }, {
                    data: 'total_harga'
                }, {
                    data: 'bayar'
                }, {
                    data: 'nominal'
                }, {
                    data: 'tgl_pembelian'
                }, {
                    data: 'aksi',
                    searchable: false,
                    shrotable: false
                }]
            });

            modal_table = $("#modal_table").DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json",
                    "sEmptyTable": "Tidads"
                },
                "ordering": false,
            });
        });

        function addForm(url) {
            console.log('pembelian');
            $('#modal-supplier').modal('show');
            $('#modal-supplier .modal-title').text('Pilih Supplier Pembelian');

            $('#modal-supplier form').attr('action', url);
            $('#modal-supplier [name=_method]').val('post');
        };

        function pilihSupplier(id_supplier, nama) {
            $('.nama_supplier').val(nama)
            $('.id_supplier').val(id_supplier)
            $('#modal-supplier').modal('hide');

            $.post('{{ route('pembeliandetail.store') }}', {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'post',
                    'id_supplier': $('.id_supplier').val(),
                })
                .done((response) => {
                    $('#table').DataTable().ajax.reload()
                })
                .fail((errors) => {
                    alert('Gagal Hapus data!');
                    return;
                })
        };

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
