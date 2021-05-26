<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; United Tractors</span>
            <?php
            $cReceived = 0;
            $cOverdue = 0;
            if (!empty($rcvtotal)) {
                $cReceived = (int) ($rcvtotal / $total * 100);
            };
            if (!empty($rcvtotal)) {
                $cOverdue = (int) ($ovdtotal / $total * 100);
            };

            $cRentCharge = 0;
            $cRentOverdue = 0;
            if (!empty($rentCharge)) {
                $cRentCharge = (int) ($rentCharge / ($rentCharge + $rentOverdue) * 100);
            };
            if (!empty($rentOverdue)) {
                $cRentOverdue = (int) ($rentOverdue / ($rentCharge + $rentOverdue) * 100);
            };

            $cUtilCharge = 0;
            $cUtilOverdue = 0;
            if (!empty($utilCharge)) {
                $cUtilCharge = (int) ($utilCharge / ($utilCharge + $utilOverdue) * 100);
            };
            if (!empty($utilOverdue)) {
                $cUtilOverdue = (int) ($utilOverdue / ($utilCharge + $utilOverdue) * 100);
            };

            if (!empty($tahunan2020)) {
                $t2020 = "2020";
                $tahunan2020Total[0] = 0;
                $tahunan2020Total[1] = 0;
                $tahunan2020Total[2] = 0;
                foreach ($tahunan2020 as $items) {
                    if ($items->TIPE == 'Listrik') {
                        $tahunan2020Total[0] = $items->TOTAL;
                    };
                    if ($items->TIPE == 'Rent') {
                        $tahunan2020Total[1] = $items->TOTAL;
                    };
                    if ($items->TIPE == 'Service') {
                        $tahunan2020Total[2] = $items->TOTAL;
                    };
                };
            };

            if (!empty($tahunan)) {
                $t2021 = "2021";
                $tahunan2021Total[0] = 0;
                $tahunan2021Total[1] = 0;
                $tahunan2021Total[2] = 0;
                foreach ($tahunan as $items) {
                    if ($items->TIPE == 'Listrik') {
                        $tahunan2021Total[0] = $items->TOTAL;
                    };
                    if ($items->TIPE == 'Rent') {
                        $tahunan2021Total[1] = $items->TOTAL;
                    };
                    if ($items->TIPE == 'Service') {
                        $tahunan2021Total[2] = $items->TOTAL;
                    };
                };
            };

            if (!empty($tahunan2022)) {
                $t2022 = "2022";
                $tahunan2022Total[0] = 0;
                $tahunan2022Total[1] = 0;
                $tahunan2022Total[2] = 0;
                foreach ($tahunan2022 as $items) {
                    if ($items->TIPE == 'Listrik') {
                        $tahunan2022Total[0] = $items->TOTAL;
                    };
                    if ($items->TIPE == 'Rent') {
                        $tahunan2022Total[1] = $items->TOTAL;
                    };
                    if ($items->TIPE == 'Service') {
                        $tahunan2022Total[2] = $items->TOTAL;
                    };
                };
            };

            if (!empty($tahunan2023)) {
                $t2023 = "2023";
                $tahunan2023Total[0] = 0;
                $tahunan2023Total[1] = 0;
                $tahunan2023Total[2] = 0;
                foreach ($tahunan2023 as $items) {
                    if ($items->TIPE == 'Listrik') {
                        $tahunan2023Total[0] = $items->TOTAL;
                    };
                    if ($items->TIPE == 'Rent') {
                        $tahunan2023Total[1] = $items->TOTAL;
                    };
                    if ($items->TIPE == 'Service') {
                        $tahunan2023Total[2] = $items->TOTAL;
                    };
                };
            };

            if (!empty($tahunan2024)) {
                $t2024 = "2024";
                $tahunan2024Total[0] = 0;
                $tahunan2024Total[1] = 0;
                $tahunan2024Total[2] = 0;
                foreach ($tahunan2024 as $items) {
                    if ($items->TIPE == 'Listrik') {
                        $tahunan2024Total[0] = $items->TOTAL;
                    };
                    if ($items->TIPE == 'Rent') {
                        $tahunan2024Total[1] = $items->TOTAL;
                    };
                    if ($items->TIPE == 'Service') {
                        $tahunan2024Total[2] = $items->TOTAL;
                    };
                };
            };

            if (!empty($tahunan2025)) {
                $t2025 = "2025";
                $tahunan2025Total[0] = 0;
                $tahunan2025Total[1] = 0;
                $tahunan2025Total[2] = 0;
                foreach ($tahunan2025 as $items) {
                    if ($items->TIPE == 'Listrik') {
                        $tahunan2025Total[0] = $items->TOTAL;
                    };
                    if ($items->TIPE == 'Rent') {
                        $tahunan2025Total[1] = $items->TOTAL;
                    };
                    if ($items->TIPE == 'Service') {
                        $tahunan2025Total[2] = $items->TOTAL;
                    };
                };
            };

            $receivedData = [];
            foreach ($received as $items) {
                $receivedData[] = (int) $items->TOTAL;
            };
            $receivedData = json_encode($receivedData);

            $terbitData = [];
            foreach ($monthly as $items) {
                $terbitData[] = (int) $items->TOTAL;
            };
            $terbitData = json_encode($terbitData);

            $topTenantsData = [];
            foreach ($topTenants as $items) {
                $topTenantsData[] = (int) $items->TOTAL;
            };
            $topTenantsData = json_encode($topTenantsData);

            $topTenantsLabel = [];
            foreach ($topTenants as $items) {
                $topTenantsLabel[] = $items->NAMAPERUSAHAAN_DEBITNOTE;
            };
            $topTenantsLabel = json_encode($topTenantsLabel);

            $cAgingEnam = 0;
            $cAgingTiga = 0;
            if (!empty($agingEnam)) {
                $cAgingEnam = $agingEnam;
            };
            if (!empty($agingTiga)) {
                $cAgingTiga = $agingTiga;
            };
            ?>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= site_url('logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/vendor/chart.js/Chart.min.js'); ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/js/demo/chart-area-demo.js'); ?>"></script>
<script src="<?= base_url('assets/js/demo/chart-pie-demo.js'); ?>"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/js/demo/datatables.js'); ?>"></script>
<script src="<?= base_url('assets/js/app.js'); ?>"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('29bc2e8a44dd757e9b8b', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        xhr = $.ajax({
            method: 'POST',
            url: "<?= site_url('notif/debitnote') ?>",
            success: function(response) {
                $('.notifs').html(response);
            }
        })
    });
    $('.notifs').on('click', '.notifikasi', function(e) {
        console.log("Clicked");
    });


    var overdueChart = document.getElementById("overdueChart");
    var overdue = new Chart(overdueChart, {
        type: 'pie',
        data: {
            labels: ["Overdue", "Received"],
            datasets: [{
                data: [<?= $cOverdue ?>, <?= $cReceived ?>],
                backgroundColor: ['rgba(237, 42, 33, 1)', 'rgba(49, 176, 87, 1)'],
                hoverBackgroundColor: ['rgba(237, 42, 33, 1)', 'rgba(49, 176, 87, 1)'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            }
        },
    });

    var sewaBangunanChart = document.getElementById("sewaBangunanChart");
    var sewaBangunan = new Chart(sewaBangunanChart, {
        type: 'pie',
        data: {
            labels: ["Not yet", "Done"],
            datasets: [{
                data: [<?= $cRentOverdue ?>, <?= $cRentCharge ?>],
                backgroundColor: ['rgba(229, 42, 51, 1)', 'rgba(49, 176, 87, 1)'],
                hoverBackgroundColor: ['rgba(229, 42, 51, 1)', 'rgba(49, 176, 87, 1)'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Sewa Bangunan'
            }
        },
    });

    var utilityChart = document.getElementById("utilityChart");
    var utility = new Chart(utilityChart, {
        type: 'pie',
        data: {
            labels: ["Not yet", "Done"],
            datasets: [{
                data: [<?= $cUtilOverdue ?>, <?= $cUtilCharge ?>],
                backgroundColor: ['rgba(229, 42, 51, 1)', 'rgba(56, 139, 242, 1)'],
                hoverBackgroundColor: ['rgba(229, 42, 51, 1)', 'rgba(56, 139, 242, 1)'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 0,
            },
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Utilty'
            }
        },
    });

    var othersChart = document.getElementById("othersChart");
    var others = new Chart(othersChart, {
        type: 'pie',
        data: {
            labels: ["Not yet", "Done"],
            datasets: [{
                data: [<?= $cUtilOverdue ?>, <?= $cUtilCharge ?>],
                backgroundColor: ['rgba(229, 42, 51, 1)', 'rgba(252, 131, 56, 1)'],
                hoverBackgroundColor: ['rgba(229, 42, 51, 1)', 'rgba(252, 131, 56, 1)'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 0,
            },
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Others'
            }
        },
    });

    var monthlyDetailChart = document.getElementById("monthlyDetailChart");
    var monthlyDetail = new Chart(monthlyDetailChart, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May"],
            datasets: [{
                label: 'DN Terbit',
                data: <?= $terbitData ?>,
                backgroundColor: 'rgba(211, 84, 0,1.0)',
                borderColor: 'rgba(211, 84, 0,1.0)',
                borderWidth: 1
            }, {
                label: 'Payment Received',
                data: <?= $receivedData ?>,
                backgroundColor: 'rgba(241, 196, 15,1.0)',
                borderColor: 'rgba(241, 196, 15,1.0)',
                borderWidth: 1
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });

    var topTenantChart = document.getElementById("topTenantChart");
    var topTenant = new Chart(topTenantChart, {
        type: 'bar',
        data: {
            labels: <?= $topTenantsLabel ?>,
            datasets: [{
                label: 'Total',
                data: <?= $topTenantsData ?>,
                backgroundColor: 'rgba(41, 128, 185,1.0)',
                borderColor: 'rgba(41, 128, 185,1.0)',
                borderWidth: 1
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    min: 0
                }
            },
            title: {
                display: true,
                text: 'Top Tenants'
            }
        }
    });

    var dnAgingChart = document.getElementById("dnAgingChart");
    var dnAging = new Chart(dnAgingChart, {
        type: 'bar',
        data: {
            labels: ["<30 Hari", "30-60 Hari", ">60 Hari"],
            datasets: [{
                label: 'Total',
                data: [<?= $cAgingTiga ?>, 55, <?= $cAgingEnam ?>],
                backgroundColor: 'rgba(41, 128, 185,1.0)',
                borderColor: 'rgba(41, 128, 185,1.0)',
                borderWidth: 1
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        min: 0
                    }
                }]
            },
            title: {
                display: true,
                text: 'DN Aging'
            }
        }
    });

    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php if (!empty($tahunan2020)) {
                    echo $t2020 . ',';
                }; ?>
                <?php if (!empty($tahunan)) {
                    echo $t2021 . ',';
                }; ?>
                <?php if (!empty($tahunan2022)) {
                    echo $t2022 . ',';
                }; ?>
                <?php if (!empty($tahunan2023)) {
                    echo $t2023 . ',';
                }; ?>
                <?php if (!empty($tahunan2024)) {
                    echo $t2024 . ',';
                }; ?>
                <?php if (!empty($tahunan2025)) {
                    echo $t2025 . ',';
                }; ?>
            ],
            datasets: [{
                label: 'Listrik',
                data: [
                    <?php if (!empty($tahunan2020)) {
                        echo $tahunan2020Total[0] . ',';
                    } ?>
                    <?php if (!empty($tahunan)) {
                        echo $tahunan2021Total[0] . ',';
                    } ?>
                    <?php if (!empty($tahunan2022)) {
                        echo $tahunan2022Total[0] . ',';
                    } ?>
                    <?php if (!empty($tahunan2023)) {
                        echo $tahunan2023Total[0] . ',';
                    } ?>
                    <?php if (!empty($tahunan2024)) {
                        echo $tahunan2024Total[0] . ',';
                    } ?>
                    <?php if (!empty($tahunan2025)) {
                        echo $tahunan2025Total[0] . ',';
                    } ?>
                ],
                backgroundColor: 'rgba(41, 128, 185,1.0)',
                borderColor: 'rgba(41, 128, 185,1.0)',
                borderWidth: 1
            }, {
                label: 'Rent',
                data: [
                    <?php if (!empty($tahunan2020)) {
                        echo $tahunan2020Total[1] . ',';
                    } ?>
                    <?php if (!empty($tahunan)) {
                        echo $tahunan2021Total[1] . ',';
                    } ?>
                    <?php if (!empty($tahunan2022)) {
                        echo $tahunan2022Total[1] . ',';
                    } ?>
                    <?php if (!empty($tahunan2023)) {
                        echo $tahunan2023Total[1] . ',';
                    } ?>
                    <?php if (!empty($tahunan2024)) {
                        echo $tahunan2024Total[1] . ',';
                    } ?>
                    <?php if (!empty($tahunan2025)) {
                        echo $tahunan2025Total[1] . ',';
                    } ?>
                ],
                backgroundColor: 'rgba(230, 126, 34,1.0)',
                borderColor: 'rgba(230, 126, 34,1.0)',
                borderWidth: 1
            }, {
                label: 'Service',
                data: [
                    <?php if (!empty($tahunan2020)) {
                        echo $tahunan2020Total[2] . ',';
                    } ?>
                    <?php if (!empty($tahunan)) {
                        echo $tahunan2021Total[2] . ',';
                    } ?>
                    <?php if (!empty($tahunan2022)) {
                        echo $tahunan2022Total[2] . ',';
                    } ?>
                    <?php if (!empty($tahunan2023)) {
                        echo $tahunan2023Total[2] . ',';
                    } ?>
                    <?php if (!empty($tahunan2024)) {
                        echo $tahunan2024Total[2] . ',';
                    } ?>
                    <?php if (!empty($tahunan2025)) {
                        echo $tahunan2025Total[2] . ',';
                    } ?>
                ],
                backgroundColor: 'rgba(127, 140, 141,1.0)',
                borderColor: 'rgba(127, 140, 141,1.0)',
                borderWidth: 1
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
</script>
</body>

</html>