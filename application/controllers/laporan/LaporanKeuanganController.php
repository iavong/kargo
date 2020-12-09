<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanKeuanganController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
        $this->load->model('Pembelian');
        $this->load->model('Penjualan');
    }


    public function index()
    {
        $data = [
            'title' => 'Laporan Keuangan',
            'content' => 'laporan/v_laporan_keuangan'
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

        $data['title'] = 'Laporan Keuangan';
        $data['datapembelian'] = $this->Pembelian->getPembelianByDate($bulan, $tahun);
        $data['datapenjualan'] = $this->Penjualan->getPenjualanByDate($bulan, $tahun);
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->load->view('laporan/export/laporan_keuangan', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        ob_end_clean();
        $this->dompdf->stream("laporan_keuangan_perbulan.pdf", array('Attachment' => 0));
    }


    /**
     * @method cetak perperiode
     */
    public function cetak_perperiode()
    {
        $this->load->library('dompdf_gen');

        $tglAwal = date('Y-m-d', strtotime($this->input->post('tgl_awal')));
        $tglAkhir = date('Y-m-d', strtotime($this->input->post('tgl_akhir')));

        $data['title'] = 'Laporan Keuangan';
        $data['datapembelian'] = $this->Pembelian->getPembelianByPeriode($tglAwal, $tglAkhir);
        $data['datapenjualan'] = $this->Penjualan->getPenjualanByPeriode($tglAwal, $tglAkhir);
        // $keuangan = [
        //     'datapembelian' => $this->Pembelian->getPembelianByPeriode($tglAwal, $tglAkhir),
        //     'datapenjualan' => $this->Penjualan->getPenjualanByPeriode($tglAwal, $tglAkhir)
        // ];
        // $data['dataKeuangan'] = $keuangan;

        // var_dump($data['dataKeuangan']);
        // die;


        $data['tgl_awal'] = $tglAwal;
        $data['tgl_akhir'] = $tglAkhir;

        $this->load->view('laporan/export/laporan_keuangan', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        ob_end_clean();
        $this->dompdf->stream("laporan_keuangan_perperiode.pdf", array('Attachment' => 0));
    }
}

/* End of file LaporanKeuanganController.php */
