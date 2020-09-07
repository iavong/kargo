<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HargaController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
        // panggil model harga
        $this->load->model('Harga');
    }


    public function index()
    {
        $data = [
            'harga' => $this->Harga->getHarga(),
            'title' => 'Harga',
            'content' => 'harga/v_harga'
        ];
        $this->load->view('layout/wrapper', $data);
    }


    #####################################################################
    # Tambah Harga
    #####################################################################
    public function tambah()
    {
        // set rules
        $this->form_validation->set_rules('berat', 'Berat', 'required');
        $this->form_validation->set_rules(
            'kota',
            'Kota',
            'required|is_unique[harga.kota_tujuan]',
            array(
                'is_unique'     => '%s sudah ada.'
            )
        );
        $this->form_validation->set_rules('biaya', 'Biaya', 'required|numeric');

        // cek validasi form
        if ($this->form_validation->run() == FALSE) {
            $data = [
                // 'harga' => $this->Harga->getHarga(),
                'title' => 'Tambah Harga',
                'content' => 'harga/v_tambah_harga'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_simpan();
        }
    }
    // proses simpan
    private function _simpan()
    {
        $berat = htmlspecialchars($this->input->post('berat'));
        $kota = htmlspecialchars($this->input->post('kota'));
        $biaya = htmlspecialchars($this->input->post('biaya'));

        if ($this->Harga->insertHarga($berat, $kota, $biaya) == true) {
            $this->session->set_flashdata('success', 'Harga berhasil ditambahkan.');
            redirect('harga');
        } else {
            $this->session->set_flashdata('error', 'Harga gagal ditambahkan.');
            redirect('harga');
        }
    }


    #####################################################################
    # Edit Harga
    #####################################################################
    public function edit($id)
    {
        // set rules
        $this->form_validation->set_rules('berat', 'Berat', 'required');
        $cariKota = $this->Harga->getHargaById($id)->row();
        $cekKota = $cariKota->kota_tujuan;

        $kota = htmlspecialchars($this->input->post('kota'));
        // rule ketika user ganti nama kota
        if ($kota != $cekKota) {
            $this->form_validation->set_rules(
                'kota',
                'Kota',
                'required|is_unique[harga.kota_tujuan]',
                array(
                    'is_unique'     => '%s sudah ada.'
                )
            );
        } else {
            $this->form_validation->set_rules('kota', 'kota', 'required');
        }

        $this->form_validation->set_rules('biaya', 'Biaya', 'required|numeric');

        // cek validasi form
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'harga' => $this->Harga->getHargaById($id)->row(),
                'title' => 'Edit Harga',
                'content' => 'harga/v_edit_harga'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_update();
        }
    }
    private function _update()
    {
        $id = htmlspecialchars($this->input->post('id'));
        $berat = htmlspecialchars($this->input->post('berat'));
        $kota = htmlspecialchars($this->input->post('kota'));
        $biaya = htmlspecialchars($this->input->post('biaya'));

        if ($this->Harga->updateHarga($id, $berat, $kota, $biaya) == true) {
            $this->session->set_flashdata('success', 'Harga berhasil diedit.');
            redirect('harga');
        } else {
            $this->session->set_flashdata('error', 'Harga gagal diedit.');
            redirect('harga');
        }
    }


    #####################################################################
    # Delete Harga
    #####################################################################
    public function delete()
    {
        $id = htmlspecialchars($this->input->post('id'));
        if ($this->Harga->deleteHarga($id) == true) {
            $this->session->set_flashdata('success', 'Harga berhasil dihapus.');
            redirect('harga');
        } else {
            $this->session->set_flashdata('error', 'Harga gagal dihapus.');
            redirect('harga');
        }
    }
}

/* End of file HargaController.php */
