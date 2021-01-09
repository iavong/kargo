<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINT</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="<?= base_url('assets/js/recta-host.js'); ?>"></script>

</head>

<body>

    <div class="container">

        <table class="table table-border">
            <tr>
                <td>Kasir</td>
                <td id="kasir"><?= $this->session->userdata('nama'); ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td id="date"><?= date('d-m-Y', strtotime($penjualan->created_at)); ?></td>
            </tr>
        </table>

        <br>

        <table class="table table-border">
            <tr>
                <td>Pengirim</td>
                <td id="pengirim"><?= strtoupper($penjualan->pengirim) ?></td>
            </tr>
            <tr>
                <td>Penerima</td>
                <td id="penerima"><?= strtoupper($penjualan->penerima) ?></td>
            </tr>
            <tr>
                <td>Airlines</td>
                <td id="airlines"><?= strtoupper($penjualan->airlines) ?></td>
            </tr>
            <tr>
                <td>Rute</td>
                <td id="rute"><?= 'Pontianak-' . $penjualan->kota_tujuan ?></td>
            </tr>
            <tr>
                <td>No. SMU</td>
                <td id="no_smu"><?= strtoupper($penjualan->no_smu) ?></td>
            </tr>
            <tr>
                <td>Berat</td>
                <td id="berat"><?= strtoupper($penjualan->berat) . ' Kg' ?></td>
            </tr>
            <tr>
                <td>Koli</td>
                <td id="koli"><?= strtoupper($penjualan->koli) ?></td>
            </tr>
            <tr>
                <td>By.Pengiriman</td>
                <td id="biayaPengiriman"><?= rupiah($penjualan->biaya_smu + $penjualan->total_operasional) ?></td>
            </tr>
            <tr>
                <td>Jasa Gudang</td>
                <td id="jasaGudang"><?= rupiah($penjualan->total_biaya_gudang) ?></td>
            </tr>
            <tr>
                <td>Jenis Pembayaran</td>
                <td id="jenisPembayaran"><?= strtoupper($penjualan->jenis_pembayaran) ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td id="total"><?= rupiah($penjualan->biaya_total) ?></td>
            </tr>

        </table>
        <button onclick="handlePrint();" class="btn btn-success">PRINT</button>
    </div>






    <script src="<?= base_url('assets/js/recta-script.js'); ?>"></script>
</body>

</html>