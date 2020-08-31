<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenjualanController extends CI_Controller
{
    public function index()
    {
        $data = [
            'title' => 'Penjualan',
            'content' => 'penjualan/v_penjualan'
        ];
        $this->load->view('layout/wrapper', $data);
    }
}
