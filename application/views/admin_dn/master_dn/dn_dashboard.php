<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Monitoring Debit Note</h1>
        <button class="btn btn-warning" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false">Collapse</button>
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
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp. ' . number_format($total, 0, ',', '.') ?></div>
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
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp. ' . number_format($rcvtotal, 0, ',', '.') ?></div>
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
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp. ' . number_format($ovdtotal, 0, ',', '.') ?></div>
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
                                <a href="#collapseReceivedOverdue" class="card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseReceivedOverdue">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Received &amp; Overdue | 
                                    <?php
                                    $cReceived = 0;
                                    if (!empty($rcvtotal)) {
                                        $cReceived = (int) ($rcvtotal / $total * 100);
                                    };

                                    echo $cReceived.'%';
                                    ?></h6>
                                </a>
                                <!-- Card Body -->
                                <div class="collapse multi-collapse" id="collapseReceivedOverdue">
                                    <div class="card-body">
                                        <div class="chart-pie pt-4 pb-2">
                                            <canvas id="overdueChart"></canvas>
                                        </div>
                                        <div class="mt-4 text-center small">
                                            <span class="mr-2">
                                                <i class="fas fa-circle" style="color: rgba(237, 42, 33, 1);"></i> Overdue
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle" style="color: rgba(49, 176, 87, 1);"></i> Received
                                            </span>
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
                                <a href="#collapseAchievementPaymentReceived" class="card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseAchievementPaymentReceived">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Achievement Payment Received</h6>
                                </a>
                                <!-- Card Body -->
                                <div class="collapse multi-collapse" id="collapseAchievementPaymentReceived">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <div class="chart-pie pt-4 pb-2">
                                                    <canvas id="sewaBangunanChart"></canvas>
                                                </div>
                                                <div class="mt-4 text-center small">
                                                    <span class="mr-2">
                                                        <i class="fas fa-circle" style="color: rgba(229, 42, 51, 1);"></i> Not yet
                                                    </span>
                                                    <span class="mr-2">
                                                        <i class="fas fa-circle" style="color: rgba(49, 176, 87, 1);"></i> Done
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="chart-pie pt-4 pb-2">
                                                    <canvas id="utilityChart"></canvas>
                                                </div>
                                                <div class="mt-4 text-center small">
                                                    <span class="mr-2">
                                                        <i class="fas fa-circle" style="color: rgba(229, 42, 51, 1);"></i> Not yet
                                                    </span>
                                                    <span class="mr-2">
                                                        <i class="fas fa-circle" style="color: rgba(56, 139, 242, 1);"></i> Done
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="chart-pie pt-4 pb-2">
                                                    <canvas id="othersChart"></canvas>
                                                </div>
                                                <div class="mt-4 text-center small">
                                                    <span class="mr-2">
                                                        <i class="fas fa-circle" style="color: rgba(229, 42, 51, 1);"></i> Not yet
                                                    </span>
                                                    <span class="mr-2">
                                                        <i class="fas fa-circle" style="color: rgba(252, 131, 56, 1);"></i> Done
                                                    </span>
                                                </div>
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
                                <a href="#collapsePaymentReceived" class="card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapsePaymentReceived">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Payment Received</h6>
                                </a>
                                <!-- Card Body -->
                                <div class="collapse multi-collapse" id="collapsePaymentReceived">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="chart-area mb-5 p-5">
                                                    <canvas class="mb-5" id="paymentReceivedChart"></canvas>
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
                                                            if (!empty($tahunan2020)) {
                                                                $tahun = "";
                                                                $listrik = 0;
                                                                $rent = 0;
                                                                $service = 0;
                                                                $grandTotal = 0;
                                                                foreach ($tahunan2020 as $items) {
                                                                    $tahun = $items->TAHUN;
                                                                    if ($items->TIPE == 'Listrik') {
                                                                        $listrik = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Rent') {
                                                                        $rent = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Service') {
                                                                        $service = $items->TOTAL;
                                                                    };
                                                                    $grandTotal = $grandTotal + $items->TOTAL;
                                                                }
                                                                echo '
                                                                    <tr>
                                                                        <td>' . $tahun . '</td>
                                                                        <td>Rp. ' . number_format($listrik, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($rent, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($service, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($grandTotal, 0, ',', '.') . '</td>
                                                                    </tr>
                                                                ';
                                                            };

                                                            if (!empty($tahunan)) {
                                                                $tahun = "";
                                                                $listrik = 0;
                                                                $rent = 0;
                                                                $service = 0;
                                                                $grandTotal = 0;
                                                                foreach ($tahunan as $items) {
                                                                    $tahun = $items->TAHUN;
                                                                    if ($items->TIPE == 'Listrik') {
                                                                        $listrik = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Rent') {
                                                                        $rent = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Service') {
                                                                        $service = $items->TOTAL;
                                                                    };
                                                                    $grandTotal = $grandTotal + $items->TOTAL;
                                                                }
                                                                echo '
                                                                <tr>
                                                                    <td>' . $tahun . '</td>
                                                                    <td>Rp. ' . number_format($listrik, 0, ',', '.') . '</td>
                                                                    <td>Rp. ' . number_format($rent, 0, ',', '.') . '</td>
                                                                    <td>Rp. ' . number_format($service, 0, ',', '.') . '</td>
                                                                    <td>Rp. ' . number_format($grandTotal, 0, ',', '.') . '</td>
                                                                </tr>
                                                            ';
                                                            };

                                                            if (!empty($tahunan2022)) {
                                                                $tahun = "";
                                                                $listrik = 0;
                                                                $rent = 0;
                                                                $service = 0;
                                                                $grandTotal = 0;
                                                                foreach ($tahunan2022 as $items) {
                                                                    $tahun = $items->TAHUN;
                                                                    if ($items->TIPE == 'Listrik') {
                                                                        $listrik = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Rent') {
                                                                        $rent = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Service') {
                                                                        $service = $items->TOTAL;
                                                                    };
                                                                    $grandTotal = $grandTotal + $items->TOTAL;
                                                                }
                                                                echo '
                                                                    <tr>
                                                                        <td>' . $tahun . '</td>
                                                                        <td>Rp. ' . number_format($listrik, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($rent, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($service, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($grandTotal, 0, ',', '.') . '</td>
                                                                    </tr>
                                                                ';
                                                            };

                                                            if (!empty($tahunan2023)) {
                                                                $tahun = "";
                                                                $listrik = 0;
                                                                $rent = 0;
                                                                $service = 0;
                                                                $grandTotal = 0;
                                                                foreach ($tahunan2023 as $items) {
                                                                    $tahun = $items->TAHUN;
                                                                    if ($items->TIPE == 'Listrik') {
                                                                        $listrik = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Rent') {
                                                                        $rent = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Service') {
                                                                        $service = $items->TOTAL;
                                                                    };
                                                                    $grandTotal = $grandTotal + $items->TOTAL;
                                                                }
                                                                echo '
                                                                    <tr>
                                                                        <td>' . $tahun . '</td>
                                                                        <td>Rp. ' . number_format($listrik, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($rent, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($service, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($grandTotal, 0, ',', '.') . '</td>
                                                                    </tr>
                                                                ';
                                                            };

                                                            if (!empty($tahunan2024)) {
                                                                $tahun = "";
                                                                $listrik = 0;
                                                                $rent = 0;
                                                                $service = 0;
                                                                $grandTotal = 0;
                                                                foreach ($tahunan2024 as $items) {
                                                                    $tahun = $items->TAHUN;
                                                                    if ($items->TIPE == 'Listrik') {
                                                                        $listrik = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Rent') {
                                                                        $rent = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Service') {
                                                                        $service = $items->TOTAL;
                                                                    };
                                                                    $grandTotal = $grandTotal + $items->TOTAL;
                                                                }
                                                                echo '
                                                                    <tr>
                                                                        <td>' . $tahun . '</td>
                                                                        <td>Rp. ' . number_format($listrik, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($rent, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($service, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($grandTotal, 0, ',', '.') . '</td>
                                                                    </tr>
                                                                ';
                                                            };

                                                            if (!empty($tahunan2025)) {
                                                                $tahun = "";
                                                                $listrik = 0;
                                                                $rent = 0;
                                                                $service = 0;
                                                                $grandTotal = 0;
                                                                foreach ($tahunan2025 as $items) {
                                                                    $tahun = $items->TAHUN;
                                                                    if ($items->TIPE == 'Listrik') {
                                                                        $listrik = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Rent') {
                                                                        $rent = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Service') {
                                                                        $service = $items->TOTAL;
                                                                    };
                                                                    $grandTotal = $grandTotal + $items->TOTAL;
                                                                }
                                                                echo '
                                                                    <tr>
                                                                        <td>' . $tahun . '</td>
                                                                        <td>Rp. ' . number_format($listrik, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($rent, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($service, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($grandTotal, 0, ',', '.') . '</td>
                                                                    </tr>
                                                                ';
                                                            };
                                                            ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <?php
                                                                $grandTotal = 0;
                                                                $listrik = 0;
                                                                $rent = 0;
                                                                $service = 0;
                                                                foreach ($totalTahunan as $items) {
                                                                    if ($items->TIPE == 'Listrik') {
                                                                        $listrik = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Rent') {
                                                                        $rent = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Service') {
                                                                        $service = $items->TOTAL;
                                                                    };
                                                                    $grandTotal = $grandTotal + $items->TOTAL;
                                                                }
                                                                ?>
                                                                <th>Grand Total</th>
                                                                <th><?= 'Rp. ' . number_format($listrik, 0, ',', '.') ?></th>
                                                                <th><?= 'Rp. ' . number_format($rent, 0, ',', '.') ?></th>
                                                                <th><?= 'Rp. ' . number_format($service, 0, ',', '.') ?></th>
                                                                <th><?= 'Rp. ' . number_format($grandTotal, 0, ',', '.') ?></th>
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
                                <a href="#collapseMonthlyDetail" class="card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseMonthlyDetail">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Monthly Detail</h6>
                                </a>
                                <!-- Card Body -->
                                <div class="collapse multi-collapse" id="collapseMonthlyDetail">
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
                                                                for ($bulan = 1; $bulan <= 5; $bulan++) {
                                                                    $html = '<td>Rp. 0</td>';
                                                                    foreach ($monthly as $item) {
                                                                        if ($bulan == $item->BULAN) {
                                                                            $html = '<td> Rp. ' . number_format($item->TOTAL, 0, ',', '.') . '</td>';
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
                                                                for ($bulan = 1; $bulan <= 5; $bulan++) {
                                                                    $html = '<td>Rp. 0</td>';
                                                                    foreach ($received as $item) {
                                                                        if ($bulan == $item->BULAN) {
                                                                            $html = '<td> Rp. ' . number_format($item->TOTAL, 0, ',', '.') . '</td>';
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
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <a href="#collapseDNAging" class="card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseDNAging">
                                    <h6 class="m-0 font-weight-bold text-gray-800">DN Aging and Top Tenants</h6>
                                </a>
                                <!-- Card Body -->
                                <div class="collapse multi-collapse" id="collapseDNAging">
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

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->