<div class="left-side-bar">
    <div class="brand-logo">
        <a href="<?= base_url(); ?>">
            <img src="<?= base_url('assets/images/logo/logo2.ico'); ?>" width="150" class="dark-logo">
            <img src="<?= base_url('assets/images/logo/logo5.ico'); ?>" width="150" class="light-logo">
            <!-- <h1 class="text-secondary">CV. KKM</h1> -->
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

                <!-- Gaji -->
                <?php if ($this->session->userdata('role') == 1) { ?>
                    <li>
                        <a href="<?= base_url('gaji'); ?>" class="dropdown-toggle no-arrow <?= ($this->router->fetch_class() == 'GajiController') ? 'active' : '' ?>">
                            <span class="micon dw dw-books"></span><span class="mtext">Gaji</span>
                        </a>
                    </li>
                <?php }; ?>


                <!-- Tujuan -->
                <li>
                    <a href="<?= base_url('tujuan'); ?>" class="dropdown-toggle no-arrow <?= ($this->router->fetch_class() == 'TujuanController') ? 'active' : '' ?>">
                        <span class="micon dw dw-money"></span><span class="mtext">Tujuan</span>
                    </a>
                </li>

                <!-- Set Harga -->
                <li>
                    <a href="<?= base_url('setharga'); ?>" class="dropdown-toggle no-arrow <?= ($this->router->fetch_class() == 'SetHargaController') ? 'active' : '' ?>">
                        <span class="micon dw dw-money-2"></span><span class="mtext">Set Harga</span>
                    </a>
                </li>

                <!-- Pelanggan -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-library"></span><span class="mtext">Pengirim</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('pengirim'); ?>" class="<?= ($this->router->fetch_class() == 'PengirimController') ? 'active' : '' ?>">Pengirim Langganan</a></li>
                        <li><a href="<?= base_url('pengirim-hutang'); ?>" class="<?= ($this->router->fetch_class() == 'PengirimHutangController') ? 'active' : '' ?>">Pengirim Hutang</a></li>
                    </ul>
                </li>


                <!-- Laporan -->
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-calendar1"></span><span class="mtext">Laporan</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('laporan-penjualan'); ?>" class="<?= ($this->router->fetch_class() == 'LaporanPenjualanController') ? 'active' : '' ?>">Laporan Penjualan</a></li>
                        <li><a href="<?= base_url('laporan-pembelian'); ?>" class="<?= ($this->router->fetch_class() == 'LaporanPembelianController') ? 'active' : '' ?>">Laporan Pembelian</a></li>

                        <!-- hanya master, role=1 -->
                        <?php if ($this->session->userdata('role') == 1) : ?>
                            <li><a href="<?= base_url('laporan-gaji'); ?>" class="<?= ($this->router->fetch_class() == 'LaporanGajiController') ? 'active' : '' ?>">Laporan Gaji</a></li>
                            <li><a href="<?= base_url('laporan-keuangan'); ?>" class="<?= ($this->router->fetch_class() == 'LaporanKeuanganController') ? 'active' : '' ?>">Laporan Keuangan</a></li>
                        <?php endif; ?>
                    </ul>
                </li>

                <!-- Users -->
                <?php if ($this->session->userdata('role') == 1) : ?>
                    <li>
                        <a href="<?= base_url('user'); ?>" class="dropdown-toggle no-arrow <?= ($this->router->fetch_class() == 'UserController') ? 'active' : '' ?>">
                            <span class="micon dw dw-user"></span><span class="mtext">User</span>
                        </a>
                    </li>
                <?php endif; ?>


            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>