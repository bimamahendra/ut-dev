<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form</h1>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning">Form Table</h6>
                <button class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target="#mdlAdd">
                    <i class="fas fa-plus fa-sm text-white-50"></i>
                    Add
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableForm" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Tabel</th>
                            <th>No Doc</th>
                            <th>Nama Form</th>
                            <th>Divisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Table 1</td>
                            <td>351263572</td>
                            <td>Snack</td>
                            <td>asdf</td>
                            <td>
                                <a href="<?= site_url('form/edit'); ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <!-- Setting flow -->
                                <a href="<?= site_url('welcome/list_approval'); ?>" class="btn btn-info btn-sm">
                                    <i class="fa fa-cog"></i>
                                </a>
                                <button type="button" data-toggle="modal" data-target="#mdlDelete" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Add -->
<div class="modal fade" id="mdlAdd" tabindex="-1" aria-labelledby="mdlAdd" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlAdd">Add Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <select class="custom-select" required>
                        <option value="" selected>Nama Tabel</option>
                        <option>Tabel 1</option>
                        <option>Tabel 2</option>
                        <option>Tabel 3</option>
                    </select>
                </div>
            </div>
            <div class="modal-body">
                <div class="col">
                    <input type="text" class="form-control" placeholder="No Doc">
                </div>
            </div>
            <div class="modal-body">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nama Form">
                </div>
            </div>
            <div class="modal-body">
                <div class="col">
                    <select class="custom-select" name="DIV_USERS" required>
                        <option value="" selected>Divisi</option>
                        <option value="Project Management">Project Management</option>
                        <option value="General Service & Maintenances Management">General Service & Maintenance Management</option>
                        <option value="Budget, Asset & Building Management">Budget, Asset & Building Management</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="mdlDelete" tabindex="-1" aria-labelledby="mdlDelete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlDelete">Delete Item?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Anda akan menghapus item "Table 1"
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>