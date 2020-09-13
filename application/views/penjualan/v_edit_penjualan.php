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

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No. Kwitansi</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('no_kwitansi') ? 'form-control-danger' : null) ?>" name="no_kwitansi" type="text" placeholder="No kwitansi .." value="<?= set_value('no_kwitansi') ?>">
                            <?php echo form_error('no_kwitansi', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Pengirim</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('pengirim') ? 'form-control-danger' : null) ?>" name="pengirim" type="text" placeholder="Nama pengirim .." value="<?= set_value('pengirim') ?>">
                            <?php echo form_error('pengirim', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Penerima</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('penerima') ? 'form-control-danger' : null) ?>" name="penerima" type="text" placeholder="Nama penerima .." value="<?= set_value('penerima') ?>">
                            <?php echo form_error('penerima', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Kota Tujuan</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('tujuan') ? 'form-control-danger' : null) ?>" name="tujuan" type="text" placeholder="Kota tujuan .." value="<?= set_value('tujuan') ?>">
                            <?php echo form_error('tujuan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Airlines</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('airlines') ? 'form-control-danger' : null) ?>" name="airlines" placeholder="Airlines .." type="text" value="<?= set_value('airlines') ?>">
                            <?php echo form_error('airlines', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No. Penerbangan</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('no_penerbangan') ? 'form-control-danger' : null) ?>" name="no_penerbangan" type="text" placeholder="No penerbangan .." value="<?= set_value('no_penerbangan') ?>">
                            <?php echo form_error('no_penerbangan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No. SMU</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('no_smu') ? 'form-control-danger' : null) ?>" name="no_smu" placeholder="No SMU .." type="text" value="<?= set_value('no_smu') ?>">
                            <?php echo form_error('no_smu', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Berat</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('berat') ? 'form-control-danger' : null) ?>" name="berat" placeholder="Berat .." type="text" value="<?= set_value('berat') ?>">
                            <?php echo form_error('berat', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Jumlah Koli</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('koli') ? 'form-control-danger' : null) ?>" name="koli" placeholder="Koli .." type="text" value="<?= set_value('koli') ?>">
                            <?php echo form_error('koli', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Isi</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea name="isi" class="form-control <?= (form_error('isi') ? 'form-control-danger' : null) ?>" placeholder="Isi menurut pengakuan.." style="height: 80px;"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Catatan</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea name="catatan" class="form-control <?= (form_error('catatan') ? 'form-control-danger' : null) ?>" placeholder="Catatan.." style="height: 80px;"></textarea>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biaya SMU</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('biaya_smu') ? 'form-control-danger' : null) ?>" name="biaya_smu" placeholder="Biaya SMU .." type="text" value="<?= set_value('biaya_smu') ?>">
                            <?php echo form_error('biaya_smu', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biaya Gudang</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('biaya_gudang') ? 'form-control-danger' : null) ?>" name="biaya_gudang" placeholder="Biaya gudang .." type="text" value="<?= set_value('biaya_gudang') ?>">
                            <?php echo form_error('biaya_gudang', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biaya Tambahan</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('biaya_tambahan') ? 'form-control-danger' : null) ?>" name="biaya_tambahan" placeholder="Biaya tambahan .." type="text" value="<?= set_value('biaya_tambahan') ?>">
                            <?php echo form_error('biaya_tambahan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 col-md-10 offset-md-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('penjualan'); ?>" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                    <?php echo form_close(); ?>


                </div>
            </div>



        </div>



        <?php $this->load->view('layout/partials/_footer'); ?>


    </div>
</div>