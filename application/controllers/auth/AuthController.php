<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth');
    }



    public function index()
    {
        if (!empty($this->session->userdata('username'))) {
            redirect('beranda');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[25]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/v_login');
        } else {
            // jalankan function login
            $this->_login();
        }
    }


    private function _login()
    {

        $username    = $this->input->post('username');
        $password    = $this->input->post('password');

        $user = $this->Auth->getUserByUsername($username)->row();

        // cek user exist
        if ($user) {
            // pass verify
            if (password_verify($password, $user->password)) {
                $data = [
                    'id'       => $user->id,
                    'nama'     => $user->nama,
                    'username' => $user->username,
                    'role'     => $user->role,
                ];
                $this->session->set_userdata($data);
                echo "<b>login berhasil...</b><meta http-equiv='refresh' content='1;URL=beranda'>";
                // redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Password salah.');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('error', 'Username tidak ditemukan.');
            redirect('login');
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');

        $this->session->set_flashdata('success', 'Logout berhasil!');
        redirect('login');
    }
}
