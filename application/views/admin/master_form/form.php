<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form</h1>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning mb-2">Form List</h6>
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
                            <th>Table Name</th>
                            <th>No Doc</th>
                            <th>Form Name</th>
                            <th>Division</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($forms as $item) {
                            echo '
                                    <tr>
                                        <td>' . $item->NAMA_TABEL . '</td>
                                        <td>' . $item->NO_DOC . '</td>
                                        <td>' . $item->NAMA_FORM . 'k</td>
                                        <td>' . $item->SECTION_FORM . '</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="' . site_url('form/edit/' . $item->ID_MAPPING) . '" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <!-- Setting flow -->
                                                <a href="' . site_url('welcome/list_approval') . '" class="btn btn-info btn-sm">
                                                    <i class="fa fa-cog"></i>
                                                </a>
                                                <button type="button" data-toggle="modal" data-id="' . $item->ID_MAPPING . '" data-name="' . $item->NAMA_FORM . '" data-target="#mdlDelete" class="btn btn-danger btn-sm mdlDelete">
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
                <h5 class="modal-title" id="mdlAdd">Add Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('form/store') ?>" method="post">
                <div class="modal-body">
                    <div class="col">
                        <select class="custom-select" name="NAMA_TABEL" required>
                            <option value="" selected>Nama Tabel</option>
                            <?php
                            foreach ($tables as $item) {
                                echo '
                                        <option value="' . $item->table_name . '">' . $item->table_name . '</option>
                                    ';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <input type="text" class="form-control" name="NO_DOC" placeholder="No Doc" required>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <input type="text" class="form-control" name="NAMA_FORM" placeholder="Nama Form" required>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <select class="custom-select" name="SECTION_FORM" required>
                            <option value="" selected>Divisi</option>
                            <option value="Project Management">Project Management</option>
                            <option value="General Service & Maintenances Management">General Service & Maintenance Management</option>
                            <option value="Budget, Asset & Building Management">Budget, Asset & Building Management</option>
                        </select>
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
                <form action="<?= site_url('form/destroy') ?>" method="post">
                    <input type="hidden" id="mdlDelete_itemId" name="ID_MAPPING" />
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- CUSTOM JAVASCRIPT -->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script>
    $('#tableForm tbody').on('click', '.mdlDelete', function() {
        const id = $(this).data('id')
        const name = $(this).data('name')
        $('#mdlDelete_item').html(name)
        $('#mdlDelete_itemId').val(id)
    })
</script>