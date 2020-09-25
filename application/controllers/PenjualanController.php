<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenjualanController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
        // panggil model harga
        $this->load->model('Penjualan');
        $this->load->model('Tujuan');
        $this->load->model('Pengirim');
        $this->load->model('Deposit');
    }

    public function index()
    {
        $data = [
            'penjualans' => $this->Penjualan->getPenjualan(),
            'title' => 'Penjualan',
            'content' => 'penjualan/v_penjualan'
        ];
        $this->load->view('layout/wrapper', $data);
    }


    // Tambah data penjualan
    public function tambah()
    {
        $this->form_validation->set_rules('pengirim', 'Nama pengirim', 'required');
        $this->form_validation->set_rules('penerima', 'Nama penerima', 'required');
        $this->form_validation->set_rules('tujuan', 'Kota tujuan', 'required');
        $this->form_validation->set_rules('airlines', 'Airlines', 'required');
        $this->form_validation->set_rules('no_penerbangan', 'No. penerbangan', 'required');
        $this->form_validation->set_rules('no_smu', 'No. SMU', 'required');
        $this->form_validation->set_rules('berat', 'Berat', 'required');
        $this->form_validation->set_rules('koli', 'Jumlah koli', 'required');
        $this->form_validation->set_rules('biaya_gudang', 'Biaya gudang', 'required');
        $this->form_validation->set_rules('jenis_pembayaran', 'Jenis pembayaran', 'required');


        if ($this->form_validation->run() == false) {
            $data = [
                'kotatujuan' => $this->Tujuan->getTujuan(),
                'dataPengirim' => $this->Pengirim->getPengirim(),
                'title' => 'Buat Data Penjualan',
                'content' => 'penjualan/v_tambah_penjualan'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->_simpan();
        }
    }

    private function _simpan()
    {
        $noKwitansi = htmlspecialchars($this->input->post('no_kwitansi'));
        $praPengirim = htmlspecialchars($this->input->post('pengirim'));
        $penerima = htmlspecialchars($this->input->post('penerima'));
        $kotaTujuan = htmlspecialchars($this->input->post('tujuan'));
        $airlines = htmlspecialchars($this->input->post('airlines'));
        $noPenerbangan = htmlspecialchars($this->input->post('no_penerbangan'));
        $noSMU = htmlspecialchars($this->input->post('no_smu'));
        $berat = htmlspecialchars($this->input->post('berat'));
        $koli = htmlspecialchars($this->input->post('koli'));
        $isi = htmlspecialchars($this->input->post('isi'));
        $catatan = htmlspecialchars($this->input->post('catatan'));
        $biayaGudang = htmlspecialchars($this->input->post('biaya_gudang'));
        $biayaTambahan = htmlspecialchars($this->input->post('biaya_tambahan'));
        $jenisPembayaran = htmlspecialchars($this->input->post('jenis_pembayaran'));

        // cek harga
        $id = $kotaTujuan;
        $cekHarga = $this->Tujuan->getTujuanById($id)->row();
        $biaya = $cekHarga->biaya;

        // hitung biaya
        $biayaSMU = $biaya * $berat;
        $biayaTotal = $biayaSMU + $biayaGudang + $biayaTambahan;


        // cek apakah pengirim baru atau langganan
        if (isset($_POST['tambah-baru'])) {
            $pengirim = $praPengirim;
        } elseif (isset($_POST['tambah'])) {
            $pecah = explode("-", $praPengirim); // pecah id pengirim dan nama pengirim

            $id = $pecah[0]; // id pengirim
            $pengirim = $pecah[1]; //nama pengirim

            // cek jika jenis pembayaran deposit
            if ($jenisPembayaran == 'deposit') {
                // $cekPengirim = $this->Pengirim->getPengirimById($id)->row();
                // $deposit = $cekPengirim->deposit;

                // kurangi deposit dengan totalbiaya
                $this->Pengirim->kurangiDeposit($id, $biayaTotal);
                // tambah history pengurangan deposit
                $this->Deposit->insertPengeluaran($id, $biayaTotal);
            }
        }


        if ($this->Penjualan->insertPenjualan($noKwitansi, $pengirim, $penerima, $kotaTujuan, $airlines, $noPenerbangan, $noSMU, $berat, $koli, $biayaSMU, $isi, $catatan, $biayaGudang, $biayaTambahan, $biayaTotal, $jenisPembayaran)) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
            redirect('penjualan');
        }
    }


    // Hapus penjualan
    public function delete()
    {
        $id = htmlspecialchars($this->input->post('id'));
        if ($this->Penjualan->deletePenjualan($id) == true) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus.');
            redirect('penjualan');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus.');
            redirect('penjualan');
        }
    }
}
