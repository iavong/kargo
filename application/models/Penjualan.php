<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Model
{

    private $_table = "penjualan";
    private $_join = "tujuan";

    public function getPenjualan()
    {
        $query = $this->db->select('p.*, t.kota_tujuan')
            ->from($this->_table . ' p')
            ->join($this->_join . ' t', 'p.tujuan_id=t.id', 'left')
            ->order_by('p.id', 'DESC')
            ->get();
        return $query;
    }


    // simpan data penjualan
    public function insertPenjualan($noKwitansi, $pengirim, $penerima, $kotaTujuan, $airlines, $noPenerbangan, $noSMU, $berat, $koli, $isi, $catatan, $biayaGudang, $biayaTambahan, $jenisPembayaran, $biaya)
    {
        $biayaSMU = $biaya * $berat;
        $biayaTotal = $biayaSMU + $biayaGudang + $biayaTambahan;

        $data = [
            'no_kwitansi' => $noKwitansi,
            'airlines' => $airlines,
            'no_penerbangan' => $noPenerbangan,
            'no_smu' => $noSMU,
            'berat' => $berat,
            'koli' => $koli,
            'biaya_smu' => $biayaSMU,
            'biaya_gudang' => $biayaGudang,
            'biaya_tambahan' => $biayaTambahan,
            'biaya_total' => $biayaTotal,
            'isi' => $isi,
            'catatan' => $catatan,
            'pengirim' => $pengirim,
            'penerima' => $penerima,
            'tujuan_id' => $kotaTujuan,
            'jenis_pembayaran' => $jenisPembayaran,
        ];
        if ($this->db->insert($this->_table, $data)) {
            return true;
        }
    }



    // hapus
    public function deletePenjualan($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete($this->_table)) {
            return true;
        }
    }
}

/* End of file Penjualan.php */