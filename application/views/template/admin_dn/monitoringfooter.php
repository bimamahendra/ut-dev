<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; United Tractors</span>
            <?php 
                $cReceived = (int) ($rcvtotal/$total*100);
                $cOverdue = (int) ($ovdtotal/$total*100);
                $cProgress = (int) (($total-$rcvtotal-$ovdtotal)/$total*100);
                
                $receivedData = [];
                foreach($received as $items) {
                    $receivedData[] = (int) $items->TOTAL;
                };
                $receivedData = json_encode($receivedData);

                $terbitData = [];
                foreach($monthly as $items) {
                    $terbitData[] = (int) $items->TOTAL;
                };
                $terbitData = json_encode($terbitData);
                var_dump($terbitData);
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
            labels: ["Overdue", "Received", "Progress"],
            datasets: [{
                data: [<?=$cOverdue?>,<?=$cReceived?>,<?=$cProgress?>],
                backgroundColor: ['#858796', '#f8b500'],
                hoverBackgroundColor: ['#858796', '#f8b500'],
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
</script>
</body>
</html>