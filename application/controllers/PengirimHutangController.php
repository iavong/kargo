<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengirimHutangController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Pengirim');
        $this->load->model('Deposit');
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }


    public function index()
    {
        $key = 1; // penghutang
        $data = [
            'pengirimhutang' => $this->Pengirim->getPengirim($key),
            'title' => 'Pengirim Hutang',
            'content' => 'pengirimhutang/v_pengirim_hutang'
        ];
        $this->load->view('layout/wrapper', $data);
    }


    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('hp', 'No. HP', 'required|numeric|max_length[15]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('deposit', 'Deposit', 'required|numeric');


        // cek validasi form
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Tambah Pengirim Hutang',
                'content' => 'pengirimhutang/v_tambah_pengirim_hutang'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_simpan();
        }
    }


    private function _simpan()
    {
        try {
            $nama = htmlspecialchars($this->input->post('nama'));
            $hp = htmlspecialchars($this->input->post('hp'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $deposit = htmlspecialchars($this->input->post('deposit'));
            $tipe = 1;

            if ($this->Pengirim->insertPengirim($nama, $hp, $alamat, $deposit, $tipe) == true) {
                $this->session->set_flashdata('success', 'Pengirim berhasil ditambahkan.');
                redirect('pengirim-hutang');
            }
        } catch (\Throwable $e) {
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('pengirim-hutang');
        }
    }


    /**
     * Ubah data
     */
    public function edit($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('hp', 'No. HP', 'required|numeric|max_length[15]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('deposit', 'Deposit', 'required|numeric');


        // cek validasi form
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'pengirimhutang' => $this->Pengirim->getPengirimById($id)->row(),
                'title' => 'Edit Pengirim Hutang',
                'content' => 'pengirimhutang/v_edit_pengirim_hutang'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_update();
        }
    }

    private function _update()
    {
        try {
            $id = htmlspecialchars($this->input->post('id'));

            $nama = htmlspecialchars($this->input->post('nama'));
            $hp = htmlspecialchars($this->input->post('hp'));
            $alamat = htmlspecialchars($this->input->post('alamat'));
            $deposit = htmlspecialchars($this->input->post('deposit'));

            if ($this->Pengirim->updatePengirim($id, $nama, $hp, $alamat, $deposit) == true) {
                $this->session->set_flashdata('success', 'Pengirim berhasil diedit.');
                redirect('pengirim-hutang');
            }
        } catch (\Throwable $e) {
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('pengirim-hutang');
        }
    }



    public function bayar($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('deposit', 'Hutang', 'required|numeric');

        // cek validasi form
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'pengirimhutang' => $this->Pengirim->getPengirimById($id)->row(),
                'hutang' => $this->Deposit->getDepositByIdPengirim($id),
                'title' => 'Bayar Hutang Pengirim',
                'content' => 'pengirimhutang/v_bayar'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_bayarHutang();
        }
    }
    private function _bayarHutang()
    {
        $id = htmlspecialchars($this->input->post('id')); // id pengirim
        $deposit = htmlspecialchars($this->input->post('deposit'));

        if ($this->Pengirim->tambahDeposit($id, $deposit) == true) {
            $this->Deposit->insertDeposit($id, $deposit);

            $this->session->set_flashdata('success', 'Deposit berhasil ditambahkan.');
            redirect('pengirim-hutang/bayar/' . $id);
        } else {
            $this->session->set_flashdata('error', 'Deposit gagal ditambahkan.');
            redirect('pengirim-hutang/bayar/' . $id);
        }
    }

    // hapus deposit
    public function deleteBayar()
    {
        $id = htmlspecialchars($this->input->post('id')); // id deposit
        $idPengirim = htmlspecialchars($this->input->post('id_pengirim'));
        $deposit = htmlspecialchars($this->input->post('deposit'));

        if ($this->Deposit->deleteDeposit($id) == true) {
            $this->Pengirim->updateDeposit($idPengirim, $deposit);
            $this->session->set_flashdata('success', 'Deposit berhasil dihapus.');
            redirect('pengirim-hutang/bayar/' . $idPengirim);
        }
    }



    // hapus pengirim
    public function delete()
    {
        try {
            $id = htmlspecialchars($this->input->post('id'));
            if ($this->Pengirim->deletePengirim($id) == true) {
                $this->Deposit->deleteDepositByPengirim($id); //hapus deposit berdasar id pengirim
                $this->session->set_flashdata('success', 'Pengirim berhasil dihapus.');
                redirect('pengirim-hutang');
            }
        } catch (\Throwable $e) {
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('pengirim-hutang');
        }
    }
}

/* End of file PengirimHutangController.php */
