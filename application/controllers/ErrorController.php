<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ErrorController extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => '404'
        ];
        $this->load->view('error/404', $data);
    }
}

/* End of file ErrorController.php */
