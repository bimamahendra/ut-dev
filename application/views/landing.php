<div class="min-vh-100" style="background: url('<?= base_url('assets/img/bg/bg_landing.png'); ?>') no-repeat center; background-size: cover;">
    <div class="container">
    </div>
</div>

<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>