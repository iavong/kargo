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
$route['penjualan/tambah-baru'] = 'PenjualanController/tambah';
$route['penjualan/tambah'] = 'PenjualanController/tambah';
$route['penjualan/delete'] = 'PenjualanController/delete';


// Pembelian
$route['pembelian'] = 'PembelianController';
$route['pembelian/tambah'] = 'PembelianController/tambah';
$route['pembelian/edit/(:num)'] = 'PembelianController/edit/$1';
$route['pembelian/delete'] = 'PembelianController/delete';

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
