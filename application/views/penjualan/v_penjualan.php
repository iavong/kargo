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
                    <div class="pull-right">
                        <a href="<?= base_url('penjualan/tambah'); ?>" class="btn btn-primary btn-sm scroll-click" rel="content-y"><i class="fa fa-plus"></i> Tambah</a>

                        <!-- <div class="dropdown">
                            <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-plus"></i>
                                Tambah
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="<?= base_url('penjualan/tambah-baru'); ?>">Baru</a>
                                <a class="dropdown-item" href="<?= base_url('penjualan/tambah'); ?>">Langganan</a>
                            </div>
                        </div> -->
                    </div>
                </div>
                <hr>


                <div class="pb-20">
                    <table class="table stripe hover nowrap table-responsive" id="dataTable">
                        <thead>
                            <tr>
                                <th class="datatable-nosort">Action</th>
                                <th>Tgl Pengiriman</th>
                                <th class="table-plus datatable-nosort">No.Kwtnsi</th>
                                <th>No. SMU</th>
                                <th>Pengirim</th>
                                <th>Penerima</th>
                                <th>Tujuan</th>
                                <th>Airlines</th>
                                <th>Berat</th>
                                <th>Pmbyrnn</th>
                                <th>By. Handling</th>
                                <th>Biaya Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($penjualans->result() as $penjualan) : ?>
                                <?php $deleted = $penjualan->deleted == 0; ?>
                                <tr style="text-transform: uppercase;">
                                    <td>
                                        <?php if ($deleted) : ?>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#viewModal<?= $penjualan->id; ?>" type="button"><i class="dw dw-eye"></i> View</a>
                                                    <!-- Edit -->
                                                    <a class="dropdown-item" href="<?= base_url('penjualan/edit/' . $penjualan->id); ?>"><i class="dw dw-pencil"></i> Edit</a>

                                                    <!-- delete -->
                                                    <form action="<?= base_url('penjualan/delete'); ?>" method="post" class="d-inline">
                                                        <input type="hidden" name="id" value="<?= $penjualan->id; ?>" hidden>
                                                        <button onclick="return confirm('Apa anda yakin ?');" class="dropdown-item" title="Delete"><i class="dw dw-delete-3"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d M Y', strtotime($penjualan->created_at)); ?></td>
                                    <td class="table-plus"><?= $penjualan->no_kwitansi; ?></td>
                                    <td><?= $deleted ? $penjualan->no_smu : '-'; ?></td>
                                    <td><?= $deleted ? $penjualan->pengirim : '-'; ?></td>
                                    <td><?= $deleted ? $penjualan->penerima : '-'; ?></td>
                                    <td><?= $deleted ? $penjualan->kota_tujuan : '-'; ?></td>
                                    <td><?= $deleted ? $penjualan->airlines : '-'; ?></td>
                                    <td><?= $deleted ? $penjualan->berat . ' Kg' : '-'; ?></td>
                                    <td><?= $deleted ? ucwords($penjualan->jenis_pembayaran) : '-'; ?></td>
                                    <td><?= $deleted ? rupiah($penjualan->total_operasional) : '-'; ?></td>
                                    <td><?= $deleted ? rupiah($penjualan->biaya_total) : '-'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>



        </div>

        <?php $this->load->view('layout/partials/_footer'); ?>


    </div>
</div>


<!-- Large modal -->
<?php foreach ($penjualans->result() as $penjualan) : ?>
    <div class="modal fade bs-example-modal-lg" id="viewModal<?= $penjualan->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Detail Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No Kwitansi</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= $penjualan->no_kwitansi; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Pengirim</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= $penjualan->pengirim; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Penerima</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= $penjualan->penerima; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Kota Tujuan</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= $penjualan->kota_tujuan; ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Airlines</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= $penjualan->airlines; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No. Penerbangan</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= $penjualan->no_penerbangan; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No. SMU</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= $penjualan->no_smu; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Berat(Kg)</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= $penjualan->berat; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Jumlah Koli</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= $penjualan->koli; ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Isi</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= $penjualan->isi; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Catatan</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= $penjualan->catatan; ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biaya SMU</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= rupiah($penjualan->biaya_smu); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Total Handling</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= rupiah($penjualan->total_operasional); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Total Gudang</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= rupiah($penjualan->total_biaya_gudang); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biaya Tambahan</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase" type="text" value="<?= (!empty($penjualan->biaya_tambahan) ? rupiah($penjualan->biaya_tambahan) : ''); ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biaya Total</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control text-uppercase font-weight-bold" type="text" value="<?= rupiah($penjualan->biaya_total); ?>" readonly>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                    <?php
                        $attributes = array('class' => 'd-inline-block', 'target' => '_blank', 'style' => 'vertical-align: middle;', 'title' => 'Cetak Nota');
                        $hidden = array('id' => $penjualan->id);
                        echo form_open('penjualan/cetak-nota', $attributes, $hidden);
                        ?>
                    <!-- <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-print"></i></button> -->
                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak Nota</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>