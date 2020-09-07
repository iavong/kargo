<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Model
{
    private $_table = 'pembelian';

    public function getPembelian() //ambilsemua harga
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->get();
        return $query;
    }

    public function getPembelianById($id) // ambil berdasar id
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->where('id', $id)
            ->get();
        return $query;
    }

    public function getPembelianByKeterangan($keterangan)
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->where('keterangan', $keterangan)
            ->get();
        return $query;
    }


    public function insertPembelian($keterangan, $harga)
    {
        $data = [
            'keterangan' => $keterangan,
            'harga' => $harga
        ];
        if ($this->db->insert($this->_table, $data)) {
            return true;
        }
    }


    public function updatePembelian($id, $keterangan, $harga)
    {
        $data = [
            'keterangan' => $keterangan,
            'harga' => $harga
        ];
        $this->db->where('id', $id);
        if ($this->db->update($this->_table, $data)) {
            return true;
        }
    }

    public function deletePembelian($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete($this->_table)) {
            return true;
        }
    }
}

/* End of file Harga.php */
