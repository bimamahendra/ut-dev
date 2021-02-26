<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-start mb-4">
        <a href="<?= site_url('form') ?>" class="rounded border-0 btn btn-warning mr-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="h3 mb-0 text-gray-800">List Approval</h1>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning mb-2">Form Snack</h6>
                <button class="btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target="#mdlAdd">
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
                            <th>No</th>
                            <th>List Approval</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($x = 1; $x <= 15; $x++) {
                            $approval = "APP_" . $x;
                            if (!empty($flows[0]->$approval)) {
                                echo '
                                        <tr>
                                        <td>APP_' . $x . '</td>
                                        <td>' . $flows[0]->$approval . '</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                            <button type="button" data-toggle="modal" data-target="#mdlEdit" class="btn btn-primary btn-sm rounded mr-1">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#mdlDelete" class="btn btn-danger btn-sm rounded">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            </div>
                                        </td>
                                    </tr>
                                ';
                            }
                        }
                        ?>
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
                <h5 class="modal-title" id="mdlAdd">Setting List Approval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <select class="custom-select" required>
                        <option value="" selected>Role</option>
                        <option>Head</option>
                        <option>Section Head</option>
                        <option>Department Head</option>
                        <option>Division Head</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="mdlEdit" tabindex="-1" aria-labelledby="mdlEdit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlEdit">Edit List Approval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <select class="custom-select" required>
                        <option value="" selected>Divisi</option>
                        <option>Project Management</option>
                        <option>General Service</option>
                        <option>Maintenance Management</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-warning">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="mdlDelete" tabindex="-1" aria-labelledby="mdlDelete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlDelete">Delete List Approval?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Anda akan menghapus list Approval "Section Head"
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>