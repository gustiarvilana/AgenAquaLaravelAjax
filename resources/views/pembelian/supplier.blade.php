<div class="modal fade" id="modal-supplier" data-backdrop="static" data-keyboard="false" tabindex="-1"
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
                                <th>no_supplier</th>
                                <th width="20%">nama</th>
                                <th>alamat</th>
                                <th>telepon</th>
                                <th width="15%"><i class="fa fa-cogs" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplier as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->no_supplier }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->telepon }}</td>
                                    <td>
                                        <a href="{{ route('pembelian.create', $item->id_supplier) }}"
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
