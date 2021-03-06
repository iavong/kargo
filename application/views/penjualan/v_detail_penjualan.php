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
                    <?php echo form_open('penjualan/tambah'); ?>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No. Kwitansi</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('no_kwitansi') ? 'form-control-danger' : null) ?>" name="no_kwitansi" type="text" placeholder="No kwitansi .." value="<?= set_value('no_kwitansi') ?>">
                            <?php echo form_error('no_kwitansi', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Penerima<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('penerima') ? 'form-control-danger' : null) ?>" name="penerima" type="text" placeholder="Nama penerima .." value="<?= set_value('penerima') ?>">
                            <?php echo form_error('penerima', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Kota Tujuan<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-10">

                            <select class="custom-select2 form-control <?= (form_error('tujuan') ? 'form-control-danger' : null) ?>" name="tujuan" style="width: 100%; height: 38px;">
                                <option value="">Pilih kota..</option>
                                <?php foreach ($kotatujuan->result() as $kota) : ?>
                                    <option value="<?= $kota->id; ?>"> <?= $kota->kota_tujuan; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo form_error('tujuan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Airlines<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('airlines') ? 'form-control-danger' : null) ?>" name="airlines" placeholder="Airlines .." type="text" value="<?= set_value('airlines') ?>">
                            <?php echo form_error('airlines', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No. Penerbangan<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('no_penerbangan') ? 'form-control-danger' : null) ?>" name="no_penerbangan" type="text" placeholder="No penerbangan .." value="<?= set_value('no_penerbangan') ?>">
                            <?php echo form_error('no_penerbangan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No. SMU<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('no_smu') ? 'form-control-danger' : null) ?>" name="no_smu" placeholder="No SMU .." type="text" value="<?= set_value('no_smu') ?>">
                            <?php echo form_error('no_smu', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Berat<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control <?= (form_error('berat') ? 'form-control-danger' : null) ?>" name="berat" placeholder="Berat .." type="text" value="<?= set_value('berat') ?>">
                            <?php echo form_error('berat', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Jumlah Koli<span class="text-danger">*</span></label>
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
                        <label class="col-sm-12 col-md-2 col-form-label">Biaya Gudang<span class="text-danger">*</span></label>
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
                        <label class="col-sm-12 col-md-2 col-form-label">Jenis Pembayaran<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-10">

                            <?php if ($langganan) : ?>
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="customRadio1" name="jenis_pembayaran" value="deposit" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Deposit</label>
                                </div>
                            <?php endif; ?>

                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="customRadio2" name="jenis_pembayaran" value="cash" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio2">Cash</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="customRadio3" name="jenis_pembayaran" value="debit" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio3">Debit</label>
                            </div>
                            <?php echo form_error('jenis_pembayaran', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 col-md-10 offset-md-2">
                            <button type="submit" name="<?= ($baru ? 'tambah-baru' : 'tambah'); ?>" class="btn btn-primary">Simpan</button>
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