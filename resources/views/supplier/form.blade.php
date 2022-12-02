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
                            <label for="no_supplier">ID Supplier</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="no_supplier" id="no_supplier" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="nama">Nama</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="nama" id="nama" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="alamat" id="alamat" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="telepon">Telepon</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="telepon" id="telepon" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label class="col-md-3 col-form-label" for="kota">Kota</label>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" name="id_kota" id="id_kota" required>
                                <option>==Pilih Salah Satu==</option>
                                @foreach ($cities as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label class="col-md-3 col-form-label" for="kecamatan">Kecamatan</label>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" name="id_kecamatan" id="id_kecamatan" required>
                                <option>==Pilih Salah Satu==</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label class="col-md-3 col-form-label" for="desa">Kelurahan</label>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" name="id_kelurahan" id="id_kelurahan" required>
                                <option>==Pilih Salah Satu==</option>
                            </select>
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
