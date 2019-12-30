<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Barang</h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive" id="table-barang">
                    <thead>
                        <tr>
                            <th>nomor</th>
                            <th>kode</th>
                            <th>nama</th>
                            <th>brand</th>
                            <th>tipe</th>
                            <th>gambar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php if ($this->auth->privilege_check('barang_ajax', 'create')) { ?>
                    <button type="button" class="btn btn-primary" onclick="create()"><i class="fa fa-plus"></i></button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="barang-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="barang-form"  enctype="multipart/form-data">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()" id="btn-save">Save</button>
                <button type="button" class="btn btn-primary" onclick="" id="btn-update">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    var table;
    $(function () {
        table = $('#table-barang').DataTable({
            ajax: '<?= base_url('barang_ajax/get_data') ?>',
            columns: [
                {data: 'no'},
                {data: 'id'},
                {data: 'name'},
                {data: 'brand'},
                {data: 'type'},
                {data: 'image'},
                {data: 'action'}
            ]
        });
    });

    function create() {
        $('#barang-form')[0].reset();
        $('#btn-save').show();
        $('#btn-update').hide();
        $('#barang-modal').modal('show');
    }

    function save() {
        var data = new FormData($('#barang-form')[0]);
        var url = '<?= base_url('barang_ajax/store') ?>';
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            success: function (response) {
                if (response.status_code == 1) {
                    $('#barang-modal').modal('hide');
                    table.ajax.reload();
                } else {
                    alert(response.message);
                }
            }
        });
    }

    function edit(id) {
        var url = '<?= base_url('barang_ajax/edit/') ?>' + id;
        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                if (response.status_code == 1) {
                    $('[name="id"]').val(response.data.id);
                    $('[name="name"]').val(response.data.name);
                    $('[name="brand"]').val([response.data.brand]);
                    $('[name="type"]').val(response.data.type);

                    $('#btn-save').hide();
                    $('#btn-update').attr('onclick', "update('" + response.data.id + "')");
                    $('#btn-update').show();
                    $('#barang-modal').modal('show');
                } else {
                    alert(response.message);
                }
            }
        });
    }

    function update(id) {
        var data = new FormData($('#barang-form')[0]);
        var url = '<?= base_url('barang_ajax/update/') ?>' + id;
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            success: function (response) {
                if (response.status_code == 1) {
                    $('#barang-modal').modal('hide');
                    table.ajax.reload();
                } else {
                    alert(response.message);
                }
            }
        });
    }

    function remove(id) {
        if (confirm('Are you sure delete this data?')) {
            $.get('<?= base_url('barang_ajax/delete/') ?>' + id)
                    .done(function (response) {
                        if (response.status_code == 1) {
                            table.ajax.reload();
                        } else {
                            alert(response.message);
                        }
                    });
        }
    }
</script>