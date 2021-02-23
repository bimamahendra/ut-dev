<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="opacity: 1;position:absolute;right:0;z-index:1;" data-delay="2000">
        <div class="toast-header text-success">
            <i data-feather="bell"></i>
            <strong class="mr-auto">Success</strong>
            <small class="text-muted ml-2">just now</small>
            <button class="ml-2 mb-1 close" type="button" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="toast-body">Data berhsil disimpan.</div>
    </div> -->
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning mb-2">User List</h6>
                <button class="btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target="#mdlAdd">
                    <i class="fas fa-plus fa-sm text-white-50"></i>
                    Add
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableUser" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Departement</th>
                            <th>Division</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listData as $item) {
                            echo '
                                    <tr>
                                        <td>' . $item->NAMA_USERS . '</td>
                                        <td>' . $item->ROLE_USERS . '</td>
                                        <td>' . $item->DEPT_USERS . '</td>
                                        <td>' . $item->DIV_USERS . '</td>
                                        <td>' . $item->USER_USERS . '</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="' . site_url("user/edit/" . $item->ID_USERS) . '" class="btn btn-primary btn-sm rounded">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" data-toggle="modal" data-id="' . $item->ID_USERS . '" data-name="' . $item->NAMA_USERS . '" data-target="#mdlReset" class="btn btn-secondary btn-sm mx-1 rounded mdlRstPassUserItem">
                                                    <i class="fa fa-key"></i>
                                                </button>
                                                <button type="button" data-toggle="modal" data-id="' . $item->ID_USERS . '" data-name="' . $item->NAMA_USERS . '" data-target="#mdlDelete" class="btn btn-danger btn-sm rounded mdlDelete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                ';
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
                <h5 class="modal-title" id="mdlAdd">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('user/store') ?>" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Nama" name="NAMA_USERS" required>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <select class="custom-select" name="ROLE_USERS" required>
                            <option value="" selected>Role</option>
                            <option value="Head">Head</option>
                            <option value="Section Head">Section Head</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <select class="custom-select" name="DEPT_USERS" required>
                            <option value="" selected>Departement</option>
                            <option value="General">General</option>
                            <option value="Affairs">Affairs</option>
                        </select>
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
                <div class="modal-body">
                    <div class="col">
                        <input type="text" class="form-control" name="USER_USERS" placeholder="Username" required>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <input type="text" class="form-control" value="123ut456" placeholder="Password" disabled>
                        <input type="hidden" name="PASS_USERS" value="123ut456" />
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <input type="file" name="imageTtd" class="custom-file-input" id="image-source" onchange="previewImage();">
                        <label class="custom-file-label" for="image-source">Upload Signature</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Reset -->
<div class="modal fade" id="mdlReset" tabindex="-1" aria-labelledby="mdlReset" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Password Item?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Anda akan mereset password item <span id="mdlRstPassUserItem_item"></span>
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="<?= site_url('user/reset-password') ?>" method="post">
                    <input type="hidden" id="mdlRstPassUserItem_itemId" name="ID_USERS" />
                    <button type="submit" class="btn btn-success">Reset</button>
                </form>
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
                    Anda akan menghapus item <span id="mdlDelete_item">asdfs</span>
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="<?= site_url('user/destroy') ?>" method="post">
                    <input type="hidden" id="mdlDelete_itemId" name="ID_USERS" />
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Custom Javascript -->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script>    
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    $(document).ready(function() {
        // $('.toast').toast('show')
        <?php
        if (empty($notif)) {
            echo "$('.toast').toast('show')";
        }
        ?>
    })
    $('#tableUser tbody').on('click', '.mdlDelete', function() {
        const id = $(this).data('id')
        const name = $(this).data('name')
        $('#mdlDelete_item').html(name)
        $('#mdlDelete_itemId').val(id)
    })
    $('#tableUser tbody').on('click', '.mdlRstPassUserItem', function() {
        const id = $(this).data('id')
        const name = $(this).data('name')
        $('#mdlRstPassUserItem_item').html(name)
        $('#mdlRstPassUserItem_itemId').val(id)

    })
</script>
<!-- End Custom Javascript -->