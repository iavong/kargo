<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <?php $this->load->view('partials/_flash'); ?>

            <div class="row">
                <!-- form deposit -->
                <div class="col-md-6">

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
                            <input type="hidden" name="id" value="<?= $pengirim->id; ?>">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Nama Pengirim</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control <?= (form_error('nama') ? 'form-control-danger' : null) ?>" name="nama" type="text" placeholder="Nama pengirim.." value="<?= $pengirim->nama; ?>" readonly>
                                    <?php echo form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Deposit</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control <?= (form_error('deposit') ? 'form-control-danger' : null) ?>" name="deposit" placeholder="Deposit.." type="text" value="<?= set_value('deposit') ?>">
                                    <?php echo form_error('deposit', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 col-md-10 offset-md-2">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="<?= base_url('pengirim'); ?>" class="btn btn-outline-secondary">Kembali</a>
                                </div>
                            </div>
                            <?php echo form_close(); ?>


                        </div>
                    </div>

                </div>


                <!-- history deposit -->
                <div class="col-md-6">

                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-20">
                        <div class="clearfix mb-20">
                            <div class="pull-left">
                                <h4 class="text-blue h4">History Deposit</h4>
                                <!-- <p>Add class <code>.table</code></p> -->
                            </div>
                        </div>
                        <hr>

                        <p class="font-weight-bold">Deposit Sekarang : <?= rupiah($pengirim->deposit); ?></p>


                        <div class="pb-20">
                            <table class="table stripe hover nowrap">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">Deposit</th>
                                        <th>Tanggal</th>
                                        <th class="datatable-nosort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($deposit->result() as $row) : ?>
                                        <tr>
                                            <td><?= rupiah($row->deposit); ?></td>
                                            <td><?= date('H:i - d M Y', strtotime($row->created_at)); ?></td>
                                            <td>
                                                <!-- delete -->
                                                <form action="<?= base_url('pengirim/deposit/delete'); ?>" method="post" class="d-inline">
                                                    <input type="hidden" name="id" value="<?= $row->id; ?>" hidden>
                                                    <input type="hidden" name="id_pengirim" value="<?= $row->id_pengirim; ?>" hidden>
                                                    <input type="hidden" name="deposit" value="<?= $row->deposit; ?>" hidden>
                                                    <button onclick="return confirm('Apa anda yakin ?');" class="btn btn-sm btn-danger" title="Delete"><i class="dw dw-delete-3"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>


                        </div>
                    </div>

                </div>
            </div>





        </div>



        <?php $this->load->view('layout/partials/_footer'); ?>


    </div>
</div>