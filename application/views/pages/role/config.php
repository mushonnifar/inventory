<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Role Config - <?= $role->name ?></h3>
            </div>
            <div class="box-body">
                <form method="post" action="<?= base_url('role/store_config'); ?>">
                    <input type="hidden" name="role_id" value="<?= $role->id ?>">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>MENU</th>
                                <th>READ</th>
                                <th>CREATE</th>
                                <th>UPDATE</th>
                                <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody><?= $table ?></tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
