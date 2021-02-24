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
                <select class="custom-select" style="width: 30%;" required>
                    <option value="" selected>Divisi</option>
                    <option>Project Management</option>
                    <option>General Service & Maintenance Management</option>
                    <option>Budget, Asset & Building Management</option>
                </select>
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
                            <th>Link</th>
                            <th>Flag</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($trans as $item) {
                                if($item->STAT_TRANS == '0'){
                                    $status = 'Unverified';
                                }else if($item->STAT_TRANS == '1'){
                                    $status = 'Verified';
                                }else if($item->STAT_TRANS == '2'){
                                    $status = 'Finished';
                                }else if($item->STAT_TRANS == '3'){
                                    $status = 'Rejected';
                                }

                                echo '
                                    <tr>
                                        <td>1</td>
                                        <td>'.$item->NAMA_USERS.'</td>
                                        <td>'.$item->NAMA_FORM.'</td>
                                        <td>'.$item->TS_TRANS.'</td>
                                        <td>'.$item->PATH_TRANS.'</td>
                                        <td>'.$item->FLAG_TRANS.'</td>
                                        <td>'.$status.'</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="" class="btn btn-primary btn-sm rounded" data-tooltip="tooltip" data-placement="top" title="Detail">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <button type="button" data-toggle="modal" data-target="#mdlApprove" data-id="'.$item->ID_TRANS.'" class="btn btn-success btn-sm mx-1 rounded mdlApprove" data-tooltip="tooltip" data-placement="top" title="Approve">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                <button type="button" data-toggle="modal" data-target="#mdlDelete" class="btn btn-danger btn-sm rounded" data-tooltip="tooltip" data-placement="top" title="Reject">
                                                    <i class="fa fa-times"></i>
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
                <h5 class="modal-title" id="mdlAdd">Add Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="col">
                        <select class="custom-select select2" style="width: 100%;" required>
                            <option value="" selected>Nama Form</option>
                            <option>Form 1</option>
                            <option>Form 2</option>
                            <option>Form 3</option>
                        </select>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <select class="custom-select select2" style="width: 100%;" required>
                            <option value="" selected>Nama User</option>
                            <option>Ilham</option>
                            <option>Zidan</option>
                            <option>Kurir siCepat</option>
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
                <form action="<?php site_url('transaction/approve')?>" method="post">
                    <input type="hidden" id="mdlApprove_id" name="ID_TRANS" />
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Reject -->
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
                    Anda akan menghapus item ?
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
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
    $('#tableTransaction tbody').on('click', '.mdlApprove', function(){
        const id = $(this).data("id")
        $('#mdlApprove_id').val(id)
    })
</script>