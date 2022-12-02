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
                            <label for="kode_jabatan">kode_jabatan</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="kode_jabatan" id="kode_jabatan" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 ml-5">
                            <label for="nama_jabatan">nama_jabatan</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control">
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
