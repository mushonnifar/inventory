<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create Role</h3>
            </div>
            <!-- form start -->
            <form role="form" method="post" action="<?= base_url('role/store'); ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="name" placeholder="nama" class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input name="description" placeholder="deskripsi" class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
