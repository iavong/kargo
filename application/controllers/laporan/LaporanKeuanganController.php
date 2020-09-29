<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanKeuanganController extends CI_Controller
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
            'title' => 'Laporan Keuangan',
            'content' => 'laporan/v_laporan_keuangan'
        ];
        $this->load->view('layout/wrapper', $data);
    }
}

/* End of file LaporanKeuanganController.php */
