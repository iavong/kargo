<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        } elseif ($this->session->userdata('role') != 1) {
            redirect('beranda');
        }
        // load model 
        $this->load->model('User');
    }


    public function index()
    {
        $data = [
            'users' => $this->User->getUser(),
            'title' => 'Kelola User',
            'content' => 'users/v_user'
        ];
        $this->load->view('layout/wrapper', $data);
    }


    ##########################################################
    # Tambah User
    ##########################################################
    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password konfirmasi', 'required|trim|matches[password]');


        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Tambah User',
                'content' => 'users/v_tambah_user'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_simpan();
        }
    }
    private function _simpan()
    {
        $nama = htmlspecialchars($this->input->post('nama'));
        $username = htmlspecialchars($this->input->post('username'));
        $role = htmlspecialchars($this->input->post('role'));
        $password = htmlspecialchars($this->input->post('password'));

        if ($this->User->insertUser($nama, $username, $role, $password) == true) {
            $this->session->set_flashdata('success', 'User berhasil ditambahkan.');
            redirect('user');
        } else {
            $this->session->set_flashdata('error', 'User gagal ditambahkan.');
            redirect('user');
        }
    }


    ##########################################################
    # Edit User
    ##########################################################
    public function edit($id)
    {
        $nama = htmlspecialchars($this->input->post('nama'));
        $username = htmlspecialchars($this->input->post('username'));
        $role = htmlspecialchars($this->input->post('role'));
        $password = htmlspecialchars($this->input->post('password'));

        // set rule
        if (empty($password)) { // ketika tidak merubah password user
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[15]');
            $this->form_validation->set_rules('role', 'Role', 'required');
        } else {
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Password konfirmasi', 'required|trim|matches[password]');
        }
        // cek validasi form
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'user' => $this->User->getUserById($id)->row(),
                'title' => 'Edit User',
                'content' => 'users/v_edit_user'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_update($nama, $username, $role, $password);
        }
    }

    private function _update($nama, $username, $role, $password)
    {
        $id = htmlspecialchars($this->input->post('id'));

        if (empty($password)) {
            $this->User->updateUserNoPass($id, $nama, $username, $role);
        } else {
            $this->User->updateUser($id, $nama, $username, $role, $password);
        }
        $this->session->set_flashdata('success', 'User berhasil diedit.');
        redirect('user');
    }


    ##########################################################
    # Delete User
    ##########################################################
    public function delete()
    {
        $id = htmlspecialchars($this->input->post('id'));
        if ($this->User->deleteUser($id) == true) {
            $this->session->set_flashdata('success', 'User berhasil dihapus.');
            redirect('user');
        } else {
            $this->session->set_flashdata('error', 'User gagal dihapus.');
            redirect('user');
        }
    }
}

/* End of file UserController.php */
