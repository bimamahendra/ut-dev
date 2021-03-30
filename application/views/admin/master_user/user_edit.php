<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Pengguna</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning"><?= $dataUser[0]->NAMA_USERS?></h6>
            </div>
        </div>
        <div class="card-body">
            <form action="<?= site_url('user/update')?>" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNama">Nama</label>
                        <input type="text" class="form-control" value="<?= $dataUser[0]->NAMA_USERS ?>" placeholder="Nama" name="NAMA_USERS" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputRole">Jabatan</label>
                        <select class="custom-select" name="ROLE_USERS" required>
                            <option value="">Jabatan</option>
                            <option value="Staff" <?= $dataUser[0]->ROLE_USERS == 'Staff'?'selected' : '' ?> >Staff</option>
                            <option value="PICK" <?= $dataUser[0]->ROLE_USERS == 'PICK'?'selected' : '' ?> >PIC Kendaraan</option>
                            <option value="PICG" <?= $dataUser[0]->ROLE_USERS == 'PICG'?'selected' : '' ?> >PIC Gudang</option>
                            <option value="PICA" <?= $dataUser[0]->ROLE_USERS == 'PICA'?'selected' : '' ?> >PIC Admin</option>
                            <option value="PICM" <?= $dataUser[0]->ROLE_USERS == 'PICM'?'selected' : '' ?> >PIC Maintenance</option>
                            <option value="PICC" <?= $dataUser[0]->ROLE_USERS == 'PICC'?'selected' : '' ?> >PIC Catering</option>
                            <option value="Section Head" <?= $dataUser[0]->ROLE_USERS == 'Section Head'?'selected' : '' ?> >Section Head</option>
                            <option value="Department Head" <?= $dataUser[0]->ROLE_USERS == 'Department Head'? 'selected' : '' ?> >Department Head</option>
                            <option value="Division Head" <?= $dataUser[0]->ROLE_USERS == 'Division Head'? 'selected' : '' ?> >Division Head</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputDepartemen">Departemen</label>
                        <select class="custom-select" name="DEPT_USERS" required>
                            <option value="" >Departement</option>
                            <option value="General Affairs" <?= $dataUser[0]->DEPT_USERS == 'General Affairs'? 'selected' : '' ?>>General Affairs</option>
                            <option value="Others" <?= $dataUser[0]->DEPT_USERS == 'Others'? 'selected' : '' ?>>Others</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputDivisi">Divisi</label>
                        <select class="custom-select" name="DIV_USERS" required>
                            <option value="">Divisi</option>
                            <option value="Project Management" <?= $dataUser[0]->DIV_USERS == 'Project Management'? 'selected' : 'asd' ?>>Project Management</option>
                            <option value="General Service & Maintenances Management" <?= $dataUser[0]->DIV_USERS == 'General Service & Maintenances Management'? 'selected' : 'asd' ?>>General Service & Maintenance</option>
                            <option value="Budget, Asset & Building Management" <?= $dataUser[0]->DIV_USERS == 'Budget, Asset & Building Management'? 'selected' : 'asd' ?>>Budget, Asset & Building Management</option>
                            <option value="Others" <?= $dataUser[0]->DIV_USERS == 'Others'? 'selected' : '' ?>>Others</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputUsername">Username</label>
                        <input type="text" value="<?= $dataUser[0]->USER_USERS ?>" class="form-control" name="USER_USERS" placeholder="Username" required>
                    </div>
                </div>
                <!-- <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword">Password</label>
                        <input type="text" clasIlham Sagita Putras="form-control" id="inputPassword">
                    </div>
                </div> -->
                <input type="hidden" value="<?= $dataUser[0]->ID_USERS?>" name="ID_USERS" />
                <a href="<?= site_url('user') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-warning">Simpan</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->