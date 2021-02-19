<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="opacity: 1;position:absolute;right:0;z-index:1;" data-delay="2000">
        <div class="toast-header text-success">
            <i data-feather="bell"></i>
            <strong class="mr-auto">Success</strong>
            <small class="text-muted ml-2">just now</small>
            <button class="ml-2 mb-1 close" type="button" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="toast-body">Data berhsil disimpan.</div>
    </div> -->
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
                            <th>Login</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            foreach($listData as $item){
                                echo '
                                    <tr>
                                        <td>'.$item->NAMA_USERS.'</td>
                                        <td>'.$item->ROLE_USERS.'</td>
                                        <td>'.$item->DEPT_USERS.'</td>
                                        <td>'.$item->DIV_USERS.'</td>
                                        <td>'.$item->USER_USERS.'</td>
                                        <td style="text-align: center;">'.$item->LOGIN_USERS.'</td>
                                        <td>
                                            <a href="'.site_url("user/edit/".$item->ID_USERS).'" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" data-toggle="modal" data-id="'.$item->ID_USERS.'" data-name="'.$item->NAMA_USERS.'" data-target="#rstPassUserItem" class="btn btn-secondary btn-sm mdlRstPassUserItem">
                                                <i class="fa fa-key"></i>
                                            </button>
                                            <button type="button" data-toggle="modal" data-id="'.$item->ID_USERS.'" data-name="'.$item->NAMA_USERS.'" data-target="#deleteUserItem" class="btn btn-danger btn-sm mdlDelete">
                                                <i class="fa fa-trash"></i>
                                            </button>
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

<!-- Custom Javascript -->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script>
    $(document).ready(function(){
        // $('.toast').toast('show')
        <?php
            if(empty($notif)){
                echo "$('.toast').toast('show')";
            }
        ?>
    })
    $('#tableUser tbody').on('click', '.mdlDelete', function(){
        const id    = $(this).data('id')
        const name  = $(this).data('name')
        $('#mdlDelete_item').html(name)
        $('#mdlDelete_itemId').val(id)
    })
    $('#tableUser tbody').on('click', '.mdlRstPassUserItem', function(){
        const id    = $(this).data('id')
        const name  = $(this).data('name')
        $('#mdlRstPassUserItem_item').html(name)
        $('#mdlRstPassUserItem_itemId').val(id)

    })
</script>
<!-- End Custom Javascript -->