<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPenjualanController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Laporan Penjualan',
            'content' => 'laporan/v_laporan_penjualan'
        ];
        $this->load->view('layout/wrapper', $data);
    }
}

/* End of file LaporanPenjualanController.php */
