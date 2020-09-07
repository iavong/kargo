<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PembelianController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
        // panggil model harga
        $this->load->model('Pembelian');
    }


    public function index()
    {
        $data = [
            'pembelian' => $this->Pembelian->getPembelian(),
            'title' => 'Pembelian',
            'content' => 'pembelian/v_pembelian'
        ];
        $this->load->view('layout/wrapper', $data);
    }

    #####################################################################
    # Tambah Harga
    #####################################################################
    public function tambah()
    {
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');

        // cek validasi form
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Tambah Pembelian',
                'content' => 'pembelian/v_tambah_pembelian'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_simpan();
        }
    }
    // proses simpan
    private function _simpan()
    {
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $harga = htmlspecialchars($this->input->post('harga'));

        if ($this->Pembelian->insertPembelian($keterangan, $harga) == true) {
            $this->session->set_flashdata('success', 'Pembelian berhasil ditambahkan.');
            redirect('pembelian');
        } else {
            $this->session->set_flashdata('error', 'Pembelian gagal ditambahkan.');
            redirect('pembelian');
        }
    }

    #####################################################################
    # Delete Harga
    #####################################################################
    public function delete()
    {
        $id = htmlspecialchars($this->input->post('id'));
        if ($this->Pembelian->deletePembelian($id) == true) {
            $this->session->set_flashdata('success', 'Pembelian berhasil dihapus.');
            redirect('pembelian');
        } else {
            $this->session->set_flashdata('error', 'Pembelian gagal dihapus.');
            redirect('pembelian');
        }
    }
}

/* End of file PembelianController.php */