<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengirimController extends CI_Controller
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
        $key = 0; //langganan
        $data = [
            'pengirim' => $this->Pengirim->getPengirim($key),
            'title' => 'Pengirim Langganan',
            'content' => 'pengirim/v_pengirim'
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
                'title' => 'Tambah Pengirim',
                'content' => 'pengirim/v_tambah_pengirim'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_simpan();
        }
    }

    private function _simpan()
    {
        $nama = htmlspecialchars($this->input->post('nama'));
        $hp = htmlspecialchars($this->input->post('hp'));
        $alamat = htmlspecialchars($this->input->post('alamat'));
        $deposit = htmlspecialchars($this->input->post('deposit'));
        $tipe = 0;


        if ($this->Pengirim->insertPengirim($nama, $hp, $alamat, $deposit, $tipe) == true) {
            $this->session->set_flashdata('success', 'Pengirim berhasil ditambahkan.');
            redirect('pengirim');
        } else {
            $this->session->set_flashdata('error', 'Pengirim gagal ditambahkan.');
            redirect('pengirim');
        }
    }


    // EDIT
    public function edit($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('hp', 'No. HP', 'required|numeric|max_length[15]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('deposit', 'Deposit', 'required|numeric');


        // cek validasi form
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'pengirim' => $this->Pengirim->getPengirimById($id)->row(),
                'title' => 'Edit Pengirim',
                'content' => 'pengirim/v_edit_pengirim'
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
        $hp = htmlspecialchars($this->input->post('hp'));
        $alamat = htmlspecialchars($this->input->post('alamat'));
        $deposit = htmlspecialchars($this->input->post('deposit'));


        if ($this->Pengirim->updatePengirim($id, $nama, $hp, $alamat, $deposit) == true) {
            $this->session->set_flashdata('success', 'Pengirim berhasil diedit.');
            redirect('pengirim');
        } else {
            $this->session->set_flashdata('error', 'Pengirim gagal diedit.');
            redirect('pengirim');
        }
    }


    // deposit
    public function deposit($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('deposit', 'Deposit', 'required|numeric');


        // cek validasi form
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'pengirim' => $this->Pengirim->getPengirimById($id)->row(),
                'deposit' => $this->Deposit->getDepositByIdPengirim($id),
                'title' => 'Tambah Deposit Pengirim',
                'content' => 'pengirim/v_deposit'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_tambahDeposit();
        }
    }
    private function _tambahDeposit()
    {
        $id = htmlspecialchars($this->input->post('id')); // id pengirim
        $deposit = htmlspecialchars($this->input->post('deposit'));

        if ($this->Pengirim->tambahDeposit($id, $deposit) == true) {
            $this->Deposit->insertDeposit($id, $deposit);

            $this->session->set_flashdata('success', 'Deposit berhasil ditambahkan.');
            redirect('pengirim/deposit/' . $id);
        } else {
            $this->session->set_flashdata('error', 'Deposit gagal ditambahkan.');
            redirect('pengirim/deposit/' . $id);
        }
    }

    // hapus deposit
    public function deleteDeposit()
    {
        $id = htmlspecialchars($this->input->post('id')); // id deposit
        $idPengirim = htmlspecialchars($this->input->post('id_pengirim'));
        $deposit = htmlspecialchars($this->input->post('deposit'));

        if ($this->Deposit->deleteDeposit($id) == true) {
            $this->Pengirim->updateDeposit($idPengirim, $deposit);
            $this->session->set_flashdata('success', 'Deposit berhasil dihapus.');
            redirect('pengirim/deposit/' . $idPengirim);
        }
    }


    // hapus pengirim
    public function delete()
    {
        $id = htmlspecialchars($this->input->post('id'));
        if ($this->Pengirim->deletePengirim($id) == true) {
            $this->Deposit->deleteDepositByPengirim($id); //hapus deposit berdasar id pengirim
            $this->session->set_flashdata('success', 'Pengirim berhasil dihapus.');
            redirect('pengirim');
        } else {
            $this->session->set_flashdata('error', 'Pengirim gagal dihapus.');
            redirect('pengirim');
        }
    }
}

/* End of file PengirimController.php */
