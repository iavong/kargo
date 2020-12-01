<?php error_reporting(0); ?>
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


                <div class="pb-20">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <strong class="">Cetak Perbulan</strong>
                                    <hr>
                                    <form action="<?= base_url('laporan-pembelian/cetak-perbulan'); ?>" target="_blank" method="post">
                                        <div class="form-group">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="bulan">Pilih Bulan & Tahun</label>
                                                    <input type="text" name="bulan" class="form-control month-picker" placeholder="Pilih bulan..">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group d-flex mt-5">
                                            <button type="submit" class="btn btn-sm btn-success mr-2 pl-4 pr-4">
                                                <i class="fa fa-print"></i> CETAK LAPORAN
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <strong class="">Cetak Dalam Periode</strong>
                                    <hr>
                                    <form action="<?= base_url('laporan-pembelian/cetak-perperiode'); ?>" target="_blank" method="post">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="bulan">Tanggal Awal</label>
                                                    <input type="text" name="tgl_awal" class="form-control date-picker" placeholder="Pilih tanggal awal..">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="tahun">Tanggal Akhir</label>
                                                    <input type="text" name="tgl_akhir" class="form-control date-picker" placeholder="Pilih tanggal akhir..">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mt-5">
                                            <button type="submit" class="btn btn-sm btn-success mr-2 pl-4 pr-4">
                                                <i class="fa fa-print"></i> CETAK LAPORAN
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



        </div>

        <div class="pd-20 bg-white border-radius-4 box-shadow mb-20">
            <div class="clearfix mb-20">
                <h4 class="text-blue h4"><?= $title, ' Hari ini (' . tgl_indo(date('Y-m-d')) . ')'; ?></h4>
                <hr>

                <?php foreach ($pembelian->result() as $row) : ?>
                    <?php
                    $totalPembelian += $row->harga;
                    ?>
                <?php endforeach; ?>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Total Pengeluaran Hari ini :</strong>
                            </div>
                            <div class="col-md-6"><?= rupiah($totalPembelian); ?></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Pengeluaran Hari ini :</strong>
                            </div>
                            <div class="col-md-6" style="text-transform:uppercase">
                                <?php foreach ($pembelian->result() as $row) : ?>
                                    <?php
                                    $keterangan = $row->keterangan;
                                    $harga = $row->harga;
                                    echo $keterangan . ' ' . rupiah($harga);
                                    ?>
                                    <br>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Pengeluaran Bulan ini :</strong>
                            </div>
                            <div class="col-md-6" style="text-transform:uppercase">
                                <?php foreach ($pembelianBulan->result() as $row) : ?>
                                    <?php
                                    $row->harga;
                                    $totalPembelianBulan += $row->harga;
                                    ?>
                                <?php endforeach; ?>

                                <?php echo rupiah($totalPembelianBulan); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>


        </div>



        <?php $this->load->view('layout/partials/_footer'); ?>


    </div>
</div>