<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GajiController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
        if ($this->session->userdata('role') != 1) {
            redirect('beranda');
        }
        // panggil model harga
        $this->load->model('Gaji');
    }


    public function index()
    {
        $data = [
            'gaji' => $this->Gaji->getGaji(),
            'title' => 'Gaji',
            'content' => 'gaji/v_gaji'
        ];
        $this->load->view('layout/wrapper', $data);
    }

    #####################################################################
    # Tambah Gaji
    #####################################################################
    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('total_gaji', 'Total Gaji', 'required|numeric');

        // cek validasi form
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Tambah Gaji',
                'content' => 'gaji/v_tambah_gaji'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_simpan();
        }
    }
    // proses simpan
    private function _simpan()
    {
        $nama = htmlspecialchars($this->input->post('nama'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $totalGaji = htmlspecialchars($this->input->post('total_gaji'));

        if ($this->Gaji->insertGaji($nama, $keterangan, $totalGaji) == true) {
            $this->session->set_flashdata('success', 'Gaji berhasil ditambahkan.');
            redirect('gaji');
        } else {
            $this->session->set_flashdata('error', 'gaji gagal ditambahkan.');
            redirect('gaji');
        }
    }



    #####################################################################
    # Edit Gaji
    #####################################################################
    public function edit($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('total_gaji', 'Total Gaji', 'required|numeric');

        // cek validasi form
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'gaji' => $this->Gaji->getGaji($id)->row(),
                'title' => 'Edit Gaji',
                'content' => 'gaji/v_edit_gaji'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_update();
        }
    }

    private function _update()
    {
        $id = htmlspecialchars($this->input->post('id'));
        $nama = htmlspecialchars($this->input->post('nama'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $totalGaji = htmlspecialchars($this->input->post('total_gaji'));

        if ($this->Gaji->updateGaji($id, $nama, $keterangan, $totalGaji) == true) {
            $this->session->set_flashdata('success', 'Gaji berhasil diedit.');
            redirect('gaji');
        } else {
            $this->session->set_flashdata('error', 'Gaji gagal diedit.');
            redirect('gaji');
        }
    }


    #####################################################################
    # Delete Gaji
    #####################################################################
    public function delete()
    {
        $id = htmlspecialchars($this->input->post('id'));

        if ($this->Gaji->deleteGaji($id) == true) {
            $this->session->set_flashdata('success', 'Gaji berhasil dihapus.');
            redirect('gaji');
        } else {
            $this->session->set_flashdata('error', 'Gaji gagal dihapus.');
            redirect('gaji');
        }
    }
}

/* End of file GajiController.php */
