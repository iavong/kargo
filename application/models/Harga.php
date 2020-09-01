<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Harga extends CI_Model
{
    private $_table = 'harga';

    public function getHarga() //ambilsemua harga
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->get();
        return $query;
    }

    public function getHargaById($id) // ambil berdasar id
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->where('id', $id)
            ->get();
        return $query;
    }

    public function getHargaByKota($kota)
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->where('kota_tujuan', $kota)
            ->get();
        return $query;
    }

    public function insertHarga($berat, $kota, $biaya)
    {
        $data = [
            'berat' => $berat,
            'kota_tujuan' => $kota,
            'biaya' => $biaya
        ];
        if ($this->db->insert($this->_table, $data)) {
            return true;
        }
    }

    public function updateHarga($id, $berat, $kota, $biaya)
    {
        $data = [
            'berat' => $berat,
            'kota_tujuan' => $kota,
            'biaya' => $biaya
        ];
        $this->db->where('id', $id);
        if ($this->db->update($this->_table, $data)) {
            return true;
        }
    }

    public function deleteHarga($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete($this->_table)) {
            return true;
        }
    }
}

/* End of file Harga.php */
