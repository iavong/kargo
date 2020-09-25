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
                        <!-- <a href="<?= base_url('penjualan/tambah'); ?>" class="btn btn-primary btn-sm scroll-click" rel="content-y"><i class="fa fa-plus"></i> Tambah</a> -->

                        <div class="dropdown">
                            <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-plus"></i>
                                Tambah
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="<?= base_url('penjualan/tambah-baru'); ?>">Baru</a>
                                <a class="dropdown-item" href="<?= base_url('penjualan/tambah'); ?>">Langganan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>


                <div class="pb-20">
                    <table class="table stripe hover nowrap table-responsive" id="dataTable">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Pengirim</th>
                                <th>Penerima</th>
                                <th>Tujuan</th>
                                <th>Airlines</th>
                                <th>Berat</th>
                                <th>Jenis Pembayaran</th>
                                <th>Biaya Total</th>
                                <th>Tanggal Pengiriman</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($penjualans->result() as $penjualan) : ?>
                                <tr>
                                    <td class="table-plus"><?= $penjualan->pengirim; ?></td>
                                    <td><?= $penjualan->penerima; ?></td>
                                    <td><?= $penjualan->kota_tujuan; ?></td>
                                    <td><?= $penjualan->airlines; ?></td>
                                    <td><?= $penjualan->berat . ' Kg'; ?></td>
                                    <td><?= ucwords($penjualan->jenis_pembayaran); ?></td>
                                    <td><?= rupiah($penjualan->biaya_total); ?></td>
                                    <td><?= date('H:i - d M Y', strtotime($penjualan->created_at)); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#viewModal<?= $penjualan->id; ?>" type="button"><i class="dw dw-eye"></i> View</a>

                                                <!-- delete -->
                                                <form action="<?= base_url('penjualan/delete'); ?>" method="post" class="d-inline">
                                                    <input type="hidden" name="id" value="<?= $penjualan->id; ?>" hidden>
                                                    <button onclick="return confirm('Apa anda yakin ?');" class="dropdown-item" title="Delete"><i class="dw dw-delete-3"></i> Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
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
                            <input class="form-control" type="text" value="<?= $penjualan->no_kwitansi; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Pengirim</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?= $penjualan->pengirim; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Penerima</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?= $penjualan->penerima; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Kota Tujuan</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?= $penjualan->kota_tujuan; ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Airlines</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?= $penjualan->airlines; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No. Penerbangan</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?= $penjualan->no_penerbangan; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">No. SMU</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?= $penjualan->no_smu; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Berat</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?= $penjualan->berat; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Jumlah Koli</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?= $penjualan->koli; ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Isi</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea class="form-control" readonly><?= $penjualan->isi; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Catatan</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea class="form-control" readonly><?= $penjualan->catatan; ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biaya SMU</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?= rupiah($penjualan->biaya_smu); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biaya Gudang</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?= rupiah($penjualan->biaya_gudang); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biaya Tambahan</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?= (!empty($penjualan->biaya_tambahan) ? rupiah($penjualan->biaya_tambahan) : ''); ?>" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biaya Total</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?= rupiah($penjualan->biaya_total); ?>" readonly>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary"><i class="fa fa-print"></i> Cetak Nota</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>