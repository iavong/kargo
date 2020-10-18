<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPenjualanController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
        $this->load->model('Penjualan');
        $this->load->model('Pengirim');
        // date_default_timezone_set("Asia/Jakarta");
        error_reporting(0);
    }

    public function index()
    {
        $key = null;
        $data = [
            'penjualan' => $this->Penjualan->getPenjualanByNow(),
            'pengirims' => $this->Pengirim->getPengirim($key),
            'title' => 'Laporan Penjualan',
            'content' => 'laporan/v_laporan_penjualan'
        ];
        $this->load->view('layout/wrapper', $data);
    }

    /**
     * @method cetak perbulan
     */
    public function cetak_perbulan()
    {
        $this->load->library('dompdf_gen');

        $bulan = date('m', strtotime($this->input->post('bulan')));
        $tahun = date('Y', strtotime($this->input->post('bulan')));
        // $tahun = $this->input->post('tahun');

        $data['title'] = 'Laporan Penjualan';
        $data['datapenjualan'] = $this->Penjualan->getPenjualanByDate($bulan, $tahun);
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->load->view('laporan/export/laporan_penjualan', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        ob_end_clean();
        $this->dompdf->stream("laporan_penjualan_perbulan.pdf", array('Attachment' => 0));
    }


    /**
     * @method cetak perperiode
     */
    public function cetak_perperiode()
    {
        $this->load->library('dompdf_gen');

        $tglAwal = date('Y-m-d', strtotime($this->input->post('tgl_awal')));
        $tglAkhir = date('Y-m-d', strtotime($this->input->post('tgl_akhir')));

        $data['title'] = 'Laporan Penjualan';
        $data['datapenjualan'] = $this->Penjualan->getPenjualanByPeriode($tglAwal, $tglAkhir);
        $data['tgl_awal'] = $tglAwal;
        $data['tgl_akhir'] = $tglAkhir;

        $this->load->view('laporan/export/laporan_penjualan', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        ob_end_clean();
        $this->dompdf->stream("laporan_penjualan_perperiode.pdf", array('Attachment' => 0));
    }
}

/* End of file LaporanPenjualanController.php */
