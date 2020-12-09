<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LaporanGajiController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
        $this->load->library('dompdf_gen');
        $this->load->model('Gaji');
    }


    public function index()
    {
        $data = [
            'title' => 'Laporan Gaji',
            'content' => 'laporan/v_laporan_gaji'
        ];
        $this->load->view('layout/wrapper', $data);
    }


    /**
     * @method cetak perbulan
     */
    public function cetak_perbulan()
    {
        $bulan = date('m', strtotime($this->input->post('bulan')));
        $tahun = date('Y', strtotime($this->input->post('bulan')));

        $data['title'] = 'Laporan Gaji';
        $data['datagaji'] = $this->Gaji->getGajiByDate($bulan, $tahun);

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->load->view('laporan/export/laporan_gaji', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        ob_end_clean();
        $this->dompdf->stream("laporan_gaji_perbulan.pdf", array('Attachment' => 0));
    }


    /**
     * @method cetak perperiode
     */
    public function cetak_perperiode()
    {
        $tglAwal = date('Y-m-d', strtotime($this->input->post('tgl_awal')));
        $tglAkhir = date('Y-m-d', strtotime($this->input->post('tgl_akhir')));

        $data['title'] = 'Laporan Gaji';
        $data['datagaji'] = $this->Gaji->getGajiByPeriode($tglAwal, $tglAkhir);

        $data['tgl_awal'] = $tglAwal;
        $data['tgl_akhir'] = $tglAkhir;

        $this->load->view('laporan/export/laporan_gaji', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        ob_end_clean();
        $this->dompdf->stream("laporan_gaji_perperiode.pdf", array('Attachment' => 0));
    }
}

/* End of file LaporanGajiController.php */
