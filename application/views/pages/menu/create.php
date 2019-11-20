<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create Menu</h3>
            </div>
            <!-- form start -->
            <form role="form" method="post" action="<?= base_url('menu/store'); ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label>Parent</label>
                        <select id="select" name="parent" class="form-control selectpicker">
                            <option value="0">-- pilih parent --</option>
                            <?php foreach ($parent as $value) { ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
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
                    <div class="form-group">
                        <label>Link</label>
                        <input name="link" placeholder="link" class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <input name="icon" placeholder="icon" class="form-control" type="text">
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
