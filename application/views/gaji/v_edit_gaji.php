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
                    <?php echo form_open('gaji/edit/' . $gaji->id); ?>
                    <input type="hidden" name="id" value="<?= $gaji->id; ?>" hidden>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Nama</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('nama') ? 'form-control-danger' : null) ?>" name="nama" type="text" placeholder="Nama .." value="<?= $gaji->nama; ?>" required>
                            <?php echo form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Keterangan</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="keterangan" type="text" placeholder="Keterangannya apa .." value="<?= $gaji->keterangan; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Total Gaji</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control numeric <?= (form_error('total_gaji') ? 'form-control-danger' : null) ?>" name="total_gaji" type="text" placeholder="Total gaji .." value="<?= $gaji->total_gaji ?>" required>
                            <?php echo form_error('total_gaji', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 col-md-10 offset-md-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?= base_url('gaji'); ?>" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                    <?php echo form_close(); ?>


                </div>
            </div>



        </div>



        <?php $this->load->view('layout/partials/_footer'); ?>


    </div>
</div>