<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tujuan extends CI_Model
{
    private $_table = 'tujuan';

    public function getTujuan() //ambilsemua harga
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->order_by('id', 'DESC')
            ->get();
        return $query;
    }

    public function getTujuanById($id = null, $tujuanID = null) // ambil berdasar id
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->where('id', ($id != null) ? $id : $tujuanID)
            ->get();
        return $query;
    }

    public function getTujuanByKota($kota)
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->where('kota_tujuan', $kota)
            ->get();
        return $query;
    }

    public function insertTujuan($berat, $kota, $biaya)
    {
        $data = [
            'berat' => $berat,
            'kota_tujuan' => ucwords(strtolower($kota)),
            'biaya' => $biaya
        ];
        if ($this->db->insert($this->_table, $data)) {
            return true;
        }
    }

    public function updateTujuan($id, $berat, $kota, $biaya)
    {
        $data = [
            'berat' => $berat,
            'kota_tujuan' => ucwords(strtolower($kota)),
            'biaya' => $biaya
        ];
        $this->db->where('id', $id);
        if ($this->db->update($this->_table, $data)) {
            return true;
        }
    }

    public function deleteTujuan($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete($this->_table)) {
            return true;
        }
    }
}

/* End of file Tujuan.php */
