<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <?php $this->load->view('partials/_flash'); ?>

            <div class="pd-20 bg-white border-radius-4 box-shadow mb-20">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4"><?= $title; ?></h4>
                        <!-- <p>Add class <code>.table</code></p> -->
                    </div>
                </div>
                <hr>


                <div class="pb-20">

                    <!-- Form -->
                    <?php echo form_open(); ?>
                    <input type="hidden" name="id" value="<?= $user->id; ?>" hidden>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nama</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('nama') ? 'form-control-danger' : null) ?>" name="nama" type="text" placeholder="Nama lengkap.." value="<?= $user->nama; ?>">
                            <?php echo form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Username</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('username') ? 'form-control-danger' : null) ?>" name="username" placeholder="Username..." type="text" value="<?= $user->username; ?>">
                            <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Password</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('password') ? 'form-control-danger' : null) ?>" name="password" placeholder="Password..." type="password" autocomplete="new-password">
                            <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('passconf') ? 'form-control-danger' : null) ?>" name="passconf" placeholder="Konfirmasi password..." type="password">
                            <?php echo form_error('passconf', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 col-md-10 offset-md-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('user'); ?>" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                    <?php echo form_close(); ?>


                </div>
            </div>



        </div>



        <?php $this->load->view('layout/partials/_footer'); ?>


    </div>
</div>