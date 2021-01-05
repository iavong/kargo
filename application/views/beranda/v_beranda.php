<div class="main-container">
    <div class="pd-ltr-20">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="<?= base_url(); ?>assets/vendors/images/banner-img.png" alt="">
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        Selamat Datang <div class="weight-600 font-30 text-blue"><?= ucfirst($this->session->userdata('nama')); ?>!</div>
                    </h4>
                    <p class="font-18 max-width-600">Niat baik, Hasilnya juga baik.</p>
                </div>
            </div>
        </div>


        <div class="row clearfix progress-box">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <strong class="text-primary"><?php echo $penjualanToday->num_rows(); ?></strong>
                        <h5 class="text-blue padding-top-10 h5">Penjualan Hari ini</h5>
                        <span class="d-block"><i class="fa fa-line-chart text-blue"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <strong class="text-light-green"><?php echo $penjualanThisMonth->num_rows(); ?></strong>
                        <h5 class="text-light-green padding-top-10 h5">Penjualan Bulan ini</h5>
                        <span class="d-block"> <i class="fa text-light-green fa-line-chart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <strong class="text-light-orange"><?php echo $pembelianToday->num_rows(); ?></strong>
                        <h5 class="text-light-orange padding-top-10 h5">Pembelian Hari ini</h5>
                        <span class="d-block"><i class="fa text-light-orange fa-line-chart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <strong class="text-light-purple"><?php echo $pembelianThisMonth->num_rows(); ?></strong>
                        <h5 class="text-light-purple padding-top-10 h5">Pembelian Bulan ini</h5>
                        <span class="d-block"><i class="fa text-light-purple fa-line-chart"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-xl-8 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h2 class="h4 mb-20">Activity</h2>
                    <div id="chart5"></div>
                </div>
            </div>
            <div class="col-xl-4 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h2 class="h4 mb-20">Lead Target</h2>
                    <div id="chart6"></div>
                </div>
            </div>
        </div> -->

        <?php $this->load->view('layout/partials/_footer'); ?>

    </div>
</div>