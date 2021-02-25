<div style="background: url('<?= base_url('assets/img/bg/bg_regist.png'); ?>') no-repeat center; background-size: cover;">
    <div class="container">
        <div class="d-flex flex-row justify-content-end align-items-center min-vh-100">
            <div class="card p-3">
                <div class="card-body">
                    <h2 class="card-title mb-3">Register</h2>
                    <form action="<?= site_url('user/register') ?>" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nama" name="NAMA_USERS" required>
                        </div>
                        <div class="form-group">
                            <select class="custom-select" name="ROLE_USERS" required>
                                <option value="" selected>Role</option>
                                <option value="Head">Head</option>
                                <option value="Section Head">Section Head</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="custom-select" name="DEPT_USERS" required>
                                <option value="" selected>Departement</option>
                                <option value="General">General</option>
                                <option value="Affairs">Affairs</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="custom-select" name="DIV_USERS" required>
                                <option value="" selected>Divisi</option>
                                <option value="Project Management">Project Management</option>
                                <option value="General Service & Maintenances Management">General Service & Maintenance Management</option>
                                <option value="Budget, Asset & Building Management">Budget, Asset & Building Management</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="USER_USERS" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="PASS_USERS" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="imageTtd" class="custom-file-input" id="image-source" onchange="previewImage();">
                                <label class="custom-file-label" for="image-source">Upload Signature</label>
                            </div>
                        </div>
                        <input type="hidden" name="STAT_USERS" value="0" />
                        <div>
                            <button class="btn btn-warning btn-block" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>