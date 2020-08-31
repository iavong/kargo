<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengirimController extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Pengirim',
            'content' => 'pengirim/v_pengirim'
        ];
        $this->load->view('layout/wrapper', $data);
    }
}

/* End of file PengirimController.php */
