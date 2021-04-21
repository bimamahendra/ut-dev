<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Debit Note (Approved)</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-warning mb-2">Daftar Debit Note (Approved)</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableTransaction" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Faktur</th>
                            <th>Tanggal Faktur</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>No. Faktur Pajak</th>
                            <th>Nama Perusahaan</th>
                            <th>Barang / Jasa Kena Pajak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($debitnotes as $item) {
                            echo '
                                    <tr>
                                        <td>' . $no . '</td>
                                        <td>' . $item->NOFAKTUR_DEBITNOTE . '</td>
                                        <td>' . date_format(date_create($item->TGLFAKTUR_DEBITNOTE), 'j F Y') . '</td>
                                        <td>' . date_format(date_create($item->TGLJATUH_DEBITNOTE), 'j F Y') . '</td>
                                        <td>' . $item->NOFAKTURPAJAK_DEBITNOTE . '</td>
                                        <td>' . $item->NAMAPERUSAHAAN_DEBITNOTE . '</td>
                                        <td>' . $item->BARANGJASA_DEBITNOTE . '</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" data-toggle="modal" data-id="'.$item->ID_DEBITNOTE.'" data-email="'.$item->EMAIL_DEBITNOTE.'" data-tgljatuh="'.$item->TGLJATUH_DEBITNOTE.'" data-name="'.$item->NOFAKTUR_DEBITNOTE.'" data-target="#mdlEmail" class="btn btn-success btn-sm rounded mdlEmail" data-tooltip="tooltip" data-placement="top" title="Email">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                                <button type="button" data-toggle="modal" data-src="' . $item->PATH_DEBITNOTE . '" data-target="#mdlView" class="btn btn-primary btn-sm ml-1 rounded mdlView" data-tooltip="tooltip" data-placement="top" title="Detail">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                ';
                            $no++;
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

<!-- Modal Email -->
<div class="modal fade" id="mdlEmail" tabindex="-1" aria-labelledby="mdlEmail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlEmail">Kirimkan E-mail?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Anda akan mengirim Debit Note dengan No. Faktur <span id="mdlEmail_name"></span>?
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="<?= site_url('email/sendEmail')?>" method="post">
                    <input type="hidden" id="mdlEmail_id" name="ID_DEBITNOTE" />
                    <input type="hidden" id="mdlEmail_email" name="EMAIL_DEBITNOTE" />
                    <input type="hidden" id="mdlEmail_tglJatuh" name="TGLJATUH_DEBITNOTE" />
                    <button type="submit" class="btn btn-success">Kirim</button>
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
                <h5 class="modal-title" id="mdlReject">Detail Debit Note</h5>
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
        $.ajax({
            url: '<?= site_url('notif/rAjxDebitnoteAll')?>',
            method: 'post',
            data: {STAT_DEBITNOTE: '2'},
            success: function(){
                updateNotif()
            }
        })
    });
    const updateNotif = () => {
        $.ajax({
            method: 'POST',
            url: "<?= site_url('notif/debitnote') ?>",
            success: function(response) {
                $('.notifs').html(response);
            }
        })
    }
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
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
    $('#tableTransaction tbody').on('click', '.mdlEmail', function() {
        const id        = $(this).data("id")
        const email     = $(this).data("email")
        const name      = $(this).data("name")
        const tglJatuh  = $(this).data("tgljatuh")
        $('#mdlEmail_name').html(name)
        $('#mdlEmail_id').val(id)
        $('#mdlEmail_email').val(email)
        $('#mdlEmail_tglJatuh').val(tglJatuh)
    })
</script>