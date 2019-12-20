<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create Brand</h3>
            </div>
            <!-- form start -->
            <form role="form" method="post" action="<?= base_url('barang/store'); ?>" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label>Kode</label>
                        <input name="id" placeholder="kode" class="form-control" type="text" required="">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="name" placeholder="nama" class="form-control" type="text" required="">
                    </div>
                    <div class="form-group">
                        <label>Brand</label>
                        <select id="brand" name="brand" class="form-control" required="">
                            <option value="">-- pilih brand --</option>
                            <option value="Polygon">Polygon</option>
                            <option value="Wim Cycle">Wim Cycle</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipe</label>
                        <select id="type" name="type" class="form-control" required="">
                            <option value="">-- pilih tipe --</option>
                            <option value="Sepeda">Sepeda</option>
                            <option value="Mobil">Mobil</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input name="image" class="form-control" type="file" required="">
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
