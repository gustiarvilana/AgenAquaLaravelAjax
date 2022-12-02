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
                            <label for="id_transaksi">ID Transaksi</label>
                        </div>
                        <div class="col-md-6">
                            <input required type="text" value="{{ $data['id_transaksi'] }}" name="id_transaksi"
                                id="id_transaksi" class="form-control" readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="tgl_pengeluaran">Tgl Pengeluaran</label>
                        </div>
                        <div class="col-md-6">
                            <input required type="date" name="tgl_pengeluaran" id="tgl_pengeluaran"
                                class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="tipe_pengeluaran">Tipe Pengeluaran</label>
                        </div>
                        <div class="col-md-6">
                            <select name="tipe_pengeluaran" id="tipe_pengeluaran" class="form-control" required>
                                <option value="">Pilih OPS</option>
                                @foreach ($data['ops'] as $item)
                                    <option value="{{ $item->idops }}">{{ $item->idops . '/' . $item->nama_ops }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="nominal_pengeluaran">Nominal</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="nominal_pengeluaran" id="nominal_pengeluaran"
                                class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="nama_pengeluaran">Nama Pengeluaran</label>
                        </div>
                        <div class="col-md-6">
                            <textarea required type="text" name="nama_pengeluaran" id="nama_pengeluaran" class="form-control" rows="3"></textarea>
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
