@extends('layouts.master')

@section('title')
    Pembelian Detail
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
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-inverse  text-center" id="table">
                        <thead class="thead-inverse">
                            <tr>
                                <th width="5%">No</th>
                                <th>id_pembelian</th>
                                <th>id_produk</th>
                                <th>jml_barang</th>
                                <th>harga</th>
                                <th>total_harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->id_pembelian }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->jml_barang }}</td>
                                    <td>{{ 'Rp ' . format_uang($item->harga) }}</td>
                                    <td>{{ 'Rp ' . format_uang($item->total_harga) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let table;

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
            });
        });
    </script>
@endpush
