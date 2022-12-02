<div class="modal fade" id="modal-form" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="alert alert-danger" style="display:none"></div>
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-3 mx-4">
                            <label for="id_penjualan">ID Penjualan</label>
                        </div>
                        <div class="col-md-6">
                            <select name="id_penjualan" id="id_penjualan" class="form-control" required>
                                <option value="">Pilih Kode Penjualan</option>
                                @foreach ($pinjam as $item)
                                    <option value="{{ $item->id_penjualan }}">
                                        {{ $item->kode_penjualan . '/' . $item->nama }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mx-4">
                            <label for="qty_galon_pinjam">qty_galon_pinjam</label>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="qty_galon_pinjam" id="qty_galon_pinjam" class="form-control"
                                readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mx-4">
                            <label for="qty_galon_kembali">qty_galon_kembali</label>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="qty_galon_kembali" id="qty_galon_kembali" class="form-control"
                                required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mx-4">
                            <label for="qty_galon_sisa">qty_galon_sisa</label>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="qty_galon_sisa" id="qty_galon_sisa" class="form-control"
                                readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mx-4">
                            <label for="tgl_kembali">tgl_kembali</label>
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 mx-4">
                            <label for="nama_pengembali">nama_pengembali</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="nama_pengembali" id="nama_pengembali" class="form-control"
                                required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
