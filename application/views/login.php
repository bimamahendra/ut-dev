<div class="container min-vh-100 pt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4 col-lg-4 offset-lg-4 align-self-center mt-5">
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-user"></i>
                    <img src="<?= base_url('assets/img/logo.png'); ?>" class="rounded mx-auto d-block" width="120">
                    <br>
                    <h2 class="card-title mb-3 d-flex justify-content-center align-items-center">Login</h2>
                    <form action="<?= site_url('login') ?>" method="post">
                        <div class="mb-3">
                            <label for="inputUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="inputUsername" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword" placeholder="Password" required>
                        </div>
                        <div>
                            <button class="btn btn-warning btn-block" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>