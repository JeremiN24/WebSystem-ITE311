<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center mt-2">
    <div class="col-md-6 col-lg-5">


        <?php if (session()->getFlashdata('register_success')): ?>
            <div class="alert alert-success text-center" role="alert">
                <?= esc(session()->getFlashdata('register_success')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('login_error')): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?= esc(session()->getFlashdata('login_error')) ?>
            </div>
        <?php endif; ?>

        
            <div class="card-body p-4">
                <form action="<?= base_url('login') ?>" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label text-white">EMAIL</label>
                        <input type="email" class="form-control bg-dark text-white border-secondary" 
                               id="email" name="email" required value="<?= esc(old('email')) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-white">PASSWORD</label>
                        <input type="password" class="form-control bg-dark text-white border-secondary" 
                               id="password" name="password" required>
                    </div>
                    <button type="submit" 
                            class="btn w-100" 
                            style="background:#c0c0c0; color:#fff; border-radius:50px; font-weight:500; transition:0.3s;">
                        LOGIN
                    </button>
                </form>
            </div>
        </div>

        <p class="text-center mt-3 text-white small">
            You don't have an account? 
            <a href="<?= base_url('register') ?>" style="color:#ffffff;">REGISTER</a>
        </p>
    </div>
</div>
<?= $this->endSection() ?>
