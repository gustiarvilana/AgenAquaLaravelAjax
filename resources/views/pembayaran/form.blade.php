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
                        <div class="col-md-3 ml-5">
                            <label for="no_sp">Kode</label>
                        </div>
                        <div class="col-md-6">
                            <select name="no_sp" id="no_sp" class="form-control">
                                <option value="">Pilih Kode Penjualan</option>
                                @foreach ($tempo as $item)
                                    <option value="{{ $item->kode_penjualan }}">
                                        {{ $item->kode_penjualan . '/' . $item->nama }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="angsuran_ke">angsuran_ke</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="angsuran_ke" id="angsuran_ke" class="form-control" readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="sisa">sisa</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="sisa" id="sisa" class="form-control" readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="tgl_bayar">tgl_bayar</label>
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="tgl_bayar" id="tgl_bayar" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="nominal">nominal</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="nominal" id="nominal" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button class="btn btn-primary" onclick="location.reload();">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
