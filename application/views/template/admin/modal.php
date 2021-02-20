<!-- Role Table Modal -->
<div class="modal fade" id="roleTableModal" tabindex="-1" aria-labelledby="roleTableModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roleTableModal">Add Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select class="custom-select mb-3">
                    <option selected>Nama</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <select class="custom-select">
                    <option selected>Parent Role</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- User Role Table Modal -->
<div class="modal fade" id="userRoleTableModal" tabindex="-1" aria-labelledby="userRoleTableModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userRoleTableModal">Add User Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select class="custom-select mb-3">
                    <option selected>Nama</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <select class="custom-select">
                    <option selected>Role</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Master Flow Table Modal -->
<div class="modal fade" id="masterFlowTableModal" tabindex="-1" aria-labelledby="masterFlowTableModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="masterFlowTableModal">Add Master Flow</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select class="custom-select mb-3">
                    <option selected>Master Approval Name</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <select class="custom-select">
                    <option selected>Next Role</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Week Table Modal -->
<div class="modal fade" id="weekTableModal" tabindex="-1" aria-labelledby="weekTableModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="weekTableModal">Add File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- User Table Modal -->
<div class="modal fade" id="userTableModal" tabindex="-1" aria-labelledby="userTableModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userTableModal">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('user/store') ?>" method="post">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Form Table Modal -->
<div class="modal fade" id="formTableModal" tabindex="-1" aria-labelledby="formTableModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formTableModal">Add Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nama Tabel">
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
                    <input type="text" class="form-control" placeholder="Section Form">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- User Item Delete Modal -->
<div class="modal fade" id="deleteUserItem" tabindex="-1" aria-labelledby="deleteUserItem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserItem">Delete Item?</h5>
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

<!-- Form Item Delete Modal -->
<div class="modal fade" id="deleteFormItem" tabindex="-1" aria-labelledby="deleteFormItem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFormItem">Delete Item?</h5>
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

<!-- User Reset Password Modal -->
<div class="modal fade" id="rstPassUserItem" tabindex="-1" aria-labelledby="rstPassUserItem" aria-hidden="true">
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

<!-- Form Item Setting Modal -->
<div class="modal fade" id="settingFormItem" tabindex="-1" aria-labelledby="settingFormItem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="settingFormItem">Setting Form untuk Table 1</h5>
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
                    <hr>
                </div>
                <div class="col mb-3">
                    <button type="button" class="btn btn-primary" onclick="addFlowItem()">Add Flow</button>
                </div>
                <div class="col" id="formFlow"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>