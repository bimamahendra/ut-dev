<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Debit Note</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning">Nama Debit Note</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="#" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNoFaktur">No. Faktur</label>
                        <input type="text" class="form-control" name="#" value="1610000436" id="inputNoFaktur" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputTanggalFaktur">Tanggal Faktur</label>
                        <input type="date" class="form-control" name="#" id="inputTanggalFaktur" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputTanggalJatuhTempo">Tanggal Jatuh Tempo</label>
                        <input type="date" class="form-control" name="#" id="inputTanggalJatuhTempo" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNoPajakFaktur">No. Pajak Faktur</label>
                        <input type="text" class="form-control" name="#" value="1610000436" id="inputNoPajakFaktur" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNamaPerusahaan">Nama Perusahaan</label>
                        <input type="text" class="form-control" name="#" value="PT ATMC PUMP SERVICES" id="inputNamaPerusahaan" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputBarang">Barang / Jasa Kena Pajak</label>
                        <input type="text" class="form-control" name="#" value="RENT CHARGE PERIODE OKTOBER - DESEMBER 2020" id="inputBarang" required>
                    </div>
                </div>

                <input type="hidden" name="#" value="#" />
                <a href="<?= site_url('debitnote') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-warning">Simpan</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->