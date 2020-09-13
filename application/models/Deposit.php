
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deposit extends CI_Model
{

    private $_table = "deposit";

    public function getDepositByIdPengirim($id)
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->where('id_pengirim', $id)
            ->order_by('id', 'DESC')
            ->get();
        return $query;
    }

    public function insertDeposit($id, $deposit)
    {
        $data = [
            'id_pengirim' => $id,
            'deposit' => $deposit
        ];
        if ($this->db->insert($this->_table, $data)) {
            return true;
        }
    }


    public function deleteDeposit($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete($this->_table)) {
            return true;
        }
    }


    // hapus deposit berdasar id pengirim
    public function deleteDepositByPengirim($id)
    {
        $this->db->where('id_pengirim', $id);
        if ($this->db->delete($this->_table)) {
            return true;
        }
    }
}

/* End of file Deposit.php */
?>