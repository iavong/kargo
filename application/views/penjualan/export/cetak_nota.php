<?php
error_reporting(0);
$row = $penjualan->row();
?>
<!DOCTYPE html>
<?php echo '<html><head>'; ?>
<title>Cetak Nota Penjualan</title>
<style>
    * {
        font-size: 11px;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        border: none;
    }

    .td-bold {
        font-weight: bold;
    }

    .kapital {
        text-transform: uppercase;
    }

    .center {
        text-align: center;
    }

    /* img.center {
        display: block;
        margin: 0 auto;
    } */
</style>
<?php echo '</head><body>'; ?>
<p style="text-align: center;">
    <img id="logo" src="./assets/images/logo/logo2.PNG" width="100" alt="Logo">
</p>
<!-- <p style="text-align: left; font-weight: bold;text-transform: capitalize;">
    
</p> -->
<p style="font-size: 10px;"><strong>CV. Kalbar Kargo Mandiri</strong><br> Jl. Arteri Supadio, Komplek Adi Griya Karya No. K-17 - Kalimantan Barat <br>
    Telp/Hp. 085787578464 <br>
    Email : kalbarkargomandiri@gmail.com</p>
<hr style="height: 2px; color: #000; margin: 10px 0 20px 0;">
<table style="margin-bottom: 20px;">
    <tr>
        <td>Tgl </td>
        <td> : </td>
        <td> <?= tgl_indo(date('Y-m-d', strtotime($row->created_at))); ?></td>
    </tr>
    <tr>
        <td>No Kwitansi </td>
        <td> : </td>
        <td><?= $row->no_kwitansi; ?></td>
    </tr>
    <tr>
        <td>Admin </td>
        <td> : </td>
        <td style="text-transform: capitalize;"><strong><?php echo $this->session->userdata('nama'); ?></strong></td>
    </tr>
</table>

<hr style="height: 2px; color: #000; margin: 15px 0 10px 0;">
<hr style="height: 0px; color: #000; margin: 5px 0 20px 0;">

<table style="margin-bottom: 20px;">
    <tr>
        <td>Pengirim </td>
        <td> : </td>
        <td class="kapital"><?= $row->pengirim; ?></td>
    </tr>
    <tr>
        <td>Penerima</td>
        <td> : </td>
        <td class="kapital"><?= $row->penerima; ?></td>
    </tr>
    <tr>
        <td>Rute</td>
        <td> : </td>
        <td><?= 'Pontianak - ' . $row->kota_tujuan; ?></td>
    </tr>
    <tr>
        <td>No. SMU</td>
        <td> : </td>
        <td><?= $row->no_smu; ?></td>
    </tr>
    <tr>
        <td>Berat (KG)</td>
        <td> : </td>
        <td><?= $row->berat . ' KG'; ?></td>
    </tr>
    <tr>
        <td>Koli</td>
        <td> : </td>
        <td><?= $row->koli; ?></td>
    </tr>
    <tr>
        <td>Biaya SMU</td>
        <td> : </td>
        <td><?= rupiah($row->biaya_smu + $row->total_operasional); ?></td>
    </tr>
    <tr>
        <td>Admin SMU</td>
        <td> : </td>
        <td><?= rupiah($row->biaya_admin_smu); ?></td>
    </tr>
    <tr>
        <td>Biaya Gudang</td>
        <td> : </td>
        <td><?= rupiah($row->harga_gudang * $row->berat); ?></td>
    </tr>
    <tr>
        <td>Admin J/G</td>
        <td> : </td>
        <td><?= rupiah($row->harga_admin_gudang); ?></td>
    </tr>
    <tr>
        <td>Total</td>
        <td> : </td>
        <td><?= rupiah($row->biaya_total); ?></td>
    </tr>
    <tr>
        <td>Jenis Pembayaran</td>
        <td> : </td>
        <td class="kapital"><?= $row->jenis_pembayaran; ?></td>
    </tr>
</table>

<hr style="height: 0px; color: #000; margin: 5px 0 20px 0;">
<hr style="height: 2px; color: #000; margin: 15px 0 10px 0;">

<!-- <p>SEMOGA PUAS DENGAN LAYANAN KAMI. TERIMA KASIH</p> -->

<?php echo '</body></html>'; ?>