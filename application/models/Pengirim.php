<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengirim extends CI_Model
{

    private $_table = 'pengirim';

    public function getPengirim($key)
    {
        $this->db->select('*')
            ->from($this->_table)
            ->order_by('id', 'DESC');

        if ($key !== null) {
            $this->db->where('tipe', $key);
        }
        return $this->db->get();
    }

    public function getPengirimById($id)
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->where('id', $id)
            ->get();
        return $query;
    }


    // simpan
    public function insertPengirim($nama, $hp, $alamat, $deposit, $tipe)
    {
        $data = [
            'nama' => $nama,
            'no_hp' => $hp,
            'alamat' => $alamat,
            'deposit' => $deposit,
            'tipe' => $tipe
        ];
        if ($this->db->insert($this->_table, $data)) {
            return true;
        }
    }

    // update
    public function updatePengirim($id, $nama, $hp, $alamat, $deposit)
    {
        $data = [
            'nama' => $nama,
            'no_hp' => $hp,
            'alamat' => $alamat,
            'deposit' => $deposit
        ];
        $this->db->where('id', $id);
        if ($this->db->update($this->_table, $data)) {
            return true;
        }
    }

    // tambah deposit
    public function tambahDeposit($id, $deposit)
    {
        $this->db->set('deposit', 'deposit+' . $deposit, FALSE);
        $this->db->where('id', $id);
        if ($this->db->update($this->_table)) {
            return true;
        }
    }

    // replace deposit saat update penjualan
    public function replaceDeposit($id, $deposit) // $id = id pengirim
    {
        $data = [
            'deposit' => $deposit,
        ];
        $this->db->where('id', $id);
        if ($this->db->update($this->_table, $data)) {
            return true;
        }
    }

    // kurangi deposit ketika menghapus history
    public function updateDeposit($idPengirim, $deposit)
    {
        $this->db->set('deposit', 'deposit-' . $deposit, FALSE);
        $this->db->where('id', $idPengirim);
        if ($this->db->update($this->_table)) {
            return true;
        }
    }

    // kurangi deposit ketika melakukan order
    public function kurangiDeposit($id, $biayaTotal)
    {
        $this->db->set('deposit', 'deposit-' . $biayaTotal, FALSE);
        $this->db->where('id', $id);
        if ($this->db->update($this->_table)) {
            return true;
        }
    }

    // hapus
    public function deletePengirim($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete($this->_table)) {
            return true;
        }
    }
}

/* End of file Pengirim.php */
