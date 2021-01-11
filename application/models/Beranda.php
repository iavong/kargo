<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Model
{
    private $_penjualan = 'penjualan';
    private $_pembelian = 'pembelian';


    /**
     * Penjualan
     */
    public function getPenjualanToday()
    {
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');

        $this->db->select('*');
        $this->db->from($this->_penjualan);
        $this->db->where('DATE(created_at)', $curr_date); //use date function
        $this->db->where('deleted', 0); //use date function
        $query = $this->db->get();
        return $query;
    }

    public function getPenjualanThisMonth()
    {
        $date = new DateTime("now");
        $curr_date = $date->format('m');

        $this->db->select('*');
        $this->db->from($this->_penjualan);
        $this->db->where('MONTH(created_at)', $curr_date); //use date function
        $this->db->where('deleted', 0); //use date function
        $query = $this->db->get();
        return $query;
    }


    /**
     * Pembelian
     */
    public function getPembelianToday()
    {
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');

        $this->db->select('*');
        $this->db->from($this->_pembelian);
        $this->db->where('DATE(created_at)', $curr_date); //use date function
        $query = $this->db->get();
        return $query;
    }

    public function getPembelianThisMonth()
    {
        $date = new DateTime("now");
        $curr_date = $date->format('m');

        $this->db->select('*');
        $this->db->from($this->_pembelian);
        $this->db->where('MONTH(created_at)', $curr_date); //use date function
        $query = $this->db->get();
        return $query;
    }
}

/* End of file Beranda.php */
