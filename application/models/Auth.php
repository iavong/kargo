<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Model
{
    private $_table = 'users';

    public function getUserByUsername($username)
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->where('username', $username)
            ->get();
        return $query;
    }
}

/* End of file Auth.php */
