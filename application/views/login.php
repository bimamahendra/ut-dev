<div style="background: url('<?= base_url('assets/img/bg/bg_regist.png'); ?>') no-repeat center; background-size: cover; overflow-x: hidden;">
    <div class="container">
        <div class="d-flex flex-row justify-content-center justify-content-md-end align-items-center min-vh-100">
            <div class="card p-3" style="min-width: 370px;">
                <div class="card-body">
                    <h2 class="card-title mb-3">Login</h2>
                    <form action="<?= site_url('login') ?>" method="post">
                        <div class="form-group">
                            <label for="inputUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="inputUsername" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-warning btn-block" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>