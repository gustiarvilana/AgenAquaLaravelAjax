<div class="modal fade" id="modal-konsumen" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-danger" style="display:none"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body table-responsive">
                    <table class="table table-striped table-inverse text-center" id="modal_table">
                        <thead class="thead-inverse">
                            <tr>
                                <th width="5%">No</th>
                                <th>kode_konsumen</th>
                                <th width="20%">nama</th>
                                <th>alamat</th>
                                <th>telepon</th>
                                <th width="15%"><i class="fa fa-cogs" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($konsumen as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->kode_konsumen }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->telepon }}</td>
                                    <td>
                                        <a href="{{ route('penjualan.create', $item->id_konsumen) }}"
                                            class="btn btn-success">Pilih</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                {{-- <button class="btn btn-primary">Simpan</button> --}}
            </div>
        </div>
    </div>
</div>
