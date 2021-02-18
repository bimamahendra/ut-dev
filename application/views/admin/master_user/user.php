<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning">User Table</h6>
                <button class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target="#userTableModal">
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
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Departement</th>
                            <th>Divisi</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Login</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Departement</th>
                            <th>Divisi</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Login</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Ilham Sagita Putra</td>
                            <td>Supervisor</td>
                            <td>Ngalur Ngidul</td>
                            <td>Jalanan</td>
                            <td>isap</td>
                            <td>****</td>
                            <td>1</td>
                            <td>
                                <a href="<?= site_url('user/edit'); ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm">
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