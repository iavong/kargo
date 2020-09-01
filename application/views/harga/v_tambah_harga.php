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
                    <?php echo form_open('harga/tambah'); ?>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Berat(Kg)</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('berat') ? 'form-control-danger' : null) ?>" name="berat" type="text" placeholder="1(Kg)" value="1" readonly>
                            <?php echo form_error('berat', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Kota Tujuan</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('kota') ? 'form-control-danger' : null) ?>" name="kota" placeholder="Kota tujuan..." type="text">
                            <?php echo form_error('kota', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biaya</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('biaya') ? 'form-control-danger' : null) ?>" name="biaya" type="text" placeholder="Cth:10000">
                            <?php echo form_error('biaya', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 col-md-10 offset-md-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('harga'); ?>" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                    <?php echo form_close(); ?>


                </div>
            </div>



        </div>



        <?php $this->load->view('layout/partials/_footer'); ?>


    </div>
</div>