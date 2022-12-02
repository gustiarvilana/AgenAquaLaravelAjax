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
                            <label for="id_pelanggan">id_pelanggan</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="id_pelanggan" id="id_pelanggan" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="kode_penjualan">kode_penjualan</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="kode_penjualan" id="kode_penjualan" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="tgl_trs">tgl_trs</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="tgl_trs" id="tgl_trs" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="qty">qty</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="qty" id="qty" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="harga_total">harga_total</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="harga_total" id="harga_total" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="bayar">bayar</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="bayar" id="bayar" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="status_bayar">status_bayar</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="status_bayar" id="status_bayar" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="sisa_bayar">sisa_bayar</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="sisa_bayar" id="sisa_bayar" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="cicil_ke">cicil_ke</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="cicil_ke" id="cicil_ke" class="form-control">
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
