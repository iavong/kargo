<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Model
{

    private $_table = "penjualan";
    private $_join = "tujuan";
    private $_trash = "trash";

    public function getPenjualan()
    {
        $query = $this->db->select('p.*, t.kota_tujuan')
            ->from($this->_table . ' p')
            ->join($this->_join . ' t', 'p.tujuan_id=t.id', 'left')
            ->order_by('p.id', 'DESC')
            ->get();
        return $query;
    }


    public function getPenjualanById($id)
    {
        $query = $this->db->select('p.*, t.kota_tujuan ,t.biaya biaya_tujuan')
            ->from($this->_table . ' p')
            ->join($this->_join . ' t', 'p.tujuan_id=t.id', 'left')
            ->where('p.id', $id)
            ->order_by('p.id', 'DESC')
            ->get();
        return $query;
    }

    public function getPenjualanByIdPenjualan($idPenjualan)
    {
        $query = $this->db->select('p.*, t.kota_tujuan ,t.biaya biaya_tujuan')
            ->from($this->_table . ' p')
            ->join($this->_join . ' t', 'p.tujuan_id=t.id', 'left')
            ->where('p.id', $idPenjualan)
            ->order_by('p.id', 'DESC')
            ->get();
        return $query;
    }

    public function getPenjualanByNow()
    {
        // $today = date('Y-m-d');

        $query = $this->db->select('p.*, t.kota_tujuan')
            ->from($this->_table . ' p')
            ->join($this->_join . ' t', 't.id = p.tujuan_id')
            // ->where('DATE(created_at) "' . $today . '"', '', false)
            ->where('date_format(created_at,"%Y-%m-%d")', 'CURDATE()', FALSE)
            ->get();
        return $query;
    }

    public function getPenjualanByMonth()
    {
        $bulan = date('m');
        $tahun = date('Y');

        $query = $this->db->select('p.*, t.kota_tujuan')
            ->from($this->_table . ' p')
            ->join($this->_join . ' t', 't.id = p.tujuan_id')
            ->where('MONTH(created_at)', $bulan)
            ->where('YEAR(created_at)', $tahun)
            ->get();
        return $query;
    }

    public function getKwitansiMax() //cek no kwitansi terakhir
    {
        $this->db->select_max('no_kwitansi');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query;
    }
    public function getNewKwitansi($autoId, $prefix) //generate no kwitansi baru
    {
        $newId = substr($autoId, 1, 4);
        $tambah = (int) $newId + 1;
        if (strlen($tambah) == 1) {
            $noKwitansi = $prefix . "000" . $tambah;
        } else if (strlen($tambah) == 2) {
            $noKwitansi = $prefix . "00" . $tambah;
        } else if (strlen($tambah) == 3) {
            $noKwitansi = $prefix . "0" . $tambah;
        } else if (strlen($tambah) == 4) {
            $noKwitansi = $prefix . $tambah;
        }
        return $noKwitansi;
    }


    // simpan data penjualan
    public function insertPenjualan($noKwitansi, $id = null, $pengirim, $penerima, $kotaTujuan, $airlines, $noPenerbangan, $noSMU, $berat, $koli, $customHarga = null, $biaya, $biayaSMU, $adminSMU, $biayaOperasional, $totalOperasional, $isi, $catatan, $hargaGudang, $adminGudang, $biayaGudang, $biayaTambahan, $biayaTotal, $jenisPembayaran)
    {
        $data = [
            'no_kwitansi' => $noKwitansi,
            'airlines' => $airlines,
            'no_penerbangan' => $noPenerbangan,
            'no_smu' => $noSMU,
            'berat' => $berat,
            'koli' => $koli,
            'custom_harga' => $customHarga,
            'harga_smu' => $biaya, // harga mentah smu
            'biaya_smu' => $biayaSMU, // biaya * berat
            'biaya_admin_smu' => $adminSMU,
            'biaya_operasional' => $biayaOperasional,
            'total_operasional' => $totalOperasional,
            'harga_gudang' => $hargaGudang,
            'harga_admin_gudang' => $adminGudang,
            'total_biaya_gudang' => $biayaGudang, // proses harga gudang & admin gudang
            'biaya_tambahan' => $biayaTambahan,
            'biaya_total' => $biayaTotal, // biayaSMU+biayaGudang+biayaTambahan
            'isi' => $isi,
            'catatan' => $catatan,
            'id_pengirim' => $id,
            'pengirim' => $pengirim,
            'penerima' => $penerima,
            'tujuan_id' => $kotaTujuan,
            'jenis_pembayaran' => $jenisPembayaran,
        ];
        if ($this->db->insert($this->_table, $data)) {
            return true;
        } else {
            return false;
        }
    }


    // simpan data penjualan
    public function updatePenjualan($idPenjualan, $penerima, $kotaTujuan, $airlines, $noPenerbangan, $noSMU, $berat, $koli, $customHarga = null, $biaya, $biayaSMU, $adminSMU, $biayaOperasional, $totalOperasional, $isi, $catatan, $hargaGudang, $adminGudang, $biayaGudang, $biayaTambahan, $biayaTotal, $jenisPembayaran, $status = 'Edited')
    {
        $data = [
            'airlines' => $airlines,
            'no_penerbangan' => $noPenerbangan,
            'no_smu' => $noSMU,
            'berat' => $berat,
            'koli' => $koli,
            'custom_harga' => $customHarga,
            'harga_smu' => $biaya, // harga mentah smu
            'biaya_smu' => $biayaSMU, // biaya * berat
            'biaya_admin_smu' => $adminSMU,
            'biaya_operasional' => $biayaOperasional,
            'total_operasional' => $totalOperasional,
            'harga_gudang' => $hargaGudang,
            'harga_admin_gudang' => $adminGudang,
            'total_biaya_gudang' => $biayaGudang, // proses harga gudang & admin gudang
            'biaya_tambahan' => $biayaTambahan,
            'biaya_total' => $biayaTotal, // biayaSMU+biayaGudang+biayaTambahan
            'isi' => $isi,
            'catatan' => $catatan,
            'penerima' => $penerima,
            'tujuan_id' => $kotaTujuan,
            'jenis_pembayaran' => $jenisPembayaran,
            'status' => $status,
        ];
        $this->db->where('id', $idPenjualan);
        if ($this->db->update($this->_table, $data)) {
            return true;
        }
    }


    public function getMaxIdPenjualan()
    {
        $maxid = $this->db->query('SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "' . $this->db->database . '" AND TABLE_NAME = "' . $this->_table . '"');
        return $maxid->row();
    }



    // hapus
    public function deletePenjualan($id)
    {
        $data = [
            'deleted' => 1
        ];
        $this->db->where('id', $id);
        if ($this->db->update($this->_table, $data)) {
            return true;
        }
    }


    /**
     * @method cetak nota
     */
    public function cetakNotaPenjualan($id)
    {
        $query = $this->db->select('p.*, t.kota_tujuan')
            ->from($this->_table . ' p')
            ->join($this->_join . ' t', 't.id = p.tujuan_id')
            ->where('p.id', $id)
            ->get();
        return $query;
    }


    /**
     * @method Cetak Laporan
     * 
     */
    public function getPenjualanByDate($bulan, $tahun)
    {
        // $query = $this->db->query("SELECT * FROM Penjualan WHERE month(created_at)='$bulan' AND year(created_at)='$tahun'");
        $query = $this->db->select('p.*, t.kota_tujuan')
            ->from($this->_table . ' p')
            ->join($this->_join . ' t', 't.id = p.tujuan_id')
            ->where('MONTH(created_at)', $bulan)
            ->where('YEAR(created_at)', $tahun)
            ->get();
        return $query;
    }

    public function getPenjualanByPeriode($tglAwal, $tglAkhir)
    {
        $query = $this->db->select('p.*, t.kota_tujuan')
            ->from($this->_table . ' p')
            ->join($this->_join . ' t', 't.id = p.tujuan_id')
            ->where('DATE(created_at) BETWEEN "' . $tglAwal . '" AND "' . $tglAkhir . '"', '', false)
            ->get();
        return $query;
    }


    /**
     * @method trash
     * 
     */
    public function insertTrash($id, $noKwitansi)
    {
        $data = [
            'penjualan_id' => $id,
            'no_kwitansi' => $noKwitansi,
        ];
        if ($this->db->insert($this->_trash, $data)) {
            return true;
        }
    }
}

/* End of file Penjualan.php */
