<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BerandaController extends CI_Controller
{

	public function index()
	{
		$data = [
			'title' => 'Beranda',
			'content' => 'beranda/v_beranda'
		];
		$this->load->view('layout/wrapper', $data);
		// $this->load->view('beranda/v_beranda');
	}
}
