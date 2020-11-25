<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gaji extends CI_Model
{
    private $_table = 'gaji';

    public function getGaji() //ambilsemua harga
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->order_by('id', 'DESC')
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


    /**
     * @method Cetak Laporan
     * 
     */
    public function getPembelianByDate($bulan, $tahun)
    {
        // $query = $this->db->query("SELECT * FROM pembelian WHERE month(created_at)='$bulan' AND year(created_at)='$tahun'");
        $this->db->where('MONTH(created_at)', $bulan);
        $this->db->where('YEAR(created_at)', $tahun);
        return $this->db->get($this->_table);
    }

    public function getPembelianByPeriode($tglAwal, $tglAkhir)
    {
        $this->db->where('DATE(created_at) BETWEEN "' . $tglAwal . '" AND "' . $tglAkhir . '"', '', false);
        return $this->db->get($this->_table);
    }
}

/* End of file Harga.php */
