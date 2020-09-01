<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Model
{

    private $_table = 'users';

    public function getUser()
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->get();
        return $query;
    }

    public function getUserById($id)
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->where('id', $id)
            ->get();
        return $query;
    }

    public function insertUser($nama, $username, $role, $password)
    {
        $data = [
            'nama' => $nama,
            'username' => $username,
            'role' => $role,
            'password' => password_hash($password, PASSWORD_DEFAULT) //encrypsi password
        ];
        if ($this->db->insert($this->_table, $data)) {
            return true;
        }
    }

    public function updateUser($id, $nama, $username, $role, $password)
    {
        $data = [
            'nama' => $nama,
            'username' => $username,
            'role' => $role,
            'password' => password_hash($password, PASSWORD_DEFAULT) //encrypsi password
        ];
        $this->db->where('id', $id);
        if ($this->db->update($this->_table, $data)) {
            return true;
        }
    }

    public function deleteUser($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete($this->_table)) {
            return true;
        }
    }
}

/* End of file User.php */
