<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TujuanController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
        // panggil model tujuan
        $this->load->model('Tujuan');
    }


    public function index()
    {
        $data = [
            'tujuan' => $this->Tujuan->getTujuan(),
            'title' => 'Tujuan',
            'content' => 'tujuan/v_tujuan'
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
            'required|is_unique[tujuan.kota_tujuan]',
            array(
                'is_unique'     => '%s sudah ada.'
            )
        );
        $this->form_validation->set_rules('biaya', 'Biaya', 'required|numeric');

        // cek validasi form
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Tambah Tujuan',
                'content' => 'tujuan/v_tambah_tujuan'
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

        if ($this->Tujuan->insertTujuan($berat, $kota, $biaya) == true) {
            $this->session->set_flashdata('success', 'Tujuan berhasil ditambahkan.');
            redirect('tujuan');
        } else {
            $this->session->set_flashdata('error', 'Tujuan gagal ditambahkan.');
            redirect('tujuan');
        }
    }


    #####################################################################
    # Edit Harga
    #####################################################################
    public function edit($id)
    {
        // set rules
        $this->form_validation->set_rules('berat', 'Berat', 'required');
        $cariKota = $this->Tujuan->getTujuanById($id)->row();
        $cekKota = $cariKota->kota_tujuan;

        $kota = htmlspecialchars($this->input->post('kota'));
        // rule ketika user ganti nama kota
        if ($kota != $cekKota) {
            $this->form_validation->set_rules(
                'kota',
                'Kota',
                'required|is_unique[tujuan.kota_tujuan]',
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
                'tujuan' => $this->Tujuan->getTujuanById($id)->row(),
                'title' => 'Edit Tujuan',
                'content' => 'tujuan/v_edit_tujuan'
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

        if ($this->Tujuan->updateTujuan($id, $berat, $kota, $biaya) == true) {
            $this->session->set_flashdata('success', 'Tujuan berhasil diedit.');
            redirect('tujuan');
        } else {
            $this->session->set_flashdata('error', 'Tujuan gagal diedit.');
            redirect('tujuan');
        }
    }


    #####################################################################
    # Delete Harga
    #####################################################################
    public function delete()
    {
        $id = htmlspecialchars($this->input->post('id'));
        if ($this->Tujuan->deleteTujuan($id) == true) {
            $this->session->set_flashdata('success', 'Tujuan berhasil dihapus.');
            redirect('tujuan');
        } else {
            $this->session->set_flashdata('error', 'Tujuan gagal dihapus.');
            redirect('tujuan');
        }
    }
}

/* End of file TujuanController.php */
