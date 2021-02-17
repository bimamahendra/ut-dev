<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Form</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning">Table 1</h6>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNamaTabel">Nama Tabel</label>
                        <input type="text" class="form-control" id="inputNamaTabel">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNoDoc">No Doc</label>
                        <input type="text" class="form-control" id="inputNoDoc">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNamaForm">Nama Form</label>
                        <input type="text" class="form-control" id="inputNamaTabel">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputSectionForm">Section Form</label>
                        <input type="text" class="form-control" id="inputSectionForm">
                    </div>
                </div>

                <a href="<?= base_url('welcome/admin_form') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-warning">Simpan</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->