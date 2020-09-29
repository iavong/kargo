<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPembelianController extends CI_Controller
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
            'title' => 'Laporan Pembelian',
            'content' => 'laporan/v_laporan_pembelian'
        ];
        $this->load->view('layout/wrapper', $data);
    }
}

/* End of file LaporanPembelianController.php */
