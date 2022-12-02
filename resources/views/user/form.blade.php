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
                            <label for="name">Nama</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="name" id="name" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-2 ml-5">
                            <label for="nik">Nik</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nik" id="nik" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-2 ml-5">
                            <label for="username">Username</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="username" id="username" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-2 ml-5">
                            <label for="jabatan">Jabatan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="jabatan" id="jabatan" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-2 ml-5">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-md-8">
                            <input type="email" name="email" id="email" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-2 ml-5">
                            <label for="password">Password</label>
                        </div>
                        <div class="col-md-8">
                            <input type="password" name="password" id="password" class="form-control">
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
