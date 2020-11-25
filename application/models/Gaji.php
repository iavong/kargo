<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gaji extends CI_Model
{
    private $_table = 'gaji';

    /**
     * get by id
     * $id = null ambil semua gaji
     */
    public function getGaji($id = null) //ambilsemua harga
    {
        $this->db->select('*')
            ->from($this->_table);

        if (isset($id)) {
            $this->db->where('id', $id);
        }

        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query;
    }


    public function insertGaji($nama, $keterangan, $totalGaji)
    {
        $data = [
            'nama' => $nama,
            'keterangan' => $keterangan,
            'total_gaji' => $totalGaji
        ];
        if ($this->db->insert($this->_table, $data)) {
            return true;
        }
    }


    public function updateGaji($id, $nama, $keterangan, $totalGaji)
    {
        $data = [
            'nama' => $nama,
            'keterangan' => $keterangan,
            'total_gaji' => $totalGaji
        ];
        $this->db->where('id', $id);
        if ($this->db->update($this->_table, $data)) {
            return true;
        }
    }


    public function deleteGaji($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete($this->_table)) {
            return true;
        }
    }
}

/* End of file Harga.php */
