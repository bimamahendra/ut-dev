<div class="bg-image-ut">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-start justify-content-md-between align-items-center min-vh-100">
            <div class="my-4">
                <img src="<?= base_url('assets/img/landing/motto_ut.png') ?>" width="300" alt="Motto UT">
                <h5 class="text-white mt-4">
                    The strength of the company <br>
                    lies on the quality of its products and services, <br>
                    the best solutions offered, and good <br>
                    relationship with customers.
                </h5>
            </div>
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