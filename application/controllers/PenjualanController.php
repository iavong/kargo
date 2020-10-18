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
        $this->form_validation->set_rules('admin_smu', 'Biaya Admin SMU', 'required');
        $this->form_validation->set_rules('airlines', 'Airlines', 'required');
        $this->form_validation->set_rules('no_penerbangan', 'No. penerbangan', 'required');
        $this->form_validation->set_rules('no_smu', 'No. SMU', 'required');
        $this->form_validation->set_rules('berat', 'Berat', 'required');
        $this->form_validation->set_rules('koli', 'Jumlah koli', 'required');
        $this->form_validation->set_rules('biaya_gudang', 'Biaya gudang', 'required');
        $this->form_validation->set_rules('admin_gudang', 'Biaya admin gudang', 'required');


        if ($this->form_validation->run() == false) {
            $key = null;
            $data = [
                'no_kwitansi' => $this->getNoKwitansi(),
                'kotatujuan' => $this->Tujuan->getTujuan(),
                'dataPengirim' => $this->Pengirim->getPengirim($key),
                'title' => 'Buat Data Penjualan',
                'content' => 'penjualan/v_tambah_penjualan'
            ];
            $this->load->view('layout/wrapper', $data);
        }
        // tombol simpan ditekan
        else {
            $noKwitansi = htmlspecialchars($this->input->post('no_kwitansi'));
            $praPengirim = htmlspecialchars($this->input->post('pengirim'));
            $penerima = htmlspecialchars($this->input->post('penerima'));
            $kotaTujuan = htmlspecialchars($this->input->post('tujuan'));
            $customHarga = htmlspecialchars($this->input->post('custom_harga'));
            $airlines = htmlspecialchars($this->input->post('airlines'));
            $noPenerbangan = htmlspecialchars($this->input->post('no_penerbangan'));
            $noSMU = htmlspecialchars($this->input->post('no_smu'));
            $berat = htmlspecialchars($this->input->post('berat'));
            $koli = htmlspecialchars($this->input->post('koli'));
            $isi = htmlspecialchars($this->input->post('isi'));
            $catatan = htmlspecialchars($this->input->post('catatan'));
            $hargaGudang = htmlspecialchars($this->input->post('biaya_gudang'));
            $adminSMU = htmlspecialchars($this->input->post('admin_smu'));
            $adminGudang = htmlspecialchars($this->input->post('admin_gudang'));
            $biayaTambahan = htmlspecialchars($this->input->post('biaya_tambahan'));
            $jenisPembayaran = htmlspecialchars($this->input->post('jenis_pembayaran'));

            // cek harga
            if (empty($customHarga)) {
                $id = $kotaTujuan;
                $cekHarga = $this->Tujuan->getTujuanById($id)->row();
                $biaya = $cekHarga->biaya; // biaya berdasarkan kota tujuan
            } else {
                $biaya = $customHarga;
            }

            // hitung biaya
            $biayaSMU = ($biaya * $berat) + $adminSMU;
            $biayaGudang = ($hargaGudang * $berat) + $adminGudang;
            $biayaTotal = $biayaSMU + $biayaGudang + $biayaTambahan;

            // echo json_encode($biayaTotal);
            $this->_simpan($biaya, $biayaSMU, $biayaGudang, $biayaTotal);
        }
    }

    public function getNoKwitansi() // proses no kwitansi
    {
        $newKwitansi =  $this->Penjualan->getKwitansiMax()->result();
        if ($newKwitansi > 0) {
            foreach ($newKwitansi as $key) {
                $autoKwitansi = $key->no_kwitansi;
            }
        }
        return $no_kwitansi = $this->Penjualan->getNewKwitansi($autoKwitansi, '1');
    }


    private function _simpan($biaya, $biayaSMU, $biayaGudang, $biayaTotal)
    {
        $noKwitansi = htmlspecialchars($this->input->post('no_kwitansi'));
        $praPengirim = htmlspecialchars($this->input->post('pengirim'));
        $penerima = htmlspecialchars($this->input->post('penerima'));
        $kotaTujuan = htmlspecialchars($this->input->post('tujuan'));
        $customHarga = htmlspecialchars($this->input->post('custom_harga'));
        $airlines = htmlspecialchars($this->input->post('airlines'));
        $noPenerbangan = htmlspecialchars($this->input->post('no_penerbangan'));
        $noSMU = htmlspecialchars($this->input->post('no_smu'));
        $berat = htmlspecialchars($this->input->post('berat'));
        $koli = htmlspecialchars($this->input->post('koli'));
        $isi = htmlspecialchars($this->input->post('isi'));
        $catatan = htmlspecialchars($this->input->post('catatan'));
        $hargaGudang = htmlspecialchars($this->input->post('biaya_gudang'));
        $adminSMU = htmlspecialchars($this->input->post('admin_smu'));
        $adminGudang = htmlspecialchars($this->input->post('admin_gudang'));
        $biayaTambahan = htmlspecialchars($this->input->post('biaya_tambahan'));
        $jenisPembayaran = htmlspecialchars($this->input->post('jenis_pembayaran'));


        // cek apakah pengirim baru atau langganan
        if ($praPengirim == 0) {
            $pengirim = htmlspecialchars($this->input->post('pengirim_baru'));
        } else {
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


        if ($this->Penjualan->insertPenjualan($noKwitansi, $pengirim, $penerima, $kotaTujuan, $airlines, $noPenerbangan, $noSMU, $berat, $koli, $biaya, $biayaSMU, $adminSMU, $isi, $catatan, $hargaGudang, $adminGudang, $biayaGudang, $biayaTambahan, $biayaTotal, $jenisPembayaran)) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
            redirect('penjualan');
        }
    }

    // cek total harga
    public function cekHarga()
    {
        $kotaTujuan = htmlspecialchars($this->input->post('tujuan'));
        $customHarga = htmlspecialchars($this->input->post('custom_harga'));
        $berat = htmlspecialchars($this->input->post('berat'));
        $hargaGudang = htmlspecialchars($this->input->post('biaya_gudang'));
        $adminSMU = htmlspecialchars($this->input->post('admin_smu'));
        $adminGudang = htmlspecialchars($this->input->post('admin_gudang'));
        $biayaTambahan = htmlspecialchars($this->input->post('biaya_tambahan'));

        // cek harga
        if (empty($customHarga)) {
            $id = $kotaTujuan;
            $cekHarga = $this->Tujuan->getTujuanById($id)->row();
            $biaya = $cekHarga->biaya; // biaya berdasarkan kota tujuan
        } else {
            $biaya = $customHarga;
        }

        if ($berat <= 10) {
            $berat = 10;
        }

        // hitung biaya
        $biayaSMU = ($biaya * $berat) + $adminSMU;
        $biayaGudang = ($hargaGudang * $berat) + $adminGudang;
        $biayaTotal = $biayaSMU + $biayaGudang + $biayaTambahan;

        $data['biaya'] = $biaya;
        $data['berat'] = $berat;
        $data['adminSMU'] = $adminSMU;
        $data['biayaSMU'] = $biayaSMU;

        $data['hargaGudang'] = $hargaGudang;
        $data['adminGudang'] = $adminGudang;
        $data['biayaTambahan'] = $biayaTambahan;
        $data['biayaGudang'] = $biayaGudang;

        $data['biayaTotal'] = $biayaTotal;

        echo json_encode($data); // over total ke view
    }



    #### DETAIL
    public function detail($id)
    {
        $data = [
            'penjualan' => $this->Penjualan->getPenjualanById($id)->row(),
            'title' => 'Detail Penjualan',
            'content' => 'penjualan/v_detail_penjualan'
        ];
        $this->load->view('layout/wrapper', $data);
    }


    public function getHarga()
    {
        $id = $this->input->post('id');
        $items = $this->Tujuan->getTujuanById($id)->row();
        echo json_encode($items);
    }

    public function cekTipePengirim()
    {
        $id = $this->input->post('id');
        $pengirim = $this->Pengirim->getPengirimById($id)->row();
        echo json_encode($pengirim);
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
