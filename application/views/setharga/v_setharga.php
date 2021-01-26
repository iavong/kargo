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

                <div class="row">
                    <div class="col-md-6">
                        <div class="pb-20">
                            <?php echo form_open('setharga/tambah') ?>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-4 col-form-label">Biaya Gudang</label>
                                <div class="col-sm-12 col-md-8">
                                    <input class="form-control int" name="biaya_gudang" type="text" placeholder="Biaya Gudang .." value="<?= $setHarga->biaya_gudang; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-4 col-form-label">Biaya Admin Gudang</label>
                                <div class="col-sm-12 col-md-8">
                                    <input class="form-control int" name="biaya_admin_gudang" placeholder="Biaya admin gudang .." type="text" value="<?= $setHarga->biaya_admin_gudang; ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5>Harga Saat Ini</h5>
                        <hr>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold">Biaya Gudang : </td>
                                    <td><?= rupiah($setHarga->biaya_gudang); ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Biaya Admin Gudang : </td>
                                    <td><?= rupiah($setHarga->biaya_admin_gudang); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>



        </div>



        <?php $this->load->view('layout/partials/_footer'); ?>


    </div>
</div>