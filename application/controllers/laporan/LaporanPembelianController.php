<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPembelianController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
        $this->load->model('Pembelian');
    }


    public function index()
    {
        $data = [
            'title' => 'Laporan Pembelian',
            'content' => 'laporan/v_laporan_pembelian'
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

        $data['title'] = 'Laporan Pembelian';
        $data['datapembelian'] = $this->Pembelian->getPembelianByDate($bulan, $tahun);
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->load->view('laporan/export/laporan_pembelian', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        ob_end_clean();
        $this->dompdf->stream("laporan_pembelian_perbulan.pdf", array('Attachment' => 0));
    }


    /**
     * @method cetak perperiode
     */
    public function cetak_perperiode()
    {
        $this->load->library('dompdf_gen');

        $tglAwal = date('Y-m-d', strtotime($this->input->post('tgl_awal')));
        $tglAkhir = date('Y-m-d', strtotime($this->input->post('tgl_akhir')));

        $data['title'] = 'Laporan Pembelian';
        $data['datapembelian'] = $this->Pembelian->getPembelianByPeriode($tglAwal, $tglAkhir);
        $data['tgl_awal'] = $tglAwal;
        $data['tgl_akhir'] = $tglAkhir;

        $this->load->view('laporan/export/laporan_pembelian', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        ob_end_clean();
        $this->dompdf->stream("laporan_pembelian_perperiode.pdf", array('Attachment' => 0));
    }
}

/* End of file LaporanPembelianController.php */
