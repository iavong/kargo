<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'BerandaController';
$route['404_override'] = 'ErrorController';
$route['translate_uri_dashes'] = FALSE;

// Beranda
$route['beranda'] = 'BerandaController';

// Login
$route['login'] = 'auth/AuthController';
$route['logout'] = 'auth/AuthController/logout';

// Penjualan
$route['penjualan'] = 'PenjualanController';
$route['penjualan/tambah'] = 'PenjualanController/tambah';
$route['penjualan/edit/(:num)'] = 'PenjualanController/edit/$1';
$route['penjualan/detail/(:num)'] = 'PenjualanController/detail/$1';
$route['penjualan/delete'] = 'PenjualanController/delete';
$route['penjualan/getHarga'] = 'PenjualanController/getHarga';
$route['penjualan/cekHarga'] = 'PenjualanController/cekHarga';
$route['penjualan/cekTipePengirim'] = 'PenjualanController/cekTipePengirim';
$route['penjualan/cetak-nota'] = 'PenjualanController/cetakNota';
$route['penjualan/cekCustomHarga'] = 'PenjualanController/cekCustomHarga';


// Pembelian
$route['pembelian'] = 'PembelianController';
$route['pembelian/tambah'] = 'PembelianController/tambah';
$route['pembelian/edit/(:num)'] = 'PembelianController/edit/$1';
$route['pembelian/delete'] = 'PembelianController/delete';

// Pembelian
$route['gaji'] = 'GajiController';
$route['gaji/tambah'] = 'GajiController/tambah';
$route['gaji/edit/(:num)'] = 'GajiController/edit/$1';
$route['gaji/delete'] = 'GajiController/delete';

// Tujuan
$route['tujuan'] = 'TujuanController';
$route['tujuan/tambah'] = 'TujuanController/tambah';
$route['tujuan/edit/(:num)'] = 'TujuanController/edit/$1';
$route['tujuan/delete'] = 'TujuanController/delete';

// Pengirim
$route['pengirim'] = 'PengirimController';
$route['pengirim/tambah'] = 'PengirimController/tambah';
$route['pengirim/edit/(:num)'] = 'PengirimController/edit/$1';
$route['pengirim/delete'] = 'PengirimController/delete';
$route['pengirim/deposit/(:num)'] = 'PengirimController/deposit/$1';
$route['pengirim/deposit/delete'] = 'PengirimController/deleteDeposit';

// Pengirim Hutang
$route['pengirim-hutang'] = 'PengirimHutangController';
$route['pengirim-hutang/tambah'] = 'PengirimHutangController/tambah';
$route['pengirim-hutang/edit/(:num)'] = 'PengirimHutangController/edit/$1';
$route['pengirim-hutang/delete'] = 'PengirimHutangController/delete';
$route['pengirim-hutang/bayar/(:num)'] = 'PengirimHutangController/bayar/$1';
$route['pengirim-hutang/bayar/delete'] = 'PengirimHutangController/deleteBayar';





// Laporan Penjualan
$route['laporan-penjualan'] = 'laporan/LaporanPenjualanController';
$route['laporan-penjualan/cetak-perbulan'] = 'laporan/LaporanPenjualanController/cetak_perbulan';
$route['laporan-penjualan/cetak-perperiode'] = 'laporan/LaporanPenjualanController/cetak_perperiode';

// Laporan Pembelian
$route['laporan-pembelian'] = 'laporan/LaporanPembelianController';
$route['laporan-pembelian/cetak-perbulan'] = 'laporan/LaporanPembelianController/cetak_perbulan';
$route['laporan-pembelian/cetak-perperiode'] = 'laporan/LaporanPembelianController/cetak_perperiode';

// Laporan keuangan
$route['laporan-keuangan'] = 'laporan/LaporanKeuanganController';
$route['laporan-keuangan/cetak-perbulan'] = 'laporan/LaporanKeuanganController/cetak_perbulan';
$route['laporan-keuangan/cetak-perperiode'] = 'laporan/LaporanKeuanganController/cetak_perperiode';



// Penerima
$route['penerima'] = 'PenerimaController';

// user
$route['user'] = 'UserController';
$route['user/tambah'] = 'UserController/tambah';
$route['user/edit/(:num)'] = 'UserController/edit/$1';
$route['user/delete'] = 'UserController/delete';

// profile
$route['profile'] = 'ProfileController';
$route['profile/delete'] = 'ProfileController/delete';
