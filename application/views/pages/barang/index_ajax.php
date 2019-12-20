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
                <a href="<?= base_url('barang/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>

<script>
    var table;
    $(function () {
        table = $('#table-barang').DataTable({
            ajax: '<?= base_url('barang/get_data') ?>',
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
</script>