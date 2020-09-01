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
	}


	public function index()
	{
		$data = [
			'title' => 'Beranda',
			'content' => 'beranda/v_beranda'
		];
		$this->load->view('layout/wrapper', $data);
	}
}
