<div class="modal fade" id="modal-form" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="alert alert-danger" style="display:none"></div>
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('')
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="id_pembelian">id_pembelian </label>
                        </div>
                        <div class="col-md-6">
                            <select name="id_pembelian" id="pilih_id_pembelian" class="form-control">
                                <option value="">Pilih ID pembelian</option>
                                @foreach ($pembelian as $item)
                                    <option value="{{ $item->id_pembelian }}">
                                        {{ $item->id_pembelian . ' - ' . date('Ymd', strtotime($item->created_at)) }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="id_supplier">id_supplier </label>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" name="id_supplier" id="input_id_supplier" class="form-control">
                            <input type="text" name="select_id_supplier" id="select_id_supplier"
                                class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="kode_produk">kode_produk </label>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" name="kode_produk" id="input_kode_produk" class="form-control">
                            <input type="text" name="select_kode_produk" id="select_kode_produk"
                                class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="tgl_trs">tgl_trs </label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="tgl_trs" id="input_tgl_trs" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="harga_beli_satuan">harga_beli_satuan </label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="harga_beli_satuan" id="input_harga_beli_satuan"
                                class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="tgl_retur">tgl_retur </label>
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="tgl_retur" id="tgl_retur" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="qty">qty </label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="qty" id="select_qty" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="harga_beli_total">harga_beli_total </label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="harga_beli_total" id="input_harga_beli_total"
                                class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="ket">ket </label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="ket" id="ket" class="form-control">
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
