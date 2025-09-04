<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center mt-2">
    <div class="col-md-7 col-lg-6">
        

        <?php if (session()->getFlashdata('register_error')): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?= esc(session()->getFlashdata('register_error')) ?>
            </div>
        <?php endif; ?>

        
                <form action="<?= base_url('register') ?>" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label text-white">NAME</label>
                        <input type="text" class="form-control bg-dark text-white border-secondary" 
                               id="name" name="name" required value="<?= esc(old('name')) ?>">
                    </div>
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
                    <div class="mb-3">
                        <label for="password_confirm" class="form-label text-white">CONFIRM PASSWORD</label>
                        <input type="password" class="form-control bg-dark text-white border-secondary" 
                               id="password_confirm" name="password_confirm" required>
                    </div>
                    <button type="submit" 
                            class="btn w-100" 
                            style="background:#c0c0c0; color:#fff; border-radius:50px; font-weight:500; transition:0.3s;">
                        CONFIRM
                    </button>
                </form>

               
                <div class="text-center mt-3">
                    <p class="mb-0 text-white">
                        you have account? 
                        <a href="<?= base_url('login') ?>" style="color:#ffffff;">LOG IN HERE</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
