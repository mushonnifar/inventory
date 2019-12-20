<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Barang</h3>
            </div>
            <!-- form start -->
            <form role="form" method="post" action="<?= base_url('barang/update/' . $data->id); ?>" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label>Kode</label>
                        <input name="id" placeholder="kode" class="form-control" type="text" readonly=""
                                value="<?= $data->id ?>">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="name" placeholder="nama" class="form-control" type="text" required=""
                               value="<?= $data->name ?>">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Brand</label>
                        <select id="brand" name="brand" class="form-control" required="">
                            <option value="">-- pilih brand --</option>
                            <option value="Polygon" <?= $data->brand == "Polygon" ? "selected" : "" ?>>Polygon</option>
                            <option value="Wim Cycle" <?= $data->brand == "Wim Cycle" ? "selected" : "" ?>>Wim Cycle</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipe</label>
                        <select id="type" name="type" class="form-control" required="">
                            <option value="">-- pilih tipe --</option>
                            <option value="Sepeda" <?= $data->type == "Sepeda" ? "selected" : "" ?>>Sepeda</option>
                            <option value="Mobil" <?= $data->type == "Mobil" ? "selected" : "" ?>>Mobil</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input name="image" class="form-control" type="file">
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
