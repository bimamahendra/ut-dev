<div class="bg-image-ut">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center min-vh-100">
            <div class="d-flex flex-column justify-content-center order-2 order-md-1 mt-6">
                <img src="<?= base_url('assets/img/landing/qr_app.png') ?>" width="150" alt="QR Code App">
                <h4 class="text-white my-3">Install Android App</h4>
                <a class="btn btn-warning my-2 my-sm-0" href="<?= site_url('register'); ?>">Register</a>
                <h5 class="text-white">&copy; United Tractors</h5>
            </div>
            <img class="mb-4 mt-5 mt-md-0 order-1 order-md-2" src="<?= base_url('assets/img/landing/app_splash.png') ?>" width="250" alt="Splash App">
        </div>
    </div>
</div>

<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>