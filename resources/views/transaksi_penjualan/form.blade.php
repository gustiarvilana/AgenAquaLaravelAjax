<div class="modal fade" id="modal-form" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                    <div class="row mx-3">
                        <div class="col-md-3">
                            <label for="id_penjualan">id_penjualan</label>
                            <div class="col-md-6">
                                <input type="text" value="{{ session('id_penjualan') }}" name="id_penjualan"
                                    class="form-control" readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="nama">nama</label>
                            <div class="col-md-6">
                                <input type="text" value="{{ $jenis_konsumen->nama }}" name="nama" id="input_nama"
                                    class="form-control" readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="tipe_pelanggan">tipe_pelanggan</label>
                            <div class="col-md-6">
                                <input type="text" value="{{ $jenis_konsumen->tipe_pelanggan }}"
                                    name="input_tipe_pelanggan" id="input_tipe_pelanggan" class="form-control" readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="stock">Stok</label>
                            <div class="col-md-6">
                                <input type="text" name="stock" id="input_stock" class="form-control" readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="kode_produk">kode_produk</label>
                        </div>
                        <div class="col-md-6">
                            <select name="kode_produk" id="input_id_produk" class="form-control">
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
                            <label for="harga">harga</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="harga" id="input_harga" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="jml_barang">jml_barang</label>
                        </div>
                        <div class="col-md-6">
                            <input type="number" name="jml_barang" id="input_jml_barang" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="total_harga">total_harga</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="total_harga" id="input_total_harga" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button class="btn btn-primary" id="btn_form_simpanxxx">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
