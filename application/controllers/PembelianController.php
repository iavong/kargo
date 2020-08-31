<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PembelianController extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Pembelian',
            'content' => 'pembelian/v_pembelian'
        ];
        $this->load->view('layout/wrapper', $data);
    }
}

/* End of file PembelianController.php */
