<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileController extends CI_Controller
{

    public $userId;
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        } else {
            $this->userId = $this->session->userdata('id');
        }
        // load model 
        $this->load->model('User');
    }


    public function index()
    {
        $id = $this->userId;
        $nama = htmlspecialchars($this->input->post('nama'));
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars($this->input->post('password'));

        // jika tidak merubah password
        if (empty($password)) {
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[15]');
        } else {
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Password konfirmasi', 'required|trim|matches[password]');
        }

        if ($this->form_validation->run() == false) {
            $data = [
                'user' => $this->User->getUserById($id)->row(),
                'title' => 'Profile',
                'content' => 'profile/v_profile'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_updateProfile($nama, $username, $password);
        }
    }

    private function _updateProfile($nama, $username, $password)
    {
        $id = $this->userId;

        // jika merubah password
        if (empty($password)) {
            $this->User->updateProfileNoPass($id, $nama, $username);
        } else {
            $this->User->updateProfile($id, $nama, $username, $password);
        }
        $data = 'Profile berhasil diupdate. Silahkan login kembali';
        $this->_logout($data);
    }


    public function delete()
    {
        $id = htmlspecialchars($this->input->post('id'));
        if ($this->User->deleteUser($id) == true) {
            $data = 'Profile berhasil dihapus.';
        }
        $this->_logout($data);
    }


    private function _logout($data)
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');

        $this->session->set_flashdata('success', $data);

        redirect('login');
    }
}

/* End of file ProfileController.php */
