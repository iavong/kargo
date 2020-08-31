<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PenerimaController extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Penerima',
            'content' => 'penerima/v_penerima'
        ];
        $this->load->view('layout/wrapper', $data);
    }
}

/* End of file PenerimaController.php */
