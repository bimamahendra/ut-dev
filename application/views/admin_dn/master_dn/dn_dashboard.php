<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Monitoring Debit Note</h1>
        <button class="btn btn-warning" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" id="btnCollapse">Hide All</button>
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
                                            $cReceived = (float) ($rcvtotal / $total * 100);
                                            $cReceived = round($cReceived, 0);
                                        };

                                        echo $cReceived . '%';
                                        ?></h6>
                                </a>
                                <!-- Card Body -->
                                <div class="collapse multi-collapse show" id="collapseReceivedOverdue">
                                    <div class="card-body">
                                        <div class="chart-pie pt-4 pb-2 mb-5">
                                            <canvas id="overdueChart"></canvas>
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
                                <div class="collapse multi-collapse show" id="collapseAchievementPaymentReceived">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <div class="chart-pie pt-4 pb-2 mb-5">
                                                    <canvas id="sewaBangunanChart"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="chart-pie pt-4 pb-2 mb-5">
                                                    <canvas id="utilityChart"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="chart-pie pt-4 pb-2 mb-5">
                                                    <canvas id="othersChart"></canvas>
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
                                <div class="collapse multi-collapse show" id="collapsePaymentReceived">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2">
                                                <select class="custom-select" id="pilYear">
                                                    <?php
                                                    foreach ($year_list as $items) {
                                                        echo '<option value="' . $items->YEAR . '">' . $items->YEAR . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="chart-area mb-5 p-5">
                                                    <div class="mb-5" id="paymentRecGraph">
                                                        <!-- Bar Graph Goes Here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br><br>
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
                                                                <th>Air</th>
                                                                <th>Telefon</th>
                                                                <th>Others</th>
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
                                                                $air = 0;
                                                                $telefon = 0;
                                                                $others = 0;
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
                                                                    if ($items->TIPE == 'Air') {
                                                                        $air = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Telefon') {
                                                                        $telefon = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Others') {
                                                                        $others = $items->TOTAL;
                                                                    };
                                                                    $grandTotal = $grandTotal + $items->TOTAL;
                                                                }
                                                                echo '
                                                                    <tr>
                                                                        <td>' . $tahun . '</td>
                                                                        <td>Rp. ' . number_format($listrik, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($rent, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($service, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($air, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($telefon, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($others, 0, ',', '.') . '</td>
                                                                        <td>Rp. ' . number_format($grandTotal, 0, ',', '.') . '</td>
                                                                    </tr>
                                                                ';
                                                            };

                                                            if (!empty($tahunan)) {
                                                                $tahun = "";
                                                                $listrik = 0;
                                                                $rent = 0;
                                                                $service = 0;
                                                                $air = 0;
                                                                $telefon = 0;
                                                                $others = 0;
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
                                                                    if ($items->TIPE == 'Air') {
                                                                        $air = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Telefon') {
                                                                        $telefon = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Others') {
                                                                        $others = $items->TOTAL;
                                                                    };
                                                                    $grandTotal = $grandTotal + $items->TOTAL;
                                                                }
                                                                echo '
                                                                <tr>
                                                                    <td>' . $tahun . '</td>
                                                                    <td>Rp. ' . number_format($listrik, 0, ',', '.') . '</td>
                                                                    <td>Rp. ' . number_format($rent, 0, ',', '.') . '</td>
                                                                    <td>Rp. ' . number_format($service, 0, ',', '.') . '</td>
                                                                    <td>Rp. ' . number_format($air, 0, ',', '.') . '</td>
                                                                    <td>Rp. ' . number_format($telefon, 0, ',', '.') . '</td>
                                                                    <td>Rp. ' . number_format($others, 0, ',', '.') . '</td>
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
                                                                $air = 0;
                                                                $telefon = 0;
                                                                $others = 0;
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
                                                                    if ($items->TIPE == 'Air') {
                                                                        $air = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Telefon') {
                                                                        $telefon = $items->TOTAL;
                                                                    };
                                                                    if ($items->TIPE == 'Others') {
                                                                        $others = $items->TOTAL;
                                                                    };
                                                                    $grandTotal = $grandTotal + $items->TOTAL;
                                                                }
                                                                ?>
                                                                <th>Grand Total</th>
                                                                <th><?= 'Rp. ' . number_format($listrik, 0, ',', '.') ?></th>
                                                                <th><?= 'Rp. ' . number_format($rent, 0, ',', '.') ?></th>
                                                                <th><?= 'Rp. ' . number_format($service, 0, ',', '.') ?></th>
                                                                <th><?= 'Rp. ' . number_format($air, 0, ',', '.') ?></th>
                                                                <th><?= 'Rp. ' . number_format($telefon, 0, ',', '.') ?></th>
                                                                <th><?= 'Rp. ' . number_format($others, 0, ',', '.') ?></th>
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
                                <div class="collapse multi-collapse show" id="collapseMonthlyDetail">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="chart-area mb-5 p-5">
                                                    <div class="mb-5" id="divGraph">
                                                        <!-- Bar Graph Goes Here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="invisible my-5 ">
                                        <br><br>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mt-5">
                                                    <table class="table table-bordered" id="tabelBulanan" width="100%" cellspacing="0">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Jan</th>
                                                                <th>Feb</th>
                                                                <th>Mar</th>
                                                                <th>Apr</th>
                                                                <th>May</th>
                                                                <th>Jun</th>
                                                                <th>Juli</th>
                                                                <th>Aug</th>
                                                                <th>Sep</th>
                                                                <th>Oct</th>
                                                                <th>Nov</th>
                                                                <th>Des</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
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
                                <div class="collapse multi-collapse show" id="collapseDNAging">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8 mx-auto">
                                                <div class="chart-bar">
                                                    <canvas class="mb-5" id="dnAgingChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-8 mx-auto">
                                                <div class="chart-bar">
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
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "<?= site_url('debitnote/monthlyDNChart') ?>",
                type: "post",
                success: function(bar_graph) {
                    $("#divGraph").html(bar_graph);
                    var monGraphData = JSON.parse($("#graph").data("settings"));
                    $("#graph").chart = new Chart($("#graph"), {
                        type: "bar",
                        data: monGraphData,
                        options: {
                            legend: {
                                display: true
                            },
                            tooltips: {
                                mode: 'label',
                                label: 'mylabel',
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        var label = data.datasets[tooltipItem.datasetIndex].label || '';

                                        if (label) {
                                            label += ': ';
                                        }
                                        label += tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                        return label;
                                    }
                                }
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        callback: function(label, index, labels) {
                                            return label.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                        },
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            });

            $("#pilYear").change(function() {
                $.ajax({
                    url: "<?= site_url('debitnote/monthlyDNChart') ?>",
                    type: "post",
                    data: {
                        year: $(this).val()
                    },
                    success: function(bar_graph) {
                        $("#divGraph").html(bar_graph);
                        var monGraphData = JSON.parse($("#graph").data("settings"));
                        $("#graph").chart = new Chart($("#graph"), {
                            type: "bar",
                            data: monGraphData,
                            options: {
                                legend: {
                                    display: true
                                },
                                tooltips: {
                                    mode: 'label',
                                    label: 'mylabel',
                                    callbacks: {
                                        label: function(tooltipItem, data) {
                                            var label = data.datasets[tooltipItem.datasetIndex].label || '';

                                            if (label) {
                                                label += ': ';
                                            }
                                            label += tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                            return label;
                                        }
                                    }
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            callback: function(label, index, labels) {
                                                return label.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                            },
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    }
                });
            });

            $.ajax({
                url: "<?= site_url('debitnote/paymentDNChart') ?>",
                type: "post",
                success: function(pay_graph) {
                    $("#paymentRecGraph").html(pay_graph);
                    var graphData = JSON.parse($("#payGraph").data("settings"));
                    $("#payGraph").chart = new Chart($("#payGraph"), {
                        type: "bar",
                        data: graphData,
                        options: {
                            legend: {
                                display: true
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        var label = data.datasets[tooltipItem.datasetIndex].label || '';

                                        if (label) {
                                            label += ': ';
                                        }
                                        label += tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                        return label;
                                    }
                                }
                            },
                            scales: {
                                xAxes: [{
                                    stacked: true
                                }],
                                yAxes: [{
                                    stacked: true,
                                    ticks: {
                                        callback: function(label, index, labels) {
                                            return label.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                        },
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            });

            $("#pilYear").change(function() {
                $.ajax({
                    url: "<?= site_url('debitnote/paymentDNChart') ?>",
                    type: "post",
                    data: {
                        year: $(this).val()
                    },
                    success: function(pay_graph) {
                        $("#paymentRecGraph").html(pay_graph);
                        var graphData = JSON.parse($("#payGraph").data("settings"));
                        $("#payGraph").chart = new Chart($("#payGraph"), {
                            type: "bar",
                            data: graphData,
                            options: {
                                legend: {
                                    display: true
                                },
                                tooltips: {
                                    callbacks: {
                                        label: function(tooltipItem, data) {
                                            var label = data.datasets[tooltipItem.datasetIndex].label || '';

                                            if (label) {
                                                label += ': ';
                                            }
                                            label += tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                            return label;
                                        }
                                    }
                                },
                                scales: {
                                    xAxes: [{
                                        stacked: true
                                    }],
                                    yAxes: [{
                                        stacked: true,
                                        ticks: {
                                            callback: function(label, index, labels) {
                                                return label.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                            },
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    }
                });
            });

            var table;

            table = $('#tabelBulanan').DataTable({
                "ajax": {
                    "url": '<?= site_url('debitnote/monthlyTable') ?>'
                },
                "aoColumns": [{
                        sWidth: '7%'
                    },
                    {
                        sWidth: '7%'
                    },
                    {
                        sWidth: '7%'
                    },
                    {
                        sWidth: '7%'
                    },
                    {
                        sWidth: '7%'
                    },
                    {
                        sWidth: '7%'
                    },
                    {
                        sWidth: '7%'
                    },
                    {
                        sWidth: '7%'
                    },
                    {
                        sWidth: '7%'
                    },
                    {
                        sWidth: '7%'
                    },
                    {
                        sWidth: '7%'
                    },
                    {
                        sWidth: '7%'
                    },
                    {
                        sWidth: '7%'
                    }
                ],
                "sScrollX": "100%",
                "sScrollXInner": "210%"
            });

            $("#pilYear").change(function() {
                table.destroy();
                table = $('#tabelBulanan').DataTable({
                    "ajax": {
                        "url": '<?= site_url('debitnote/monthlyTable') ?>',
                        "type": "POST",
                        "data": {
                            year: $(this).val()
                        }
                    },
                    "aoColumns": [{
                            sWidth: '7%'
                        },
                        {
                            sWidth: '7%'
                        },
                        {
                            sWidth: '7%'
                        },
                        {
                            sWidth: '7%'
                        },
                        {
                            sWidth: '7%'
                        },
                        {
                            sWidth: '7%'
                        },
                        {
                            sWidth: '7%'
                        },
                        {
                            sWidth: '7%'
                        },
                        {
                            sWidth: '7%'
                        },
                        {
                            sWidth: '7%'
                        },
                        {
                            sWidth: '7%'
                        },
                        {
                            sWidth: '7%'
                        },
                        {
                            sWidth: '7%'
                        }
                    ],
                    "sScrollX": "100%",
                    "sScrollXInner": "210%"
                });
                reload_table();
            });

            function reload_table() {
                table.ajax.reload(null, false);
            }

            $("#btnCollapse").click(function() {
                if ($(this).hasClass("collapsed"))
                    $(this).text("Hide All");
                else
                    $(this).text("Show All");
            });
        });
    </script>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->