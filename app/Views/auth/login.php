<?= $this->include('home/template/header'); ?>

<section class="my-5">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="assets/img/login.png" class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form action="<?= base_url('resellerlogin'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="divider d-flex align-items-center my-4">
                        <h1 class="text-center fw-bold mb-0">SIGN IN</h1>
                    </div>
                    <?php if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-outline mb-4">
                        <input type="email" id="form3Example3" class="form-control form-control-lg <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" placeholder="Enter a valid email address" name="email" />
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                        <label class="form-label" for="form3Example3">Email address</label>
                    </div>
                    <div class="form-outline mb-2">
                        <input type="password" id="form3Example4" class="form-control form-control-lg <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" placeholder="Enter password" name="password" />
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                        <label class="form-label" for="form3Example4">Password</label>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="<?= base_url('forgetpassword-reseller'); ?>" class="text-body">Lupa password?</a>
                    </div>
                    <div class="text-center text-lg-start mt-1 pt-2">
                        <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->include('home/template/footer'); ?>