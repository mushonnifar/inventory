<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create Role</h3>
            </div>
            <!-- form start -->
            <form role="form" method="post" action="<?= base_url('user/update/' . $data->id); ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="name" placeholder="nama" class="form-control" type="text" required=""
                               value="<?= $data->name ?>">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input name="username" placeholder="username" class="form-control" type="text" required=""
                               value="<?= $data->username ?>">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select id="select" name="role_id" class="form-control selectpicker" required="">
                            <option value="0">-- pilih role --</option>
                            <?php foreach ($role as $value) { ?>
                                <option value="<?php echo $value->id; ?>" <?= $value->id == $data->role_id ? 'selected' : '' ?>>
                                    <?php echo $value->name; ?>
                                </option>
                            <?php } ?>
                        </select>
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
