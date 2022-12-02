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
                        <div class="col-md-2 ml-5">
                            <label for="nama">nama</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nama" id="nama" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 ml-5">
                            <label for="nik">nik</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nik" id="nik" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 ml-5">
                            <label for="no_ktp">no_ktp</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="no_ktp" id="no_ktp" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 ml-5">
                            <label for="jabatan">jabatan</label>
                        </div>
                        <div class="col-md-8">
                            <select name="jabatan" id="jabatan" class="form-control">
                                <option value="">Pilih Jabatan</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->kode_jabatan }}">{{ $item->nama_jabatan }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 ml-5">
                            <label for="alamat">alamat</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="alamat" id="alamat" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 ml-5">
                            <label for="no_hp">no_hp</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="no_hp" id="no_hp" class="form-control">
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
