<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

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
                    <input type="hidden" name="id" value="<?= $pengirimhutang->id; ?>" hidden>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nama Pengirim</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('nama') ? 'form-control-danger' : null) ?>" name="nama" type="text" placeholder="Nama pengirim.." value="<?= $pengirimhutang->nama; ?>">
                            <?php echo form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No. HP</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('hp') ? 'form-control-danger' : null) ?>" name="hp" placeholder="Cth:089988887777" type="text" value="<?= $pengirimhutang->no_hp; ?>">
                            <?php echo form_error('hp', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Alamat</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('alamat') ? 'form-control-danger' : null) ?>" name="alamat" placeholder="Alamat.." type="text" value="<?= $pengirimhutang->alamat; ?>">
                            <?php echo form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Hutang</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('deposit') ? 'form-control-danger' : null) ?>" name="deposit" placeholder="Deposit.." type="text" value="<?= $pengirimhutang->deposit; ?>" readonly>
                            <?php echo form_error('deposit', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 col-md-10 offset-md-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('pengirim-hutang'); ?>" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                    <?php echo form_close(); ?>


                </div>
            </div>



        </div>



        <?php $this->load->view('layout/partials/_footer'); ?>


    </div>
</div>