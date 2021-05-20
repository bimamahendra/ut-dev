<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Monitoring Debit Note</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Account Receivables</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6 col-md-6 mb-4 mr-0">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Total DN</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp. '.number_format($total,0,',','.') ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 mb-4 mr-0">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Total Received DN</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp. '.number_format($rcvtotal,0,',','.') ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 mb-4 mr-0">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                        Total Overdue DN</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp. '.number_format($ovdtotal,0,',','.') ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 mb-4 mr-0">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                        Total Overdue pass due 2 years</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 0</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Overdue %</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="overdueChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-secondary"></i> Overdue
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-warning"></i> Received
                                        </span>                                        
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-light"></i> Progress
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Achievement Payment Received</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="chart-pie pt-4 pb-2">
                                                <canvas id="sewaBangunanChart"></canvas>
                                            </div>
                                            <div class="mt-4 text-center small">
                                                <span class="mr-2">
                                                    <i class="fas fa-circle text-secondary"></i> Not yet
                                                </span>
                                                <span class="mr-2">
                                                    <i class="fas fa-circle text-warning"></i> Done
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="chart-pie pt-4 pb-2">
                                                <canvas id="utilityChart"></canvas>
                                            </div>
                                            <div class="mt-4 text-center small">
                                                <span class="mr-2">
                                                    <i class="fas fa-circle text-secondary"></i> Not yet
                                                </span>
                                                <span class="mr-2">
                                                    <i class="fas fa-circle text-warning"></i> Done
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Payment Received</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="chart-area mb-5 p-5">
                                                <canvas class="mb-5" id="myAreaChart"></canvas>
                                            </div>
                                        </div>
                                    </div><br>
                                    <hr class="invisible my-5 ">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive mt-5">
                                                <table class="table table-bordered" id="tableTransaction" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Tahun</th>
                                                            <th>Listrik</th>
                                                            <th>Rent</th>
                                                            <th>Service</th>
                                                            <th>Grand Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            $grandTotal = 0;
                                                            foreach($tahunan as $items){
                                                                echo'
                                                                    <tr>
                                                                        <td>'.$items->TAHUN.'</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>Rp. '.number_format($items->TOTAL,0,',','.').'</td>
                                                                    </tr>
                                                                ';
                                                                $grandTotal = $grandTotal + $items->TOTAL;
                                                            };
                                                        ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Grand Total</th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th><?= 'Rp. '.number_format($grandTotal,0,',','.') ?></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Detail Summary</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Monthly Detail</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="chart-area mb-5 p-5">
                                                <canvas class="mb-5" id="monthlyDetailChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="invisible my-5 ">
                                    <br><br>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive mt-5">
                                                <table class="table table-bordered" id="tableTransaction" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Jan</th>
                                                            <th>Feb</th>
                                                            <th>Mar</th>
                                                            <th>Apr</th>
                                                            <th>May</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>    
                                                            <td>DN Terbit</td>
                                                            <?php
                                                                $bulan = 1;
                                                                for($bulan = 1; $bulan <= 5; $bulan++){
                                                                    $html = '<td>Rp. 0</td>';
                                                                    foreach($monthly as $item){
                                                                        if($bulan == $item->BULAN){
                                                                            $html = '<td> Rp. '.number_format($item->TOTAL,0,',','.').'</td>';
                                                                            break;
                                                                        }
                                                                    }
                                                                    echo $html;
                                                                }
                                                            ?>
                                                        </tr>
                                                        <tr>
                                                            <td>Payment Received</td>
                                                            <?php
                                                                $bulan = 1;
                                                                for($bulan = 1; $bulan <= 5; $bulan++){
                                                                    $html = '<td>Rp. 0</td>';
                                                                    foreach($received as $item){
                                                                        if($bulan == $item->BULAN){
                                                                            $html = '<td> Rp. '.number_format($item->TOTAL,0,',','.').'</td>';
                                                                            break;
                                                                        }
                                                                    }
                                                                    echo $html;
                                                                }
                                                            ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-gray-800">DN Aging</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="chart-bar mb-5 p-5">
                                                <canvas class="mb-5" id="dnAgingChart"></canvas>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="chart-bar mb-5 p-5">
                                                <canvas class="mb-5" id="topTenantChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->