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
        $data = [
            'user' => $this->User->getUserById($id)->row(),
            'title' => 'Profile',
            'content' => 'profile/v_profile'
        ];
        $this->load->view('layout/wrapper', $data);
    }
}

/* End of file ProfileController.php */
