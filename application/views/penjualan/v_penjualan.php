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
                                <th>Tujuan</th>
                                <th>Airlines</th>
                                <th>Berat</th>
                                <th>Pmbyrnn</th>
                                <th>By. Handling</th>
                                <th>Biaya Total</th>
                                <th>Status</th>
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
                                                    <a class="dropdown-item handleView" data-toggle="modal" data-target="#viewModal" data-id="<?= $penjualan->id; ?>" data-tujuan="<?= $penjualan->tujuan_id; ?>" data-kasir="<?= $this->session->userdata('nama') ?>" type="button"><i class="dw dw-eye"></i> View</a>
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
                                    <td><?= $deleted ? $penjualan->kota_tujuan : '-'; ?></td>
                                    <td><?= $deleted ? $penjualan->airlines : '-'; ?></td>
                                    <td><?= $deleted ? $penjualan->berat . ' Kg' : '-'; ?></td>
                                    <td><?= $deleted ? ucwords($penjualan->jenis_pembayaran) : '-'; ?></td>
                                    <td><?= $deleted ? rupiah($penjualan->total_operasional) : '-'; ?></td>
                                    <td><?= $deleted ? rupiah($penjualan->biaya_total) : '-'; ?></td>
                                    <td><?= $deleted ? $penjualan->status : 'Deleted'; ?></td>
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
<div class="modal fade bs-example-modal-lg" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                        <input class="form-control text-uppercase" type="text" id="no_kwitansi" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Pengirim</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="pengirim" type="text" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Penerima</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="penerima" type="text" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Kota Tujuan</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="tujuan" type="text" readonly>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Airlines</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="airlines" type="text" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">No. Penerbangan</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="no_penerbangan" type="text" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">No. SMU</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="no_smu" type="text" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Berat(Kg)</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="berat" type="text" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Jumlah Koli</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="koli" type="text" readonly>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Isi</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="isi" type="text" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Catatan</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="catatan" type="text" readonly>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Biaya SMU</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="biaya_smu" type="text" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Total Handling</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="total_handling" type="text" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Total Gudang</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="biaya_gudang" type="text" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Biaya Tambahan</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase" id="biaya_tambahan" type="text" readonly>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Biaya Total</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control text-uppercase font-weight-bold" id="total" type="text" readonly>
                    </div>
                </div>

                <!-- Data -->
                <input hidden id="jenis_pembayaran">
                <input hidden id="tanggal">
                <input hidden id="kasir" value="<?= $this->session->userdata('nama'); ?>">



                <small>*Jika kertas printer tidak keluar harap periksa App Key dan Port pada Recta. </small><br>
                <small>App Key : 3889156889, Port : 1811</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" id="btnPrint" data-dismiss="modal"><i class="fa fa-print"></i> CETAK</button>
            </div>
        </div>
    </div>
</div>