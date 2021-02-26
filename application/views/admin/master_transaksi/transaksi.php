<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaction</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning mb-2">Transaction List</h6>
                <!--
                <select class="custom-select" style="width: 30%;" required>
                    <option value="" selected>Divisi</option>
                    <option>Project Management</option>
                    <option>General Service & Maintenance Management</option>
                    <option>Budget, Asset & Building Management</option>
                </select>
                -->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableTransaction" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Applicant</th>
                            <th>Form</th>
                            <th>Timestamp</th>
                            <th>Keterangan</th>
                            <th>Flag</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($trans as $item) {
                            $approvalBtn = '';
                            if ($item->STAT_TRANS == '0') {
                                $status = 'Unverified';
                                $approvalBtn = '
                                        <button type="button" data-toggle="modal" data-target="#mdlApprove" data-id="' . $item->ID_TRANS . '" class="btn btn-success btn-sm mx-1 rounded mdlApprove" data-tooltip="tooltip" data-placement="top" title="Approve">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button type="button" data-toggle="modal" data-target="#mdlReject" data-id="' . $item->ID_TRANS . '" class="btn btn-danger btn-sm rounded mdlReject" data-tooltip="tooltip" data-placement="top" title="Reject">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    ';
                            } else if ($item->STAT_TRANS == '1') {
                                $status = 'Verified';
                            } else if ($item->STAT_TRANS == '2') {
                                $status = 'Finished';
                            } else if ($item->STAT_TRANS == '3') {
                                $status = 'Rejected';
                            }

                            echo '
                                    <tr>
                                        <td>1</td>
                                        <td>' . $item->NAMA_USERS . '</td>
                                        <td>' . $item->NAMA_FORM . '</td>
                                        <td>' . $item->TS_TRANS . '</td>
                                        <td>' . $item->KETERANGAN_TRANS . '</td>
                                        <td>' . $item->FLAG_TRANS . '</td>
                                        <td>' . $status . '</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" data-toggle="modal" data-target="#mdlView" data-src="' . $item->PATH_TRANS . '" class="btn btn-primary btn-sm rounded mdlView" data-tooltip="tooltip" data-placement="top" title="Detail">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                ' . $approvalBtn . '
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

<!-- Modal Approve -->
<div class="modal fade" id="mdlApprove" tabindex="-1" aria-labelledby="mdlApprove" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlApprove">Approve Item?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Anda akan mensetujui item ?
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="<?= site_url('transaction/approve') ?>" method="post">
                    <input type="hidden" id="mdlApprove_id" name="ID_TRANS" />
                    <button type="submit" class="btn btn-warning">Approve</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Reject -->
<div class="modal fade" id="mdlReject" tabindex="-1" aria-labelledby="mdlReject" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlReject">Reject Item?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('transaction/reject') ?>" method="post">
                    <div class="form-group">
                        <label for="inputKeterangan">Keterangan</label>
                        <textarea name="KETERANGAN_TRANS" class="form-control" required></textarea>
                    </div>
            </div>

            <div class="modal-footer">
                <input type="hidden" id="mdlReject_id" name="ID_TRANS" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal View PDF -->
<div class="modal fade" id="mdlView" tabindex="-1" aria-labelledby="mdlView" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlReject"> View Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="mdlView_src" src="" frameborder="0" width="100%" height="500px"></iframe>
            </div>

            <div class="modal-footer">
                <input type="hidden" id="mdlReject_id" name="ID_TRANS" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: 'resolve'
        });
    });
    $('#tableTransaction tbody').on('click', '.mdlApprove', function() {
        const id = $(this).data("id")
        $('#mdlApprove_id').val(id)
    })
    $('#tableTransaction tbody').on('click', '.mdlReject', function() {
        const id = $(this).data("id")
        $('#mdlReject_id').val(id)
    })
    $('#tableTransaction tbody').on('click', '.mdlView', function() {
        const src = $(this).data("src")
        $('#mdlView_src').attr('src', src);
    })
</script>