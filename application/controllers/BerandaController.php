<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BerandaController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('username'))) {
			redirect('login');
		}
		$this->load->model('Beranda');
	}


	public function index()
	{
		$data = [
			// penjualan
			'penjualanToday' => $this->Beranda->getPenjualanToday(),
			'penjualanThisMonth' => $this->Beranda->getPenjualanThisMonth(),
			// pembelian
			'pembelianToday' => $this->Beranda->getPembelianToday(),
			'pembelianThisMonth' => $this->Beranda->getPembelianThisMonth(),
			// 
			'title' => 'Beranda',
			'content' => 'beranda/v_beranda'
		];
		$this->load->view('layout/wrapper', $data);
	}
}
