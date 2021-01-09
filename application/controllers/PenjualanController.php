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
        $this->load->library('dompdf_gen');
        error_reporting(0);
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
        $this->form_validation->set_rules('biaya_operasional', 'Biaya Operasional', 'required');
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
            $biayaOperasional = htmlspecialchars($this->input->post('biaya_operasional'));
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

            if ($berat <= 10) {
                $berat = 10;
            }

            // hitung biaya
            $biayaSMU = ($biaya * $berat) + $adminSMU;
            $biayaGudang = ($hargaGudang * $berat) + $adminGudang;
            $totalOperasional = $biayaOperasional * $berat;
            $biayaTotal = $biayaSMU + $biayaGudang + $biayaTambahan + $totalOperasional;

            // echo json_encode($biayaTotal);
            $this->_simpan($biaya, $biayaSMU, $biayaGudang, $totalOperasional, $biayaTotal);
        }
    }

    private function _simpan($biaya, $biayaSMU, $biayaGudang, $totalOperasional, $biayaTotal)
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
        $biayaOperasional = htmlspecialchars($this->input->post('biaya_operasional'));
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
                // kurangi deposit dengan totalbiaya
                $this->Pengirim->kurangiDeposit($id, $biayaTotal);
                // tambah history pengurangan deposit
                $penjualanID = $this->Penjualan->getMaxIdPenjualan()->AUTO_INCREMENT;
                $this->Deposit->insertPengeluaran($id, $penjualanID, $biayaTotal);
            }
        }

        if ($this->Penjualan->insertPenjualan($noKwitansi, $id, $pengirim, $penerima, $kotaTujuan, $airlines, $noPenerbangan, $noSMU, $berat, $koli, $customHarga, $biaya, $biayaSMU, $adminSMU, $biayaOperasional, $totalOperasional, $isi, $catatan, $hargaGudang, $adminGudang, $biayaGudang, $biayaTambahan, $biayaTotal, $jenisPembayaran)) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
            redirect('penjualan');
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



    // cek total harga
    public function cekHarga()
    {
        $kotaTujuan = htmlspecialchars($this->input->post('tujuan'));
        $customHarga = htmlspecialchars($this->input->post('custom_harga'));
        $berat = htmlspecialchars($this->input->post('berat'));
        $hargaGudang = htmlspecialchars($this->input->post('biaya_gudang'));
        $adminSMU = htmlspecialchars($this->input->post('admin_smu'));
        $biayaOperasional = htmlspecialchars($this->input->post('biaya_operasional'));
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
        $totalOperasional = $biayaOperasional * $berat;
        $biayaTotal = $biayaSMU + $biayaGudang + $biayaTambahan + $totalOperasional;
        // $biayaTotal = $biayaSMU + $biayaGudang + $biayaTambahan;

        $data['biaya'] = $biaya;
        $data['berat'] = $berat;
        $data['adminSMU'] = $adminSMU;
        $data['biayaSMU'] = $biayaSMU;

        $data['biayaOperasional'] = $biayaOperasional;
        $data['totalOperasional'] = $totalOperasional;

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
    public function cekCustomHarga()
    {
        $id = $this->input->post('idUser');
        $items = $this->Penjualan->getPenjualanById($id)->row();
        echo json_encode($items);
    }

    public function cekTipePengirim()
    {
        $id = $this->input->post('id');
        $pengirim = $this->Pengirim->getPengirimById($id)->row();
        echo json_encode($pengirim);
    }





    /**
     * @method EDIT PENJUALAN
     * 
     */
    public function edit($id)
    {
        $this->form_validation->set_rules('pengirim', 'Nama pengirim', 'required');
        $this->form_validation->set_rules('penerima', 'Nama penerima', 'required');
        $this->form_validation->set_rules('tujuan', 'Kota tujuan', 'required');
        $this->form_validation->set_rules('admin_smu', 'Biaya Admin SMU', 'required');
        $this->form_validation->set_rules('biaya_operasional', 'Biaya Operasional', 'required');
        $this->form_validation->set_rules('airlines', 'Airlines', 'required');
        $this->form_validation->set_rules('no_penerbangan', 'No. penerbangan', 'required');
        $this->form_validation->set_rules('no_smu', 'No. SMU', 'required');
        $this->form_validation->set_rules('berat', 'Berat', 'required');
        $this->form_validation->set_rules('koli', 'Jumlah koli', 'required');
        $this->form_validation->set_rules('biaya_gudang', 'Biaya gudang', 'required');
        $this->form_validation->set_rules('admin_gudang', 'Biaya admin gudang', 'required');


        if ($this->form_validation->run() == FALSE) {
            $key = null;
            $data = [
                'penjualan' => $this->Penjualan->getPenjualanById($id)->row(),
                'kotatujuan' => $this->Tujuan->getTujuan(),
                'dataPengirim' => $this->Pengirim->getPengirim($key),
                'title' => 'Edit Penjualan',
                'content' => 'penjualan/v_edit_penjualan'
            ];
            $this->load->view('layout/wrapper', $data);
        }
        // tombol update ditekan
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
            $biayaOperasional = htmlspecialchars($this->input->post('biaya_operasional'));
            $adminGudang = htmlspecialchars($this->input->post('admin_gudang'));
            $biayaTambahan = htmlspecialchars($this->input->post('biaya_tambahan'));
            $jenisPembayaran = htmlspecialchars($this->input->post('jenis_pembayaran'));
            $status = htmlspecialchars($this->input->post('status'));


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
            $totalOperasional = $biayaOperasional * $berat;
            $biayaTotal = $biayaSMU + $biayaGudang + $biayaTambahan + $totalOperasional;

            // echo json_encode($biayaTotal);
            $this->_update($biaya, $biayaSMU, $biayaGudang, $totalOperasional, $biayaTotal);
        }
    }

    private function _update($biaya, $biayaSMU, $biayaGudang, $totalOperasional, $biayaTotal)
    {
        $idPenjualan = htmlspecialchars($this->input->post('id'));
        $noKwitansi = htmlspecialchars($this->input->post('no_kwitansi'));
        $idPengirim = htmlspecialchars($this->input->post('id_pengirim'));
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
        $biayaOperasional = htmlspecialchars($this->input->post('biaya_operasional'));
        $adminGudang = htmlspecialchars($this->input->post('admin_gudang'));
        $biayaTambahan = htmlspecialchars($this->input->post('biaya_tambahan'));
        $jenisPembayaran = htmlspecialchars($this->input->post('jenis_pembayaran'));


        // cek jenis pembayaran didalam database;
        $id = $idPengirim; // id pengirim
        $dataPenjualan = $this->Penjualan->getPenjualanByIdPenjualan($idPenjualan)->row();
        $dataJenisPembayaran = $dataPenjualan->jenis_pembayaran;

        // jika jenis pembayaran di DB bukan deposit
        if ($dataJenisPembayaran != 'deposit') {
            if ($jenisPembayaran == 'deposit') {

                $penjualanID = $idPenjualan;
                $this->Deposit->insertPengeluaran($id, $penjualanID, $biayaTotal);
                // kurangi deposit dengan totalbiaya
                $this->Pengirim->kurangiDeposit($id, $biayaTotal);
            }
        }
        // 
        elseif ($dataJenisPembayaran == 'deposit') {
            // ambil data deposit sebelum update
            $dataDeposit = $this->Deposit->getDepositByIdPenjualan($idPenjualan)->row();
            $dataDepositSebelum = $dataDeposit->deposit;
            // ambil data deposit dari pengirim
            $dataPengirim = $this->Pengirim->getPengirimById($id)->row();
            $dataDepositPengirim = $dataPengirim->deposit;

            if ($jenisPembayaran == 'deposit') {
                // hitung selisih
                $selisihUpdate = $dataDepositSebelum - $biayaTotal;

                $deposit = $dataDepositPengirim + $selisihUpdate;
                $this->Pengirim->replaceDeposit($id, $deposit);

                // update history deposit
                $this->Deposit->updatePengeluaran($idPenjualan, $biayaTotal);
            } elseif ($jenisPembayaran != 'deposit') {
                // belom fix
                $dbHistoryDeposit = $this->Deposit->getDepositByIdPenjualan($idPenjualan)->row();
                $historyDeposit = $dbHistoryDeposit->deposit;

                $deposit = $historyDeposit + $dataDepositPengirim;

                $this->Pengirim->replaceDeposit($id, $deposit);
                $this->Deposit->deleteDepositByPenjualan($idPenjualan);
            }
        }


        if ($this->Penjualan->updatePenjualan($idPenjualan, $noKwitansi, $penerima, $kotaTujuan, $airlines, $noPenerbangan, $noSMU, $berat, $koli, $customHarga, $biaya, $biayaSMU, $adminSMU, $biayaOperasional, $totalOperasional, $isi, $catatan, $hargaGudang, $adminGudang, $biayaGudang, $biayaTambahan, $biayaTotal, $jenisPembayaran)) {
            $this->session->set_flashdata('success', 'Data berhasil diubah.');
            redirect('penjualan');
        }
    }



    // Hapus penjualan
    public function delete()
    {
        $id = htmlspecialchars($this->input->post('id'));
        $biayaTotal = $this->Penjualan->getPenjualanById($id)->row()->biaya_total;
        $getIdPengirim = $this->Deposit->getDepositByIdPenjualan($id)->row()->id_pengirim;
        $idPengirim = !empty($getIdPengirim) ? $getIdPengirim : null;


        if ($this->Penjualan->deletePenjualan($id) == true) {

            // delete deposit
            $this->Deposit->deleteDepositByPenjualan($id);
            $id = $idPengirim;
            $this->Pengirim->tambahDeposit($id, $biayaTotal);


            $this->session->set_flashdata('success', 'Data berhasil dihapus.');
            redirect('penjualan');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus.');
            redirect('penjualan');
        }
    }



    /**
     * 
     * @method Cetak Nota PDF
     */
    public function cetakNota()
    {
        // echo 'sip';
        $id = $this->input->post('id');

        $data['penjualan'] = $this->Penjualan->cetakNotaPenjualan($id);

        $this->load->view('penjualan/export/cetak_nota', $data);

        // $paper_size = 'A5';
        $paper_size = array(0, 0, 204, 650);
        $orientation = 'potrait';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        ob_end_clean();
        $this->dompdf->stream("nota_transaksi.pdf", array('Attachment' => 0));
    }


    // cetak melalui printer thermal
    public function cetakNota2()
    {
        // me-load library escpos
        $this->load->library('escpos');

        // membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
        $connector = new Escpos\PrintConnectors\WindowsPrintConnector("printer_a");

        // membuat objek $printer agar dapat di lakukan fungsinya
        $printer = new Escpos\Printer($connector);

        // DATA PENJUALAN
        $id = $this->input->post('id');
        $penjualan = $this->Penjualan->cetakNotaPenjualan($id)->row();

        $tanggal = date('d-m-Y', strtotime($penjualan->created_at));
        var_dump($tanggal);

        // die;

        // membuat fungsi untuk membuat 1 baris tabel, agar dapat dipanggil berkali-kali dgn mudah
        function buatBaris4Kolom($kolom1, $kolom2)
        {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 20;
            $lebar_kolom_2 = 20;
            // $lebar_kolom_3 = 8;
            // $lebar_kolom_4 = 9;

            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            // $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
            // $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);

            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            // $kolom3Array = explode("\n", $kolom3);
            // $kolom4Array = explode("\n", $kolom4);

            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array));

            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();

            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ", STR_PAD_LEFT);

                // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                // $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                // $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " ";
            }

            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris) . "\n";
        }

        // Membuat Logo
        $img =  Escpos\EscposImage::load("assets/images/logo/logo-print.png", true);
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
        $printer->bitImage($img, Escpos\Printer::IMG_DOUBLE_WIDTH | Escpos\Printer::IMG_DOUBLE_HEIGHT);

        // Membuat judul
        $printer->initialize();
        $printer->setFont(Escpos\Printer::FONT_B);
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
        $printer->text("CV. KALBAR KARGO MANDIRI\n");

        // Alamat
        $printer->initialize();
        $printer->setFont(Escpos\Printer::FONT_C);
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
        $printer->text("Jl. Arteri Supadio, \nKomplek Adi Griya Karya No. K-17 \nKalimantan Barat\n");
        $printer->text("Telp/Hp. 085787578464\n");
        $printer->text("Email : kalbarkargomandiri@gmail.com\n");
        $printer->text("\n");


        // Data transaksi
        $printer->initialize();
        $printer->setFont(Escpos\Printer::FONT_B);
        $printer->text("----------------------------------------\n");
        $printer->text("Kasir : " . $this->session->userdata('nama'));
        $printer->text("\n");
        $printer->text("Tanggal : " . $tanggal);
        $printer->text("\n");

        // Membuat tabel
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->setFont(Escpos\Printer::FONT_B);
        // $printer->text(buatBaris4Kolom("Barang", "Subtotal"));
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom("Pengirim", strtoupper($penjualan->pengirim)));
        $printer->text(buatBaris4Kolom("Penerima", strtoupper($penjualan->penerima)));
        $printer->text(buatBaris4Kolom("Airlines", strtoupper($penjualan->airlines)));
        $printer->text(buatBaris4Kolom("Rute", "Pontianak-$penjualan->kota_tujuan"));
        $printer->text(buatBaris4Kolom("No.SMU", $penjualan->no_smu));
        $printer->text(buatBaris4Kolom("Berat", "$penjualan->berat Kg"));
        $printer->text(buatBaris4Kolom("Koli", $penjualan->koli));
        $printer->text(buatBaris4Kolom("By.Pengiriman", rupiah($penjualan->biaya_smu + $penjualan->total_operasional)));
        $printer->text(buatBaris4Kolom("Jasa Gudang", rupiah($penjualan->total_biaya_gudang)));
        $printer->text(buatBaris4Kolom("Jenis Pembayaran", strtoupper($penjualan->jenis_pembayaran)));
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom("", "Total " . rupiah($penjualan->biaya_total)));
        $printer->text("----------------------------------------\n");
        $printer->text("\n");

        // Pesan penutup
        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text("Terima kasih\n");

        $printer->feed(5); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
        $printer->close();
    }


    //
    public function printNota()
    {
        $id = $this->input->post('id');
        $tujuanID = $this->input->post('tujuanID');

        $data['data_penjualan'] = $this->Penjualan->cetakNotaPenjualan($id)->row();

        $kotaTujuan = $this->Tujuan->getTujuanById($tujuanID)->row();
        $data['kota_tujuan'] = $kotaTujuan->kota_tujuan;

        echo json_encode($data);

        // $this->load->view('penjualan/export/cetak_nota3', $data);
    }
}
