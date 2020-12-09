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


    /**
     * @method Cetak Laporan
     * 
     */
    public function getGajiByDate($bulan, $tahun)
    {
        // $query = $this->db->query("SELECT * FROM Gaji WHERE month(created_at)='$bulan' AND year(created_at)='$tahun'");
        $this->db->where('MONTH(created_at)', $bulan);
        $this->db->where('YEAR(created_at)', $tahun);
        return $this->db->get($this->_table);
    }

    public function getGajiByPeriode($tglAwal, $tglAkhir)
    {
        $this->db->where('DATE(created_at) BETWEEN "' . $tglAwal . '" AND "' . $tglAkhir . '"', '', false);
        return $this->db->get($this->_table);
    }
}

/* End of file Harga.php */
