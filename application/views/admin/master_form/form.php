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
                <button class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target="#formTableModal">
                    <i class="fas fa-plus fa-sm text-white-50"></i>
                    Add
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table-role" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Tabel</th>
                            <th>No Doc</th>
                            <th>Nama Form</th>
                            <th>Section Form</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Tabel</th>
                            <th>No Doc</th>
                            <th>Nama Form</th>
                            <th>Section Form</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Table 1</td>
                            <td>351263572</td>
                            <td>Snack</td>
                            <td>asdf</td>
                            <td>
                                <a href="<?= base_url('welcome/admin_form_edit'); ?>" class="btn btn-primary">Edit</a>
                                <button type="button" class="btn btn-danger">Hapus</button>
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