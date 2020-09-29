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
                                    <form action="" target="_blank" method="post">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="bulan">Pilih Bulan</label>
                                                    <select name="bulan" id="bulan" class="form-control" required>
                                                        <option value="">--- Pilih Bulan ---</option>
                                                        <option value="01">Januari</option>
                                                        <option value="02">Februari</option>
                                                        <option value="03">Maret</option>
                                                        <option value="04">April</option>
                                                        <option value="05">Mei</option>
                                                        <option value="06">Juni</option>
                                                        <option value="07">Juli</option>
                                                        <option value="08">Agustus</option>
                                                        <option value="09">September</option>
                                                        <option value="10">Oktober</option>
                                                        <option value="11">November</option>
                                                        <option value="12">Desember</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="tahun">Pilih Tahun</label>
                                                    <select name="tahun" id="tahun" class="form-control" required>
                                                        <option value="">--- Pilih Tahun ---</option>
                                                        <option value="2020" selected>2020</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2017">2017</option>
                                                        <option value="2016">2016</option>
                                                        <option value="2015">2015</option>
                                                    </select>
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
                                    <form action="" target="_blank" method="post">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="bulan">Tanggal Awal</label>
                                                    <input type="date" name="tgl_awal" class="form-control">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="tahun">Tanggal Akhir</label>
                                                    <input type="date" name="tgl_akhir" class="form-control">
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



        <?php $this->load->view('layout/partials/_footer'); ?>


    </div>
</div>