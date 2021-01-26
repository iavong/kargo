<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SetHargaController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
        $this->load->model('SetHarga');
    }


    public function index()
    {
        $data = [
            'setHarga' => $this->SetHarga->getSetHarga()->row(),
            'title' => 'Set Harga',
            'content' => 'setharga/v_setharga'
        ];
        $this->load->view('layout/wrapper', $data);
    }


    public function tambah()
    {
        $biayaGudang = htmlspecialchars($this->input->post('biaya_gudang'));
        $biayaAdminGudang = htmlspecialchars($this->input->post('biaya_admin_gudang'));


        if ($this->SetHarga->updateSetHarga($biayaGudang, $biayaAdminGudang) == true) {
            $this->session->set_flashdata('success', 'Set harga berhasil.');
            redirect('setharga');
        } else {
            $this->session->set_flashdata('error', 'Set harga gagal.');
            redirect('setharga');
        }
    }
}

/* End of file SetHargaController.php */
