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
                            <label for="id_pembelian">ID Pembelian</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" value="{{ session('id_pembelian') }}" name="txt_id_pembelian"
                                class="form-control" disabled>
                            <input type="hidden" value="{{ session('id_pembelian') }}" name="id_pembelian">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="id_produk">ID Produk</label>
                        </div>
                        <div class="col-md-6">
                            <select name="id_produk" id="input_kode_produk" class="form-control">
                                <option value="">Pilih Produk</option>
                                @foreach ($produk as $item)
                                    <option value="{{ $item->kode_produk }}">{{ $item->nama_produk }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="harga">Harga Jual</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="harga" id="input_harga" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="jml_barang">Qty Produk</label>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="jml_barang" id="input_jml_barang" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="total_harga">Total Harga</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="total_harga" id="input_total_harga" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button class="btn btn-primary" id="btn_form_simpan">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
