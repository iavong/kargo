<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <!-- <img src="<?= base_url(); ?>assets/vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
            <img src="<?= base_url(); ?>assets/vendors/images/deskapp-logo-white.svg" alt="" class="light-logo"> -->
            <h1 class="text-secondary">CV. KKM</h1>
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <!-- <ul> -->

                <!-- Beranda -->
                <li>
                    <a href="<?= base_url(); ?>" class="dropdown-toggle no-arrow <?= ($this->router->fetch_class() == 'BerandaController') ? 'active' : '' ?>">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Beranda</span>
                    </a>
                </li>

                <!-- Penjualan -->
                <li>
                    <a href="<?= base_url('penjualan'); ?>" class="dropdown-toggle no-arrow <?= ($this->router->fetch_class() == 'PenjualanController') ? 'active' : '' ?>">
                        <span class="micon dw dw-invoice"></span><span class="mtext">Penjualan</span>
                    </a>
                </li>


                <!-- Pembelian -->
                <li>
                    <a href="<?= base_url('pembelian'); ?>" class="dropdown-toggle no-arrow <?= ($this->router->fetch_class() == 'PembelianController') ? 'active' : '' ?>">
                        <span class="micon dw dw-shopping-cart"></span><span class="mtext">Pembelian</span>
                    </a>
                </li>

                <!-- Laporan -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-calendar1"></span><span class="mtext">Laporan</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="index.html">Laporan Penjualan</a></li>
                        <li><a href="index2.html">Laporan Pembelian</a></li>
                        <li><a href="index2.html">Laporan Keuangan</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>