
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
}

/* End of file Deposit.php */
?>