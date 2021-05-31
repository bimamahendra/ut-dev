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

            $cOthersCharge = 0;
            $cOthersOverdue = 0;
            if (!empty($othersCharge)) {
                $cOthersCharge = (int) ($othersCharge / ($othersCharge + $othersOverdue) * 100);
            };
            if (!empty($othersOverdue)) {
                $cOthersOverdue = (int) ($othersOverdue / ($othersCharge + $othersOverdue) * 100);
            };  

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
            $cAgingTigaEnam = 0;
            $cAgingTiga = 0;
            if (!empty($agingEnam)) {
                $cAgingEnam = $agingEnam;
            };            
            if (!empty($agingTigaEnam)) {
                $cAgingTigaEnam = $agingTigaEnam;
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
            showAllTooltips: true,
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255, 255, 255)",
                bodyFontColor: "rgb(37, 40, 43)",
                borderColor: 'rgb(37, 40, 43)',
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
            showAllTooltips: true,
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255, 255, 255)",
                bodyFontColor: "rgb(37, 40, 43)",
                borderColor: "rgb(37, 40, 43)",
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
            showAllTooltips: true,
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255, 255, 255)",
                bodyFontColor: "rgb(37, 40, 43)",
                borderColor: "rgb(37, 40, 43)",
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
                data: [<?= $cOthersOverdue ?>, <?= $cOthersCharge ?>],
                backgroundColor: ['rgba(229, 42, 51, 1)', 'rgba(252, 131, 56, 1)'],
                hoverBackgroundColor: ['rgba(229, 42, 51, 1)', 'rgba(252, 131, 56, 1)'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            showAllTooltips: true,
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255, 255, 255)",
                bodyFontColor: "rgb(37, 40, 43)",
                borderColor: "rgb(37, 40, 43)",
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
                data: [<?= $cAgingTiga ?>, <?= $cAgingTigaEnam ?>, <?= $cAgingEnam ?>],
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

    Chart.pluginService.register({
        beforeRender: function(chart) {
            if (chart.config.options.showAllTooltips) {
                // create an array of tooltips
                // we can't use the chart tooltip because there is only one tooltip per chart
                chart.pluginTooltips = [];
                chart.config.data.datasets.forEach(function(dataset, i) {
                    chart.getDatasetMeta(i).data.forEach(function(sector, j) {
                        chart.pluginTooltips.push(new Chart.Tooltip({
                            _chart: chart.chart,
                            _chartInstance: chart,
                            _data: chart.data,
                            _options: chart.options.tooltips,
                            _active: [sector]
                        }, chart));
                    });
                });
                // turn off normal tooltips
                chart.options.tooltips.enabled = false;
            }
        },
        afterDraw: function(chart, easing) {
            if (chart.config.options.showAllTooltips) {
                // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
                if (!chart.allTooltipsOnce) {
                    if (easing !== 1)
                        return;
                    chart.allTooltipsOnce = true;
                }
                // turn on tooltips
                chart.options.tooltips.enabled = true;
                Chart.helpers.each(chart.pluginTooltips, function(tooltip) {
                    tooltip.initialize();
                    tooltip.update();
                    // we don't actually need this since we are not animating tooltips
                    tooltip.pivot();
                    tooltip.transition(easing).draw();
                });
                chart.options.tooltips.enabled = false;
            }
        }
    });
</script>
</body>

</html>