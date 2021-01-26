<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SetHarga extends CI_Model
{

    private $_table = 'setharga';

    public function getSetHarga($id = 1)
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->where('id', $id)
            ->get();
        return $query;
    }


    // update
    public function updateSetHarga($biayaGudang, $biayaAdminGudang)
    {
        $data = [
            'biaya_gudang' => $biayaGudang,
            'biaya_admin_gudang' => $biayaAdminGudang,
        ];
        $this->db->where('id', 1);
        if ($this->db->update($this->_table, $data)) {
            return true;
        }
    }
}

/* End of file SetHarga.php */
